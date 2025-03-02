<?php

namespace App\Livewire\Components\Book;

use App\Repositories\Interfaces\IBookRepository;
use Livewire\Attributes\Computed;
use Livewire\Component;

class BestHistorical extends Component
{

    protected $bookRepository;
    public function mount(IBookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    #[Computed(persist: true)]
    public function books(){
        return $this->bookRepository->getBookByCategoryId(4, 10);
    }
    
    public function render()
    {
        return view('livewire.components.book.best-historical');
    }
}
