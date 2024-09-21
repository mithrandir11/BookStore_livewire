<?php

namespace App\Livewire\Book;

use App\Repositories\Interfaces\IAuthorRepository;
use Livewire\Component;

class FilterAuthor extends Component
{
    public $authors;
    protected $authorRepository;
    public function mount(IAuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
        $this->authors = $this->authorRepository->getAllAuthors();
    }

    public function render()
    {
        return view('livewire.book.filter-author');
    }
}
