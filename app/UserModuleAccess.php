<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModuleAccess extends Model
{
    protected $fillable = [
        'user_id', 'module_id', 'access_rights'
    ];

}
