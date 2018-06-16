<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;


   protected $fillable = ['shipping_method_id', 'payment_method_id', 'user_id', 'client_id', 'discount_threshold_id', 'status'];


    public function shippingMethod()
    {

        return $this->belongsTo(ShippingMethod::class);
    }

    public function paymentMethod()
    {

        return $this->belongsTo(PaymentMethod::class);
    }

    public function discountThreshold()
    {

        return $this->belongsTo(DiscountThreshold::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}
