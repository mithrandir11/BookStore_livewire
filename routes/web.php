<?php

use App\Livewire\Main;
use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\Register;
use App\Livewire\Pages\Book\Index;
use App\Livewire\Pages\Purchase\Cart;
use App\Livewire\Pages\ShowBook;
use App\Livewire\Pages\ShowCategory;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', Main::class)->name('home');
Route::get('/books', Index::class)->name('books');
Route::get('/books/{id}/{slug}', ShowBook::class)->name('ShowBook');
Route::get('/category/{id}/{slug}', ShowCategory::class)->name('showCategory');

Route::get('/cart', Cart::class)->name('purchase.cart');

//auth
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
