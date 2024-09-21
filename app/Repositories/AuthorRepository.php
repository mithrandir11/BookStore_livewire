<?php

namespace App\Repositories;

use App\Models\Author;
use App\Repositories\Interfaces\IAuthorRepository;
use Illuminate\Support\Facades\Cache;

class AuthorRepository implements IAuthorRepository
{

    protected $model;

    public function __construct(Author $model)
    {
        $this->model = $model;
    }

    public function getAllAuthors()
    {
        return Cache::remember('authors', 120, function() {
            return  $this->model->get();
        });
    }

}