<?php

namespace App\Livewire;

use App\Repositories\Interfaces\ICategoryRepository;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Header extends Component
{
    protected $categoryRepository;
    public function mount(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    #[Computed(cache: true)]
    public function categories(){
        return $this->categoryRepository->getAllCategories();
    }

    public function logout(){
        auth()->logout();
    }
   
    public function render()
    {
        return view('livewire.header');
    }
}
