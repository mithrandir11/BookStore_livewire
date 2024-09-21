<?php

namespace App\Services\Factory;

use App\Repositories\Interfaces\IPaymentGatewayRepository;
use App\Services\PaymentGateways\IDPayGateway;
use App\Services\PaymentGateways\PayGateway;
use App\Services\PaymentGateways\ZarinpalGateway;

class PaymentGatewayFactory
{
    public function make($gateway): IPaymentGatewayRepository
    {
        switch ($gateway) {
            case 'idpay':
                return new IDPayGateway();
            case 'pay':
                return new PayGateway();
            case 'zarinpal':
                return new ZarinpalGateway();
            default:
                throw new \Exception('Invalid payment gateway selected');
        }
    }
}
