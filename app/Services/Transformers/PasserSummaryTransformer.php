<?php

namespace App\Services\Transformers;

use App\Services\Transformers\Transformer;

class PasserSummaryTransformer extends Transformer
{
    protected $resourceName = 'passerSummary';

    public function transform($data)
    {
        return [
            'school'      => $data['school'],
            'total'     => $data['passer_count']
        ];
    }
}
