<?php

namespace App\Repositories;

use App\Models\OrderItem;
use App\Repositories\Interfaces\IOrderItemRepository;

class OrderItemRepository implements IOrderItemRepository
{

    protected $model;

    public function __construct(OrderItem $model)
    {
        $this->model = $model;
    }

    public function createOrderItem($data){
        return $this->model->create($data);
    }

}