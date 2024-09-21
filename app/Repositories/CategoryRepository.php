<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\ICategoryRepository;
use Illuminate\Support\Facades\Cache;

class CategoryRepository implements ICategoryRepository
{

    protected $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function getAllCategories()
    {
        return Cache::remember('categories', 120, function() {
            return  $this->model->get();
        });
    }
    
    public function getCategoryById($id){
        return  $this->model->findOrFail($id);
    }

}