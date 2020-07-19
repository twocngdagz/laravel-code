<?php

namespace App\Services\Transformers;

use App\Services\Transformers\Transformer;

class PasserTransformer extends Transformer
{
    protected $resourceName = 'passer';

    public function transform($data)
    {
        return [
            'id'        => $data['id'],
            'name'      => $data['name'],
            'campus'    => $data['campus'],
            'school'    => $data['school'],
            'division'  => $data['division'],
        ];
    }
}
