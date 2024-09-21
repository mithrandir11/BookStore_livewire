<?php

namespace App\Repositories;

use App\Models\Address;
use App\Repositories\Interfaces\IAddressRepository;

class AddressRepository implements IAddressRepository
{

    protected $model;

    public function __construct(Address $model)
    {
        $this->model = $model;
    }

    public function create($data){
        return $this->model->create($data);
    }

    public function getUserAddresses($user_id){
        return  $this->model->where('user_id', $user_id)->latest()->get();
    }

    

}