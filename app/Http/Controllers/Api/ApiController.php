<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Paginate\Paginate;
use App\Services\Transformers\Transformer;
use Illuminate\Support\Collection;

class ApiController extends Controller
{
    protected $transformer = null;

    protected function respond($data, $statusCode = 200, $headers = [])
    {
        return response()->json($data, $statusCode, $headers);
    }

    protected function respondWithTransformer($data, $statusCode = 200, $headers = [])
    {
        $this->checkTransformer();

        if ($data instanceof Collection) {
            $data = $this->transformer->collection($data);
        } else {
            $data = $this->transformer->item($data);
        }

        return $this->respond($data, $statusCode, $headers);
    }

    protected function respondWithPagination($paginated, $statusCode = 200, $headers = [])
    {
        $this->checkPaginated($paginated);

        $this->checkTransformer();

        $data = $this->transformer->paginate($paginated);

        return $this->respond($data, $statusCode, $headers);
    }

    protected function respondSuccess()
    {
        return $this->respond(null);
    }

    private function checkPaginated($paginated)
    {
        if (! $paginated instanceof Paginate) {
            throw new \Exception('Expected instance of Paginate');
        }
    }

    private function checkTransformer()
    {
        if ($this->transformer === null || ! $this->transformer instanceof Transformer) {
            throw new \Exception('Invalid data transformer');
        }
    }
}
