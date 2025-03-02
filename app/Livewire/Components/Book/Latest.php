<?php

namespace App\Livewire\Components\Book;

use App\Repositories\Interfaces\IBookRepository;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Latest extends Component
{
    protected $bookRepository;
    public function mount(IBookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    #[Computed(persist: true)]
    public function books(){
        return $this->bookRepository->getLatestBooks(10);
    }
    
    public function render()
    {
        return view('livewire.components.book.latest');
    }
}
