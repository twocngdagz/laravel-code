<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\CreatePasser;
use App\Passer;
use App\Services\Filters\PasserFilter;
use App\Services\Paginate\Paginate;
use App\Services\Transformers\PasserTransformer;

class PasserController extends ApiController
{
    public function __construct(PasserTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function index(PasserFilter $filter)
    {
        $passers = new Paginate(Passer::filter($filter));

        return $this->respondWithPagination($passers);
    }

    public function store(CreatePasser $request)
    {
        $passer = Passer::create([
            'name' => $request->input('passer.name'),
            'school' => $request->input('passer.school'),
            'campus' => $request->input('passer.campus'),
            'division' => $request->input('passer.division')
        ]);

        return $this->respondWithTransformer($passer);
    }
}
