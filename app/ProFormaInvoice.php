<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProFormaInvoice extends Model
{
    protected $fillable = ['order_id', 'number', 'NIP', 'company', 'address'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
