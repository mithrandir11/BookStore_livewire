<?php

namespace App\Repositories;

use App\Models\Publisher;
use App\Repositories\Interfaces\IPublisherRepository;
use Illuminate\Support\Facades\Cache;

class PublisherRepository implements IPublisherRepository
{

    protected $model;

    public function __construct(Publisher $model)
    {
        $this->model = $model;
    }

    public function getAllPublishers()
    {
        return Cache::remember('publishers', 120, function() {
            return  $this->model->get();
        });
    }

}