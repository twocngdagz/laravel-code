<?php

namespace App\Http\Requests\Api;

use App\Http\Request\Api\ApiRequest;

class CreatePasser extends ApiRequest
{
    protected function validationData()
    {
        return $this->get('passer') ?: [];
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'school' => 'required',
            'campus' => 'required',
            'division' => 'required',
        ];
    }
}
