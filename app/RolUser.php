<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolUser extends Model
{
    protected $table = 'role_user';

    protected $fillable = [
        'role_id', 'user_id'
    ];
}
