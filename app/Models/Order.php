<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public function coupons()
    // {
    //     return $this->belongsToMany(Coupon::class, 'coupon_order')->withPivot('discount_amount');
    // }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
