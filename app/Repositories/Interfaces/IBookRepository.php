<?php

namespace App\Repositories\Interfaces;

interface IBookRepository
{
    public function withCriteria(array $criteria);
    public function getAllBooks($perPage);
    public function getBookById($id);
    public function getBooksByIds($data);
    public function getBookByCategoryId($id);
    public function getBestSellersBooks($limit);
    public function getLatestBooks($limit);
    public function search(string $query);
    public function getBooksSortBy($sort_by);
    // public function createComment($data);
}