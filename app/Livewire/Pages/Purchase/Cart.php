<?php

namespace App\Livewire\Pages\Purchase;

use App\Repositories\Interfaces\IBookRepository;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('سبد خرید')]
class Cart extends Component
{

    public $books;
    protected $cartItems;

    protected $bookRepository;
    public function boot(IBookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->getBooks();
    }

    #[On('cart-updated')] 
    public function getBooks(){
        $cart = session('cart', []);
        $this->cartItems = collect($cart);
        $this->books =  $this->bookRepository->getBooksByIds($this->cartItems->pluck('id'));
    }

    // public function calculateOriginalPrice(){
    //     $this->originalPrice = $this->books->sum(function ($book) use ($this->cartItems) {
    //         $quantity = $cartItems->firstWhere('id', $book->id)['quantity'] ?? 0;
    //         return $quantity * $book->price; // قیمت کل هر کتاب
    //     });
    // }
    
    public function render()
    {
        return view('livewire.pages.purchase.cart');
    }
}
