<?php

namespace App\Livewire;

use App\Repositories\Interfaces\IBookRepository;
use Livewire\Component;

class SearchBox extends Component
{
    public $query = '';
    public $books= [];

    public function updatedQuery(IBookRepository $bookRepository)
    {
        if (strlen($this->query) >= 3) {
            $this->books = $bookRepository->search($this->query);
        } else {
            $this->books = [];
        }
    }

    public function render()
    {
        return view('livewire.search-box');
    }
}
