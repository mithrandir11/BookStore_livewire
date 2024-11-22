<?php

namespace App\Livewire\Slider;

use App\Repositories\Interfaces\IBookRepository;
use Livewire\Attributes\Computed;
use Livewire\Component;

class RelatedBooks extends Component
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
        return view('livewire.slider.related-books');
    }
}
