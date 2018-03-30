<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'vendor', 'vat_rate', 'category', 'price', 'weight', 'symbol', 'visibility','variant_set', 'description', 'product_variant_set_values'];

    protected $table = 'products';
}
