<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingDetail extends Model
{
    use SoftDeletes;

    protected $fillable = ['first_name', 'last_name', 'company', 'street', 'house_no', 'apartment_no', 'zip_code', 'city', 'client_id'];

    protected $table = 'shipping_details';

    public function client() {

        return $this->belongsTo(Client::class);
    }
}
