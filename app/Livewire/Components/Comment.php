<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Comment extends Component
{
    public $comments, $book_id;
    public function render()
    {
        return view('livewire.components.comment');
    }
}
