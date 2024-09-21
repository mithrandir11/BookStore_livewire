<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\IPublisherRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PublisherController extends Controller
{
    protected $publisherRepository;
    public function __construct(IPublisherRepository $publisherRepository)
    {
        $this->publisherRepository = $publisherRepository;
    }

    public function index(){
        $publishers= $this->publisherRepository->getAllPublishers();
        return Response::success(null, $publishers);
    }
}
