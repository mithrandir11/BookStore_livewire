<?php

namespace App\Repositories;

use App\Models\Book;
use App\Repositories\Interfaces\IBookRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class BookRepository implements IBookRepository
{
    protected $model;

    public function __construct(Book $model)
    {
        $this->model = $model;
    }

    public function getAllBooks($perPage = 10)
    {
        // return Cache::remember('books_page_' . request('page', 1), 120, function() use ($perPage) {
            return  $this->model->paginate($perPage);
        // });
    }

    public function getBookById($id){
        return  $this->model->findOrFail($id);
    }

    public function getBooksByIds($data){
        return $this->model->whereIn('id', $data)->get();
    }

    public function getBookByCategoryId($id, $perPage = 10){
        return  $this->model->where('category_id', $id)->paginate($perPage);
    }

    public function getBestSellersBooks($limit = 10)
    {
        return $this->model->sort('best_seller')->take($limit)->get();
    }


    public function getLatestBooks($limit = 10)
    {
        // return Cache::remember("latest_books_{$limit}", 120, function() use ($limit) {
            return  $this->model->latest()->take($limit)->get();
        // });
    }


    public function search(string $query)
    {
        return $this->model->where('title', 'like', "%$query%")
            ->orWhereHas('author', function ($q) use ($query) {
                $q->where('name', 'like', "%$query%");
            })
            ->orWhereHas('translator', function ($q) use ($query) {
                $q->where('name', 'like', "%$query%");
            })
            ->get();
    }

    
    public function getBooksSortBy($sort_by, $perPage = 10)
    {
        return $this->model->sort($sort_by)->paginate($perPage);
    }



    public function withCriteria(array $criteria)
    {
        $query = $this->model->newQuery(); 

        foreach ($criteria as $criterion) {
            $query = $criterion->apply($query);
        }

        $this->model = $query;

        return $this;
    }

}