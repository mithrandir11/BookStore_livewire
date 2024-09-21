<?php

namespace App\Livewire\Book;

use App\Repositories\Interfaces\IPublisherRepository;
use Livewire\Component;

class FilterPublisher extends Component
{
    public $publishers;
    protected $publisherRepository;
    public function mount(IPublisherRepository $publisherRepository)
    {
        $this->publisherRepository = $publisherRepository;
        $this->publishers = $this->publisherRepository->getAllPublishers();
    }

    public function render()
    {
        return view('livewire.book.filter-publisher');
    }
}
