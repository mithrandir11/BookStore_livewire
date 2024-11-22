<?php

namespace App\Livewire\Book;

use App\Repositories\Interfaces\IBookRepository;
use Livewire\Attributes\Computed;
use Livewire\Component;

class BestSellers extends Component
{
    protected $bookRepository;
    public function mount(IBookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    #[Computed(persist: true)]
    public function books(){
        return $this->bookRepository->getBestSellersBooks(10);
    }

    
    public function render()
    {
        return view('livewire.book.best-sellers');
    }
}
