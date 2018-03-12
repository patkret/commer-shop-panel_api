<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VariantGroup extends Model
{
    protected $fillable = ['name', 'variants'];

    protected $table = 'variant_groups';

}
