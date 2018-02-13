<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VatRate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vat_rates';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['rate', 'description', 'name'];

    
}
