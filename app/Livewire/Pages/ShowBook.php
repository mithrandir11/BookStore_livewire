<?php

namespace App\Livewire\Pages;


use App\Repositories\Interfaces\IBookRepository;
use Livewire\Component;

class ShowBook extends Component
{
    public $book;
    protected $bookRepository;
    public function mount(IBookRepository $bookRepository, $id)
    {
        $this->bookRepository = $bookRepository;
        $this->book = $this->bookRepository->getBookById($id);
    }

    public function render()
    {
        return view('livewire.pages.show-book')->title("کتاب ".$this->book->title);
    }
}
