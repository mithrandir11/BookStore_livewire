<?php

namespace App\Services\PaymentGateways;

use App\Repositories\Interfaces\IPaymentGatewayRepository;
use Illuminate\Support\Facades\Http;

// class ZarinpalGateway implements IPaymentGatewayRepository
// {
//     public function createTransaction($data)
//     {
//         return Http::withHeaders([
//             'Accept' => 'application/json',
//             'Content-Type' => 'application/json',
//         ])->post('https://sandbox.zarinpal.com/pg/v4/payment/request.json', $data);
//     }

//     public function verifyTransaction($data){
//         return Http::withHeaders([
//             'Accept' => 'application/json',
//             'Content-Type' => 'application/json',
//         ])->post('https://sandbox.zarinpal.com/pg/v4/payment/verify.json', $data);
//     }

//     public function createPaymentGatewayLink($data){
//         // if($data['link']){
//         //     return $data['link'];
//         // }
//     }
// }