<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Formule extends Model
{
    protected $fillable = ['name', 'price', 'requis'];
}
