<?php

namespace App\Services\PaymentGateways;

use App\Repositories\Interfaces\IPaymentGatewayRepository;
use App\Repositories\Interfaces\ITransactionRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class PayGateway implements IPaymentGatewayRepository
{
    public function createTransaction($data)
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post('https://pay.ir/pg/send', $data);
    }

    public function verifyTransaction($data){
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post('https://pay.ir/pg/verify', $data);
    }

    public function getTransId($data){
        if(isset($data['transId'])){
            return $data['transId'];
        }
    }



    public function createPaymentGatewayLink($data){
        if($data['token']){
            return "https://pay.ir/pg/".$data['token'];
        }
    }

    public function prepareCreateTransactionData($data){
        return [ //pay
            "api"=> "test",
            "amount"=> $data['amount'],
            "redirect"=> route('handleVerifyProcessing')
        ];
    }

    public function prepareUpdateTransactionData($data){
        if(isset($data['token'])){
            return [
                "uu_id" => $data['token']
            ];
        }

        if((isset($data['status']) == 1) && isset($data['transId'])){
            return [
                "trans_id" => (string)$data['transId'],
                "status" => 'successful'
            ];
        }
    }

    public function getUuId($data){
        return $data['token'];
    }

    public function getStatus($data){
        return $data['status'] == 1 ? true : false ;
    }

    public function prepareVerifyProcessingData($data){
        return [ //pay
                "api"=> "test",
                "token"=> $data['token'],
        ];
    }
}