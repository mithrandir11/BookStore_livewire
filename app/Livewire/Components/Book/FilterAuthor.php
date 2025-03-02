<?php

namespace App\Livewire\Components\Book;

use App\Repositories\Interfaces\IAuthorRepository;
use Livewire\Attributes\Computed;
use Livewire\Component;

class FilterAuthor extends Component
{
    protected $authorRepository;
    public function mount(IAuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    #[Computed(persist: true)]
    public function authors(){
        return $this->authorRepository->getAllAuthors();
    }

    public function render()
    {
        return view('livewire.components.book.filter-author');
    }
}
