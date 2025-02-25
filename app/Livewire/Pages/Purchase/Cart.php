<?php

namespace App\Livewire\Pages\Purchase;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Repositories\Interfaces\IBookRepository;
use App\Repositories\PaymentRepository;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('سبد خرید')]
class Cart extends Component
{

    public $books, $totalPrice = 0, $selectedGateway = 'zarinpal';
    protected $cartItems, $bookRepository, $paymentRepository;


    public function boot(IBookRepository $bookRepository, PaymentRepository $paymentRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->paymentRepository = $paymentRepository;
        $this->getBooks();
    }


    #[On('cart-updated')] 
    public function getBooks(){
        $cart = session('cart', []);
        $this->cartItems = collect($cart);
        $this->books = $this->bookRepository->getBooksByIds($this->cartItems->pluck('id'));
        $this->calculateTotal();
    }


    protected function calculateTotal(){
        $this->totalPrice = $this->books->sum(function($book) {
            return $book->price * $this->cartItems->firstWhere('id', $book->id)['quantity'];
        });
    }


    public function selectGateway(string $gateway): void
    {
        $this->selectedGateway = $gateway;
    }




    public function handlePurchaseProcessing()
    {
        try {
            $order = $this->handleCreateOrder();
            $transaction = $this->handleCreateTransaction($order);
            $response = $this->createTransactionInPaymentGateway($this->selectedGateway, $transaction);
            $transaction = $this->handleUpdateTransaction($this->selectedGateway, $transaction, $response);
            $link = $this->createPaymentGatewayLink($this->selectedGateway, $response);
            return redirect()->away($link);
        } catch (\Exception $e) {
            // return Response::error($error->getMessage(), null);
        }
    }

    protected function createPaymentGatewayLink($gateway, $response){
        return $this->paymentRepository->createPaymentGatewayLink($gateway, $response);
    }

    protected function handleUpdateTransaction($gateway, $transaction, $data)
    {
        $data = $this->paymentRepository->prepareUpdateTransactionData($gateway, $data);
        $transaction->update($data);
        return $transaction;
    }

    protected function createTransactionInPaymentGateway($gateway, $transaction)
    {
        $data = $this->paymentRepository->prepareCreateTransactionData($gateway, $transaction);
        return $this->paymentRepository->createTransaction($gateway, $data);
    }


    protected function handleCreateTransaction($order){

        $data=[
            'order_id' => $order->id,
            'amount' => $order->total_amount ,
            'gateway' => $this->selectedGateway,
        ];

        return Transaction::create($data);
    }


    protected function handleCreateOrder(){
        $user = auth()->user();
        if($user){
            $order = Order::create([
                "user_id" => $user->id,
                "total_amount" => $this->totalPrice,
                "total_items" => $this->cartItems->sum('quantity'),
            ]);

            foreach ($this->cartItems as $item) {
                OrderItem::create([
                    "order_id" => $order->id,
                    "book_id" => $item['id'],
                    "quantity" => $item['quantity'],
                    'price' => $this->books->find($item['id'])->price
                ]);
            }
        }
        return $order ;
    }



    
    public function render()
    {
        return view('livewire.pages.purchase.cart');
    }
}
