<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ProductCompose extends Model
{
    protected $casts = [
        'name' => 'string',
        'price' => 'float',
        'ingredients' => 'string',
        'requis' => 'integer',
        'image' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function translations()
    {
        return $this->morphMany('App\Model\Translation', 'translationable');
    }
}
