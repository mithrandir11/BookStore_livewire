<?php

namespace App\Livewire\Components\Book;

use App\Repositories\Interfaces\IBookRepository;
use Livewire\Component;

class Latest extends Component
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
        return view('livewire.components.book.latest');
    }
}
