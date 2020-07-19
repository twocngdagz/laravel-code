<?php

namespace App;

use App\Services\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Passer extends Model
{
    use Filterable;

    protected $fillable = [
        'name', 'school', 'campus', 'division'
    ];
}
