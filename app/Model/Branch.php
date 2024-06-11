<?php

namespace App\Model;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Branch extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'name', 'l_name', 'email', 'status', 'blocked_until','image'

    ];

    protected $dates = [
        'blocked_until'
    ];
}
