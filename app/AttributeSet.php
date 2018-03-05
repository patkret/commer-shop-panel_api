<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeSet extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'attribute_sets';

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
    protected $fillable = ['name', 'default_category'];

    public function attributes(){

       return $this->belongsToMany(Attribute::class, 'attribute_set_has_attribute');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'default_category');
    }

}
