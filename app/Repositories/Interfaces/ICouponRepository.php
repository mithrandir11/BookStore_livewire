<?php

namespace App\Repositories\Interfaces;

interface ICouponRepository
{
    // public function createCoupon($data);
    public function verifyCoupon($data);
    public function calculationDiscountAmount($data);
    public function incrementUsageCount($id);
    public function applyCouponToOrder($data);

    // public function getAllBooks($perPage);
    // public function getBookById($id);
    // public function getBooksByIds($data);
    // public function getBookByCategoryId($id);
    // public function getBestSellersBooks($limit);
    // public function getLatestBooks($limit);
}