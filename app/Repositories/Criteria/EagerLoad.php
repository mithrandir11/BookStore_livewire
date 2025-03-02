<?php

namespace App\Repositories\Criteria;

use Illuminate\Database\Eloquent\Builder;

class EagerLoad implements ICriterion
{
    protected $relations;

    public function __construct($relations)
    {
        $this->relations = is_array($relations) ? $relations : func_get_args();
    }

    public function apply(Builder $query): Builder
    {
        return $query->with($this->relations); 
    }
}
