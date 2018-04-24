<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehouseItem extends Model
{
    protected $fillable = ['warehouse_id', 'price', 'group_id', 'added_at'];

    protected $table = 'warehouse_items';
}
