<?php

namespace App\Repositories;

use App\Services\Factory\PaymentGatewayFactory;

class PaymentRepository
{
    protected $factory;

    public function __construct(PaymentGatewayFactory $factory)
    {
        $this->factory = $factory;
    }

    public function createTransaction($gateway, $data)
    {
        $paymentGateway = $this->factory->make($gateway, $gateway);
        return $paymentGateway->createTransaction($data);
    }

    public function verifyTransaction($gateway, $data)
    {
        $paymentGateway = $this->factory->make($gateway, $gateway);
        return $paymentGateway->verifyTransaction($data);
    }

    public function getTransId($gateway, $data)
    {
        $paymentGateway = $this->factory->make($gateway, $gateway);
        return $paymentGateway->getTransId($data);
    }


    public function createPaymentGatewayLink($gateway, $data)
    {
        $paymentGateway = $this->factory->make($gateway, $gateway);
        return $paymentGateway->createPaymentGatewayLink($data);
    }

    public function prepareCreateTransactionData($gateway, $data)
    {
        $paymentGateway = $this->factory->make($gateway, $gateway);
        return $paymentGateway->prepareCreateTransactionData($data);
    }

    public function prepareUpdateTransactionData($gateway, $data)
    {
        $paymentGateway = $this->factory->make($gateway, $gateway);
        return $paymentGateway->prepareUpdateTransactionData($data);
    }

    public function getUuId($gateway, $data)
    {
        $paymentGateway = $this->factory->make($gateway, $gateway);
        return $paymentGateway->getUuId($data);
    }

    public function getStatus($gateway, $data)
    {
        $paymentGateway = $this->factory->make($gateway, $gateway);
        return $paymentGateway->getStatus($data);
    }

    public function prepareVerifyProcessingData($gateway, $data)
    {
        $paymentGateway = $this->factory->make($gateway, $gateway);
        return $paymentGateway->prepareVerifyProcessingData($data);
    }

    

    
}