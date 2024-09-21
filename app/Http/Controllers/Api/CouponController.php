<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ICouponRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CouponController extends Controller
{
    protected $couponRepository;
    public function __construct(ICouponRepository $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    public function findByCode($code){
        try {
            $coupon = $this->couponRepository->verifyCoupon(['code'=>$code]);
            return Response::success(null, $coupon);
        } catch (Exception $error) {
            return Response::error($error->getMessage(), null, 200);
        }
    }
}
