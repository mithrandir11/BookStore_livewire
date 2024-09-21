<?php

namespace App\Repositories\Interfaces;

interface IPaymentGatewayRepository
{
    public function createTransaction($data);
    public function verifyTransaction($data);
    public function getTransId($data);
    public function createPaymentGatewayLink($data);
    public function prepareCreateTransactionData($data);
    public function prepareUpdateTransactionData($data);
    public function getUuId($data);
    public function getStatus($data);
    public function prepareVerifyProcessingData($data);
    
}