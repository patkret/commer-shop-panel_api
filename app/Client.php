<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['first_name','last_name','company','email','password','street','apartment_no','house_no','zip_code','city','phone_no','NIP'];
}
