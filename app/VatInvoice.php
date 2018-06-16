<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VatInvoice extends Model
{
    protected $fillable = ['order_id', 'number', 'NIP', 'company', 'address'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
