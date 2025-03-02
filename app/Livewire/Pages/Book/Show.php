<?php

namespace App\Livewire\Pages\Book;

use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Interfaces\IBookRepository;
use Livewire\Component;

class Show extends Component
{
    public $book;
    protected $bookRepository;
    public function mount(IBookRepository $bookRepository, $id)
    {
        $this->bookRepository = $bookRepository;
        $this->book = $this->bookRepository
        ->withCriteria([
            new EagerLoad(['category','author','translator', 'publisher','comments']),
        ])
        ->getBookById($id);
    }
    
    public function render()
    {
        return view('livewire.pages.book.show')->title("کتاب ".$this->book->title);
    }
}
