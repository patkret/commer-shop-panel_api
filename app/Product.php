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
            'barcode_simple',
            'wholesale_price',
            'weight_unit'];


    protected $table = 'products';

    private $module_id = 2;

    public function getModIdAttribute($value)
    {

        return $this->module_id;
    }

    public function categories()
    {

        return $this->belongsToMany(Category::class, 'product_has_category');
    }

    public function stock()
    {
        return $this->belongsTo(Warehouse::class, 'stock');
    }

    public function vendor()
    {
        return $this->hasOne(Vendor::class, 'id', 'vendor');
    }

    public function vatRate()
    {
        return $this->hasOne(VatRate::class, 'id', 'vat_rate');
    }

    public function mainCategory()
    {
        return $this->hasOne(Category::class, 'id', 'main_category');
    }

    public function relatedProducts()
    {
        return $this->belongsToMany(Product::class, 'product_has_related_product', 'product_id', 'related_product_id');
    }

}
