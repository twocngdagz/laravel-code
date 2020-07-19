<?php

namespace App\Services\Filters;

use App\Services\Filters\FullTextFilter;
use Illuminate\Support\Facades\DB;

class PasserFilter extends Filter
{
    use FullTextFilter;

    protected $searchable = [
        'name',
        'school',
        'division'
    ];

    protected function passer($name)
    {
        $passer = Passer::whereName($name)->first();

        $passerId = $passer ? $passer->id : null;

        return $this->builder->wherePasserId($passerId);
    }

    protected function summary()
    {
        return $this->builder->select("school", DB::raw("count(*) AS passer_count"))->groupBy("school");
    }
}
