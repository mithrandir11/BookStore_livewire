<?php

namespace App\Repositories\Interfaces;

interface IAddressRepository
{
    public function create($data);
    public function getUserAddresses($user_id);
}