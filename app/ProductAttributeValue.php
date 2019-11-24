<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductAttributeValue
 * @package App
 */
class ProductAttributeValue extends Model
{
    /**
     * @var string
     */
    protected $table = "product_attribute_value";
    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['product_id', 'attribute_id', 'value', 'attr_name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->hasOne('App\Product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attr()
    {
        return $this->belongsTo('App\ProductAttribute', 'attribute_id', 'id');
    }

    /**
     * @return mixed
     */
    public function getAttrNameAttribute()
    {
        return $this->attr->name;
    }
}
