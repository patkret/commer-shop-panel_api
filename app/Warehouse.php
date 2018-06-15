<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    protected $fillable = ['name'];

    use SoftDeletes;

    public function warehouseItems(){
        return $this->hasMany(WarehouseItem::class, 'warehouse_id');
    }

}
