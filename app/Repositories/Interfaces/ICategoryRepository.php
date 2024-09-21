<?php

namespace App\Repositories\Interfaces;

interface ICategoryRepository
{
    public function getAllCategories();
    public function getCategoryById($id);
    // public function getBookById($id);
    // public function getBestSellersBooks($limit);
    // public function getLatestBooks($limit);
}