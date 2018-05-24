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
            'main_category',
            'barcode_simple'];


    protected $table = 'products';

    private $module_id = 2;

    public function getModIdAttribute($value) {

        return $this->module_id;
    }

    public function categories(){

        return $this->belongsToMany(Category::class, 'product_has_category');
    }

    public function products(){

        return $this->belongsToMany(Product::class, 'product_has_related_product');
    }
}
