<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Staff extends Authenticatable
{
    use Notifiable;

    protected $table = 'staff';
    protected $primaryKey = 'staff_number';
    public $timestamps = false;

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'staff_number',
        'role_id',
        'email',
        'password',
        'first_name',
        'last_name',
        'position',
        'sex'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}