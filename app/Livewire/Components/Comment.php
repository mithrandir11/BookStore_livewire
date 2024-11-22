<?php

namespace App\Livewire\Components;

use App\Repositories\Interfaces\IBookRepository;
use App\Repositories\Interfaces\ICommentRepository;
use Livewire\Component;

class Comment extends Component
{
    public $comments, $book_id;//from parent

    public $body;

    public function createComment(ICommentRepository $commentRepository, IBookRepository $bookRepository)
    {
        $data = $this->validate([
            'body' => ['required','string'],
        ]);
       

        try {
            $data['user_id'] = auth()->user()->id;
            $commentable = $bookRepository->getBookById($this->book_id);
            $commentRepository->create($data, $commentable);
        } catch (\Throwable $th) {
            session()->flash('error', 'مشکلی رخ داده است');
        }
        
        session()->flash('success', 'نظر شما ثبت شد و پس بازبینی منتشر میشود');
        $this->reset('body');
    }

    public function render()
    {
        return view('livewire.components.comment');
    }
}
