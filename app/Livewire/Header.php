<?php

namespace App\Livewire;

use App\Repositories\Interfaces\ICategoryRepository;
use Livewire\Component;

class Header extends Component
{
    public $categories;
    protected $categoryRepository;
    public function mount(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categories= $this->categoryRepository->getAllCategories();
    }

    public function logout(){
        auth()->logout();
    }
   
    public function render()
    {
        return view('livewire.header');
    }
}
