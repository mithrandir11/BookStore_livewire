<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Repositories\Interfaces\ICategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    protected $categoryRepository;
    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(){
        $categories= $this->categoryRepository->getAllCategories();
        return Response::success(null, CategoryResource::collection($categories));
    }

    public function findById($id)
    {
        $category = $this->categoryRepository->getCategoryById($id);
        return new CategoryResource($category);
    }
}
