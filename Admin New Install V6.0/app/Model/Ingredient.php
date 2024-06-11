<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $casts = [
        'name' => 'string',
        'price' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function translations()
    {
        return $this->morphMany('App\Model\Translation', 'translationable');
    }
}
