<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable =
        [
            'name',
            'symbol',
            'barcode',
            'pkwiuCode',
            'weight',
            'height',
            'width',
            'depth',
            'vendor',
            'visibility',
            'vat_rate',
            'shortDescription',
            'longDescription',
            'price',
            'stock',
            'stockAvail',
            'attributeSets',
            'variantSets',
            'selectedVariantSet',
            'main_category'];


    protected $table = 'products';

    public function categories(){

        return $this->belongsToMany(Category::class, 'product_has_category');
    }

    public function products(){

        return $this->belongsToMany(Product::class, 'product_has_related_product');
    }
}
