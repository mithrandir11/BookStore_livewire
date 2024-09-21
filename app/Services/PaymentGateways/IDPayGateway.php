<?php

namespace App\Services\PaymentGateways;

use App\Repositories\Interfaces\IPaymentGatewayRepository;
use Illuminate\Support\Facades\Http;

class IDPayGateway implements IPaymentGatewayRepository
{
    public function createTransaction($data)
    {
        return Http::withHeaders([
            'X-API-KEY' => env('IDPAY_API_KEY'),
            'X-SANDBOX' => env('IDPAY_SANDBOX'),
            'Content-Type' => 'application/json',
        ])->post('https://api.idpay.ir/v1.1/payment', $data);
    }

    public function verifyTransaction($data){
        return Http::withHeaders([
            'X-API-KEY' => env('IDPAY_API_KEY'),
            'X-SANDBOX' => env('IDPAY_SANDBOX'),
            'Content-Type' => 'application/json',
        ])->post('https://api.idpay.ir/v1.1/payment/verify', $data);
    }

    public function getTransId($data){
        if(isset($data['track_id'])){
            return $data['track_id'];
        }
    }


    public function createPaymentGatewayLink($data){
        if($data['link']){
            return $data['link'];
        }
    }

    public function prepareCreateTransactionData($data){
        return [ //idpay
            "order_id"=> $data['order_id'],
            "amount"=> $data['amount'],
            "callback"=> route('handleVerifyProcessing'),
        ];
    }

    public function prepareUpdateTransactionData($data){
        if(isset($data['id']) && isset($data['link'])){
            return [
                "uu_id" => $data['id']
            ];
        }

        if((isset($data['status']) == 100 ) && isset($data['track_id'])){
            return [
                "trans_id" => $data['track_id'],
                "status" => 'successful'
            ];
        }
    }

    public function getUuId($data){
        return $data['id'];
    }

    public function getStatus($data){
        return $data['status'] == 10 ? true : false ;
    }

    public function prepareVerifyProcessingData($data){
        return [ //idpay
                "order_id"=> $data['order_id'],
                "id"=> $data['id'],
        ];
    }
}