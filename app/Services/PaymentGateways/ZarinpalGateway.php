<?php

namespace App\Services\PaymentGateways;

use App\Repositories\Interfaces\IPaymentGatewayRepository;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

class ZarinpalGateway implements IPaymentGatewayRepository
{
    public function createTransaction($data)
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post('https://sandbox.zarinpal.com/pg/v4/payment/request.json', $data);
    }

    public function verifyTransaction($data){
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post('https://sandbox.zarinpal.com/pg/v4/payment/verify.json', $data);
    }

    public function getTransId($data){
        dd($data->json());
        // $authority = Request::input('Authority');
        // if($authority){
        //     return $authority;
        // }
    }

    public function createPaymentGatewayLink($data){
        $authority = $data->json()['data']['authority'];
        if($authority){
            return "https://sandbox.zarinpal.com/pg/StartPay/".$authority;
        }
    }

    public function prepareCreateTransactionData($data){
        // dd($data['order_id']);
        return [ //zarinpal
            "merchant_id"=> "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
            "amount"=> $data['amount'],
            "callback_url"=> route('handleVerifyProcessing'),
            "description"=> "خرید کتاب",
            "order_id" => $data['order_id']
        ];
    }

    public function prepareUpdateTransactionData($data){
        // dd($data->json());
        // return $data->json()['data']['authority'];
        if(isset($data->json()['data']['authority'])){
            return [
                "uu_id" => $data->json()['data']['authority']
            ];
        }
        

        if(isset($data->json()['data']['ref_id'])){
            return [
                "trans_id" => $data->json()['data']['ref_id'],
                "status" => 'successful'
            ];
        }

        // if((isset($data['status']) == 1) && isset($data['transId'])){
        //     return [
        //         "trans_id" => (string)$data['transId'],
        //         "status" => 'successful'
        //     ];
        // }
    }

    public function getUuId($data){
        // return $data;
        return $data['Authority'];
    }

    public function getStatus($data){
        return $data['Status'] == 'OK' ? true : false ;
    }

    public function prepareVerifyProcessingData($data, $amount=null){
        // dd($data);

        return [ //pay
            "merchant_id"=> "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
            "amount"=> $amount,
            "authority"=> $data['Authority'],
        ];
    }
}