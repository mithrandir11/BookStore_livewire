<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'coupon_user')->withPivot('used_at');
    // }

    // public function orders()
    // {
    //     return $this->belongsToMany(Order::class, 'coupon_order')->withPivot('discount_amount');
    // }
}
