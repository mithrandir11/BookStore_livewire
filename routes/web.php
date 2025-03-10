<?php

use App\Livewire\Main;
use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\Register;
use App\Livewire\Pages\Book\Category;
use App\Livewire\Pages\Book\Index;
use App\Livewire\Pages\Book\Show;
use App\Livewire\Pages\Purchase\Cart;
use App\Livewire\Pages\Purchase\Status;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', Main::class)->name('home');
Route::get('/books/{sort_by?}', Index::class)->name('books');
Route::get('/books/{id}/{slug}', Show::class)->name('ShowBook');
// Route::get('/category/{id}/{slug}', ShowCategory::class)->name('showCategory');
Route::get('/category/{id}/{slug}', Category::class)->name('showCategory');

Route::get('/cart', Cart::class)->name('purchase.cart');
Route::get('/payment/status', Status::class)->name('purchase.status');

//auth
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
