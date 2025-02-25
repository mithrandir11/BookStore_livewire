<?php

namespace App\Http\Controllers\Api;

use App\Events\PaymentSuccessful;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\IBookRepository;
use App\Repositories\Interfaces\ICouponRepository;
use App\Repositories\Interfaces\IOrderItemRepository;
use App\Repositories\Interfaces\IOrderRepository;
use App\Repositories\Interfaces\ITransactionRepository;
use App\Repositories\PaymentRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PurchaseController extends Controller
{
    protected $orderRepository;
    protected $orderItemRepository;
    protected $bookRepository;
    protected $transactionRepository;
    protected $couponRepository;
    protected $paymentRepository;

    public function __construct(
        IOrderRepository $orderRepository, 
        IOrderItemRepository $orderItemRepository, 
        IBookRepository $bookRepository,
        ITransactionRepository $transactionRepository,
        ICouponRepository $couponRepository,
        PaymentRepository $paymentRepository
        )
    {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->bookRepository = $bookRepository;
        $this->transactionRepository = $transactionRepository;
        $this->couponRepository = $couponRepository;
        $this->paymentRepository = $paymentRepository;
    }


    public function handlePurchaseProcessing(Request $request)
    {
        try {
            $order = $this->handleCreateOrder($request);
            if(isset($request->discount_code)) $order = $this->handleApplyCoupon($request, $order);
            $transaction = $this->handleCreateTransaction($request->gateway, $order, $request);
            $response = $this->createTransactionInPaymentGateway($request->gateway, $transaction);
            $transaction = $this->handleUpdateTransaction($request->gateway, $transaction->id, $response);
            return $this->createPaymentGatewayLink($request->gateway, $response);
        } catch (Exception $error) {
            return Response::error($error->getMessage(), null);
        }
    }


    public function handleVerifyProcessing(Request $request)
    {
        // dd($request);
        $gateway = $this->identifyGatewayByParams($request);
        $is_successful = $this->paymentRepository->getStatus($gateway, $request);
        if(!$is_successful){
            $error = 'پرداخت ناموفق بود';
            return redirect()->away(env('FRONT_URL')."result?result=failed&error=".$error);
        }

        $uu_id = $this->paymentRepository->getUuId($gateway, $request);
        $transaction = $this->transactionRepository->findWhereFirst('uu_id', $uu_id);
        if(!$transaction){
            $error = 'تراکنش یافت نشد';
            return redirect()->away(env('FRONT_URL')."result?result=failed&error=".$error);
        }
        
        $data = $this->paymentRepository->prepareVerifyProcessingData($gateway, $request, $transaction->amount);
        $response = $this->paymentRepository->verifyTransaction($gateway, $data);
        $trans_id = $this->paymentRepository->getTransId($gateway, $response);
        dd($trans_id);
        if($this->transactionRepository->exists('trans_id', $trans_id)){
            $error = 'این تراکنش قبلا ثبت شده است';
            return redirect()->away(env('FRONT_URL')."result?result=failed&error=".$error);
        }

        $transaction = $this->handleUpdateTransaction($gateway, $transaction->id, $response);

        PaymentSuccessful::dispatch($transaction);
        return redirect()->away(env('FRONT_URL')."result?result=successful");
    }


    protected function handleUpdateTransaction($gateway, $id, $data)
    {
        $data = $this->paymentRepository->prepareUpdateTransactionData($gateway, $data);
        return $this->transactionRepository->updateTransaction($id, $data);
    }


    protected function createPaymentGatewayLink($gateway, $response){
        return $this->paymentRepository->createPaymentGatewayLink($gateway, $response);
    }


    protected function createTransactionInPaymentGateway($gateway, $transaction)
    {
        $data = $this->paymentRepository->prepareCreateTransactionData($gateway, $transaction);
        return $this->paymentRepository->createTransaction($gateway, $data);
    }


    protected function identifyGatewayByParams(Request $request)
    {
        if ($request->has('id') && $request->has('track_id')) {
            return 'idpay';
        } elseif ($request->has('token')) {
            return 'pay';
        } elseif ($request->has('Authority')) {
            return 'zarinpal';
        }
        throw new \Exception('Unsupported payment gateway');
    }


    protected function handleCreateTransaction($gateway, $order, $request)
    {
        $shipping_cost = 36000;
        $data=[
            'order_id' => $order->id,
            'amount' => $order->total_amount - $order->discount_amount + $shipping_cost,
            'status' => 'pending',
            'gateway' => $gateway,
        ];

        return $this->transactionRepository->createTransaction($data);
    }


    protected function handleApplyCoupon($request, $order){
        $data = [
            'code' => $request->discount_code,
            'total_amount' => $order->total_amount
        ];

        $coupon = $this->couponRepository->verifyCoupon($data);
        $discount_amount = $this->couponRepository->calculationDiscountAmount($data);

        $order = $this->orderRepository->updateOrder($order->id, 
            [
                'coupon_id' => $coupon->id,
                'discount_amount' => $discount_amount,
            ]
        );

        return $order;
    }



    protected function handleCreateOrder($data)
    {
        $order = $this->orderRepository->createOrder([
            "user_id" => $data->user()->id,
            "total_amount" => 0,
            "total_items" => 0,
            "address_id" => $data['address_id'],
        ]);

        $book_ids = array_column($data['items'], 'book_id');
        $books = $this->getbooksbyIds($book_ids);
        $total_amount = 0;
        $total_items = 0;
        foreach ($data['items'] as $item){
            $item = array_merge(
                ['order_id'=>$order->id], 
                ['price'=>$this->getPriceBookById($books, $item['book_id'])], 
                $item
            );

            if((int)$item['quantity'] > (int)$this->getQuantityBookById($books, $item['book_id'])){
                throw new Exception("Error Processing Request", 1);
            }

            $order_item = $this->orderItemRepository->createOrderItem($item);
            $total_amount += $order_item->price * $order_item->quantity;
            $total_items += $order_item->quantity;
        }
        $order = $this->orderRepository->updateOrder($order->id, [
            'total_amount' => $total_amount,
            'total_items' => $total_items,
        ]);

        return $order;
    }

    protected function getbooksbyIds($book_ids)
    {
        return $this->bookRepository->getBooksByIds($book_ids);
    }

    protected function getPriceBookById($books, $book_id)
    {
        foreach ($books as $book) {
            if ($book['id'] == $book_id) {
                return $book['price'];
            }
        }
        return null;
    }

    protected function getQuantityBookById($books, $book_id)
    {
        foreach ($books as $book) {
            if ($book['id'] == $book_id) {
                return $book['quantity'];
            }
        }
        return null;
    }
}
