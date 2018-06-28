<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    public const MODULE_ID = 1;

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

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
    protected $fillable = ['name', 'photo', 'visibility', 'parent_id', 'order_no', 'page_title', 'description'];

    public function attributeSets(){
        return $this->belongsToMany(AttributeSet::class, 'attribute_set_has_category');
    }
}
