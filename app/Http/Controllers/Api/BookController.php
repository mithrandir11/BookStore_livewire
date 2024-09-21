<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\Filter;
use App\Repositories\Criteria\Sort;
use App\Repositories\Interfaces\IBookRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    protected $bookRepository;

    public function __construct(IBookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function index(Request $request)
    {
        $filters = [
            'author_id' => $request->input('author_id'),
            'publisher_id' => $request->input('publisher_id'),
        ];
        $sort_by = $request->query('sort_by', 'latest');

        $books = $this->bookRepository->withCriteria([
            new Sort($sort_by),
            new Filter($filters),
        ])->getAllBooks(20);

        $pagination = [
            'currentPage' => $books->currentPage(),
            'lastPage' => $books->lastPage(),
            'total' => $books->total(),
            'perPage' => $books->perPage(),
        ];
        return Response::success(null, BookResource::collection($books), $pagination);
    }

    public function findById($id)
    {
        $books = $this->bookRepository->getBookById($id);
        return Response::success(null, new BookResource($books));
    }

    public function findByIds(Request $request)
    {
        $ids = explode(',', $request->ids);
       
        $books = $this->bookRepository->getBooksByIds($ids);
        return  BookResource::collection($books);
    }

    public function findByCategoryId(Request $request, $id)
    {
        $filters = [
            'author_id' => $request->input('author_id'),
            'publisher_id' => $request->input('publisher_id'),
        ];
        $sort_by = $request->query('sort_by', 'latest');

        $books = $this->bookRepository->withCriteria([
            new Sort($sort_by),
            new Filter($filters),
        ])->getBookByCategoryId($id);

        $pagination = [
            'currentPage' => $books->currentPage(),
            'lastPage' => $books->lastPage(),
            'total' => $books->total(),
            'perPage' => $books->perPage(),
        ];
        return Response::success(null, BookResource::collection($books), $pagination);
    }

    public function bestSellers(){
        $books = $this->bookRepository->getBestSellersBooks(10);
        return Response::success(null, BookResource::collection($books));
    }

    public function latest(){
        $books = $this->bookRepository->getLatestBooks(10);
        return Response::success(null, BookResource::collection($books));
    }

    public function relatedBooks(){
        $books = $this->bookRepository->getLatestBooks(10);
        return Response::success(null, BookResource::collection($books));
    }


    public function search(Request $request){
        $request->validate([
            'query' => ['required', 'min:3']
        ]);
        $query = $request->input('query');
        $books = $this->bookRepository->search($query);
        return Response::success(null, BookResource::collection($books));
    }

    public function sortedBooks(Request $request)
    {
        $sort_by = $request->query('sort_by', 'latest');
        $books = $this->bookRepository->getBooksSortBy($sort_by, 20);
        $pagination = [
            'currentPage' => $books->currentPage(),
            'lastPage' => $books->lastPage(),
            'total' => $books->total(),
            'perPage' => $books->perPage(),
        ];

        return Response::success(null, BookResource::collection($books), $pagination);
    }

}
