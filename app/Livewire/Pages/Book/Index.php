<?php

namespace App\Livewire\Pages\Book;

use App\Repositories\Criteria\Filter;
use App\Repositories\Criteria\Sort;
use App\Repositories\Interfaces\IBookRepository;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    public $sort_by='latest';
    public $filters=[];
    protected $bookRepository;
    public function mount(IBookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function hydrate(IBookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function setSortBy($sortBy)
    {
        $this->sort_by = $sortBy;
        $this->setPage(1);
    }

    #[On('publisher-change')] 
    public function handlePublisherChange($publisher_id) {
        $this->filters['publisher_id'] = $publisher_id;
        $this->setPage(1);
    }

    #[On('author-change')] 
    public function handleAuthorChange($author_id) {
        $this->filters['author_id'] = $author_id;
        $this->setPage(1);
    }
    
    public function render()
    {
        return view('livewire.pages.book.index',[
            'books' => $this->bookRepository->withCriteria([
                new Sort($this->sort_by),
                new Filter($this->filters),
            ])->getAllBooks(20)
        ]);
    }
}
