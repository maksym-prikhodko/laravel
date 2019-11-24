<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductAttribute
 * @package App
 */
class ProductAttribute extends Model
{
    /**
     * @var string
     */
    protected $table = "product_attribute";
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function type()
    {
        return $this->belongsToMany('App\ProductType', 't_a', 'attribute_id', 'type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function product()
    {
        return $this->hasOneThrough('App\Product', 'App\ProductType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function values()
    {
        return $this->hasMany('App\ProductAttributeValue', 'attribute_id');
    }

}
