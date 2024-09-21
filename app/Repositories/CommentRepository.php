<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Interfaces\ICommentRepository;

class CommentRepository implements ICommentRepository
{

    protected $model;

    public function __construct(Comment $model)
    {
        $this->model = $model;
    }

    public function getComments($commentable)
    {
        return $commentable->comments()->latest()->get();
    }

    public function create(array $data, $commentable)
    {
        return $commentable->comments()->create($data);
    }

    

}