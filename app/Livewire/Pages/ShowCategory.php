<?php

namespace App\Livewire\Pages;

use App\Models\Book;
use App\Repositories\Criteria\Filter;
use App\Repositories\Criteria\Sort;
use App\Repositories\Interfaces\IBookRepository;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCategory extends Component
{
    use WithPagination;
    
    public $sort_by='latest';
    public $filters=[];
    public $categoryId;
    protected $bookRepository;
    public function mount(IBookRepository $bookRepository, $id)
    {
        $this->bookRepository = $bookRepository;
        $this->categoryId = $id;
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
        return view('livewire.pages.show-category',[
            'books' => $this->bookRepository->withCriteria([
                new Sort($this->sort_by),
                new Filter($this->filters),
            ])->getBookByCategoryId($this->categoryId, 12)
        ]);
    }
}
