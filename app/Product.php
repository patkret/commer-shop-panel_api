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
            'intoStockPrice',
            'stock',
            'stockAvail',
            'attributeSets',
            'variantSets',
            'selectedVariantSet'];


    protected $table = 'products';

    public function categories(){

        return $this->belongsToMany(Category::class, 'product_has_category');
    }
}
