<?php

namespace App\Livewire\Book;

use App\Repositories\Interfaces\IBookRepository;
use Livewire\Component;

class BestSellers extends Component
{
    public $books;
    protected $bookRepository;
    public function mount(IBookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->books = $this->bookRepository->getBestSellersBooks(10);
    }

    
    public function render()
    {
        
        return view('livewire.book.best-sellers');
    }
}
