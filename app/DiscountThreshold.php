<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountThreshold extends Model
{
    protected $fillable = ['name', 'type', 'discount_value', 'threshold'];

}
