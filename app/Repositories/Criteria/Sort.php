<?php

namespace App\Repositories\Criteria;

use Illuminate\Database\Eloquent\Builder;

class Sort implements ICriterion
{
    protected $sort_by;

    public function __construct($sort_by)
    {
        $this->sort_by =  $sort_by ;
    }

    public function apply(Builder $query): Builder
    {
        return $query->sort($this->sort_by);
    }
}
