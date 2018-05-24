<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    protected $fillable = ['first_name','last_name','company','email','password','street','apartment_no','house_no','zip_code','city','phone_no','NIP', 'status'];


}
