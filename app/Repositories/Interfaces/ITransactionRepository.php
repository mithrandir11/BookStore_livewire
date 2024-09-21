<?php

namespace App\Repositories\Interfaces;

interface ITransactionRepository
{
    public function createTransaction($data);
    public function updateTransaction($id, $data);
    public function find($id);
    public function findWhere($column, $value);
    public function findWhereFirst($column, $value);
    public function exists($column, $value);
}