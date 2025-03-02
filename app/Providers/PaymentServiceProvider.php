<?php

namespace App\Providers;

use App\Events\PaymentSuccessful;
use App\Listeners\UpdateDiscountUsage;
use App\Services\Factory\PaymentGatewayFactory;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(PaymentGatewayFactory::class, function ($app) {
            return new PaymentGatewayFactory();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        
    }
}
