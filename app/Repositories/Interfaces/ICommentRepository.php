<?php

namespace App\Repositories\Interfaces;

interface ICommentRepository
{
    public function create(array $data, $commentable);
    public function getComments($commentable);
}