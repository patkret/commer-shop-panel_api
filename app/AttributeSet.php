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
    protected $fillable = ['name', 'attributes', 'visibility'];

    public $module_id = 5;

    public function categories() {
        return $this->belongsToMany(Category::class, 'attribute_set_has_category');
    }

    public function getModIdAttribute($value) {

        return $this->module_id;
    }
}
