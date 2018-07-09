<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = ['name', 'description', 'logo', 'is_visible'];

    protected $table = 'vendors';
}
