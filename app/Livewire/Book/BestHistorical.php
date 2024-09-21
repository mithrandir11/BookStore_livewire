<?php

namespace App\Livewire\Book;

use App\Repositories\Interfaces\IBookRepository;
use Livewire\Component;

class BestHistorical extends Component
{
    public $books;
    protected $bookRepository;
    public function mount(IBookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->books = $this->bookRepository->getLatestBooks(10);
    }
    
    public function render()
    {
        return view('livewire.book.best-historical');
    }
}
