<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientDiscount extends Model
{
    protected $fillable= ['client_id', 'vendor_id', 'discount_value', 'is_percentage'];

    protected $table = 'client_discounts';
}
