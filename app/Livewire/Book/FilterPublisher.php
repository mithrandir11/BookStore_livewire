<?php

namespace App\Livewire\Book;

use App\Repositories\Interfaces\IPublisherRepository;
use Livewire\Attributes\Computed;
use Livewire\Component;

class FilterPublisher extends Component
{
    protected $publisherRepository;
    public function mount(IPublisherRepository $publisherRepository)
    {
        $this->publisherRepository = $publisherRepository;
    }

    #[Computed(persist: true)]
    public function publishers(){
        return $this->publisherRepository->getAllPublishers();
    }

    public function render()
    {
        return view('livewire.book.filter-publisher');
    }
}
