<?php

namespace App\Livewire\Components\Purchase;

use Livewire\Component;

class AddToCart extends Component
{
    public $book_id;//from parent
    public $quantityItem = 0;

    public function mount(){
        $this->getQuantity();
    }

    public function getQuantity(){
        $book = collect(session('cart', []))->firstWhere('id',$this->book_id);
        $book ? $this->quantityItem = $book['quantity'] : $this->quantityItem=0;
    }

    public function addToCart()
    {
        $cart = session('cart', []);

        if (isset($cart[$this->book_id])) {
            $cart[$this->book_id]['quantity']++;
        } else {
            $cart[$this->book_id] = [
                'id' => $this->book_id,
                'quantity' => 1,
            ];
        }
        session(['cart' => $cart]);

        $this->getQuantity();
        $this->dispatch('cart-updated'); 
    }

    public function removeFromCart(){
        $cart = session('cart', []);

        if (isset($cart[$this->book_id])) {
            if ($cart[$this->book_id]['quantity'] > 1) {
                $cart[$this->book_id]['quantity']--;
            } else {
                unset($cart[$this->book_id]);
            }
            session(['cart' => $cart]);
        }

        $this->getQuantity();
        $this->dispatch('cart-updated');

    }

    public function render()
    {
        return view('livewire.components.purchase.add-to-cart');
    }
}
