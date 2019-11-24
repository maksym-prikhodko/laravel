<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductType
 * @package App
 */
class ProductType extends Model
{
    /**
     * @var string
     */
    protected $table = "product_type";
    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function product()
    {
        return $this->belongsToMany(
            'App\Product',
            'p_t',
            'type_id',
            'product_id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function atts()
    {
        return $this->belongsToMany(
            'App\ProductAttribute',
            't_a',
            'type_id',
            'attribute_id',
            ''
        );
    }

    /**
     * @param $atts
     */
    public function setAtts($atts)
    {
        if (count($atts)) {
            foreach ($atts as $attr) {
                $this->atts()->attach($attr);
            }
        }
    }

    /**
     * @param $atts
     */
    public function updateAtts($atts){
        $toRemove = array_diff($this->atts->pluck('id')->toArray(), $atts);
        $toAdd = array_diff($atts, $this->atts->pluck('id')->toArray());

        if (count($toAdd)) {
            foreach ($toAdd as $item) {
                $this->atts()->attach($item);
            }
        }
        if (count($toRemove)) {
            foreach ($toRemove as $item) {
                $this->atts()->detach($item);
            }
            ProductAttributeValue::whereIn('product_id', $this->product()->pluck('id'))
                ->whereIn('attribute_id', $toRemove)
                ->delete();
        }
    }

}
