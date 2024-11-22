<?php

namespace App\Livewire\Components\Purchase;

use Livewire\Attributes\On;
use Livewire\Component;

class CartIcon extends Component
{
    public $cartCount = 0;

    public function mount()
    {
        $this->updateCartCount();
    }

    #[On('cart-updated')] 
    public function updateCartCount()
    {
        $this->cartCount = collect(session('cart', []))->sum('quantity');
    }

    public function render()
    {
        return view('livewire.components.purchase.cart-icon');
    }
}
