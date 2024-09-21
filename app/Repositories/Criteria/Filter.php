<?php

namespace App\Repositories\Criteria;

use Illuminate\Database\Eloquent\Builder;

class Filter implements ICriterion
{
    protected $filters;

    public function __construct($filters)
    {
        // $this->filters =  $filters ;
        $this->filters = is_array($filters) ? $filters : func_get_args();
    }

    public function apply(Builder $query): Builder
    {
        return $query->filterIn($this->filters);
    }
}
