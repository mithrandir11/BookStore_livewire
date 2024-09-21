<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ICommentRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    protected $commentRepository;
    public function __construct(ICommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }


    public function index($commentableType, $commentableId)
    {
        $commentable = $this->findCommentable($commentableType, $commentableId);
        $comments = $this->commentRepository->getComments($commentable);
        return Response::success(null, $comments);
    }


    public function createComment(Request $request, $commentableType, $commentableId)
    {
        $validated = $request->validate([
            'body' => ['required','string'],
        ]);
        $validated['user_id'] = $request->user()->id;
        $commentable = $this->findCommentable($commentableType, $commentableId);
        $comment = $this->commentRepository->create($validated, $commentable);
        return Response::success('نظر شما با موفقیت ذخیره شد و پس از تایید منتشر میشود.', $comment);
    }

    protected function findCommentable($type, $id)
    {
        switch ($type) {
            case 'book':
                return \App\Models\Book::findOrFail($id);
            default:
                throw new \Exception('Invalid commentable type');
        }
    }
}
