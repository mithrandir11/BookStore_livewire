<?php

namespace App\Providers;

use App\Repositories\AddressRepository;
use App\Repositories\AuthorRepository;
use App\Repositories\BookRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CommentRepository;
use App\Repositories\CouponRepository;
use App\Repositories\Interfaces\IAddressRepository;
use App\Repositories\Interfaces\IAuthorRepository;
use App\Repositories\Interfaces\IBookRepository;
use App\Repositories\Interfaces\ICategoryRepository;
use App\Repositories\Interfaces\ICommentRepository;
use App\Repositories\Interfaces\ICouponRepository;
use App\Repositories\Interfaces\IOrderItemRepository;
use App\Repositories\Interfaces\IOrderRepository;
use App\Repositories\Interfaces\IPublisherRepository;
use App\Repositories\Interfaces\ITransactionRepository;
use App\Repositories\Interfaces\IUserRepository;
use App\Repositories\OrderItemRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PublisherRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IBookRepository::class, BookRepository::class);
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        $this->app->bind(IOrderRepository::class, OrderRepository::class);
        $this->app->bind(IOrderItemRepository::class, OrderItemRepository::class);
        $this->app->bind(ITransactionRepository::class, TransactionRepository::class);
        $this->app->bind(ICouponRepository::class, CouponRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IAddressRepository::class, AddressRepository::class);
        $this->app->bind(ICommentRepository::class, CommentRepository::class);
        $this->app->bind(IPublisherRepository::class, PublisherRepository::class);
        $this->app->bind(IAuthorRepository::class, AuthorRepository::class);
        // $this->app->bind(IPaymentGatewayRepository::class, IdpayPaymentGatewayRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Str::macro('customSlug', function ($string, $separator = '-') {
            return preg_replace('/\s+/u', $separator, trim($string));
        });

        Response::macro('success', function($message, $data, $pagination = null) {
            return response()->json([
                'status' => 1,
                'message' => $message,
                'data' => $data,
                'pagination' => $pagination
            ]);
        });

        Response::macro('error', function($message, $data = null, $code = 400) {
            return response()->json([
                'status' => 0,
                // 'error' => $message,
                'message' => $message,
                'data' => $data,
            ], $code);
        });

        
    }
}
