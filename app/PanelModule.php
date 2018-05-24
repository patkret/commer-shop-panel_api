<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PanelModule extends Model
{
    protected $fillable = ['name'];

    protected $table = 'panel_modules';
}
