<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class IngCategory extends Model
{
    protected $casts = [
        'status' => 'integer',
        'parent_id' => 'integer',
        'status' => 'integer'
    ];

    public function translations()
    {
        return $this->morphMany('App\Model\Translation', 'translationable');
    }

    public function parent()
    {
        return $this->belongsTo(IngCategory::class, 'parent_id');
    }
}
