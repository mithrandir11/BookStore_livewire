<?php

namespace App\Repositories;

use App\Models\Coupon;
use App\Repositories\Interfaces\ICouponRepository;
use Exception;

class CouponRepository implements ICouponRepository
{

    protected $model;

    public function __construct(Coupon $model)
    {
        $this->model = $model;
    }

    public function find($id){
        return $this->model->findOrFail($id);
    }

    public function findByCode($code){
        return $this->model->where('code', $code)->first();
    }

    public function verifyCoupon($data){
        $coupon = $this->findByCode($data['code']);
        if (!$coupon) {
            throw new Exception('کد تفیف یافت نشد');
        }

        if ($coupon->expires_at && $coupon->expires_at < now()) {
            throw new Exception('این کد تخفیف منقضی شده است.');
        }
    
        if ($coupon->usage_limit && $coupon->used_count >= $coupon->usage_limit) {
            throw new Exception('محدودیت استفاده از این کد تخفیف تمام شده است.');
        }
    
        if ($coupon->min_order_amount && $data['total_amount'] < $coupon->min_order_amount) {
            throw new Exception('برای استفاده از این کد تخفیف، مبلغ سفارش باید بیشتر از ' . $coupon->min_order_amount . ' باشد.');
        }

        return $coupon;
    }


    public function calculationDiscountAmount($data){
        $coupon = $this->findByCode($data['code']);
        if (!$coupon) {
            throw new Exception('کد تفیف یافت نشد');
        }

        $discount = 0;
        if ($coupon->discount_amount) {
            $discount = $coupon->discount_amount;
        } elseif ($coupon->discount_percentage) {
            $discount = ($data['total_amount'] * $coupon->discount_percentage) / 100;
            if ($coupon->max_discount_amount && $discount > $coupon->max_discount_amount) {
                $discount = $coupon->max_discount_amount;
            }
        }

        return $discount;
    }


    public function incrementUsageCount($id)
    {
        $coupon = $this->find($id);
        $coupon->increment('used_count');
    }

    public function applyCouponToOrder($data)
    {
        $coupon = $this->find($data['coupon_id']);
        $coupon->orders()->attach($data['order_id'], ['discount_amount' => $data['discount_amount']]);
    }

    

}