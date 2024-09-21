<?php

namespace App\Listeners;

use App\Events\PaymentSuccessful;
use App\Models\Coupon;
use App\Models\Order;
use App\Repositories\Interfaces\ICouponRepository;
use App\Repositories\Interfaces\IOrderRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateDiscountUsage
{
    protected $orderRepository;
    protected $couponRepository;

    public function __construct(IOrderRepository $orderRepository, ICouponRepository $couponRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->couponRepository = $couponRepository;
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentSuccessful $event): void
    {
        $order = $this->orderRepository->find($event->transaction->order_id);
        if ($order && $order->coupon_id) {
            $this->couponRepository->incrementUsageCount($order->coupon_id);
        }
    }
}
