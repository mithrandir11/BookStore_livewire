<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Repositories\Interfaces\ITransactionRepository;

class TransactionRepository implements ITransactionRepository
{
    protected $model;

    public function __construct(Transaction $model)
    {
        $this->model = $model;
    }

    public function find($id){
        return $this->model->findOrFail($id);
    }

    public function findWhere($column, $value){
        return $this->model->where($column, $value)->get();
    }

    public function findWhereFirst($column, $value){
        return $this->model->where($column, $value)->first();
    }

    public function exists($column, $value){
        return $this->model->where($column, $value)->exists();
    }


    public function createTransaction($data)
    {
        return $this->model->create($data); 
    }

    public function updateTransaction($id, $data){
        $item = $this->find($id);
        $item->update($data);
        return $item;
    }
}