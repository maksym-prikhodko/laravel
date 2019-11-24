<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App
 */
class Product extends Model
{
    /**
     * @var string
     */
    protected $table = "product";
    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['sku', 'type', 'product_atts', 'product_type_atts'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function productType()
    {
        return $this->hasOneThrough(
            'App\ProductType',
            'App\PivotProductType',
            'product_id',
            'id',
            'id',
            'type_id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function productTypeWithAttributes()
    {
        return $this->hasOneThrough(
            'App\ProductType',
            'App\PivotProductType',
            'product_id',
            'id',
            'id',
            'type_id'
        )->with('atts');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productAttributes()
    {
        return $this->hasMany(
            'App\ProductAttributeValue', 'product_id'
        )->with('attr');
    }

    /**
     * @return mixed
     */
    public function getTypeAttribute()
    {
        return isset($this->productType->name) ? $this->productType->name : '';
    }

    /**
     * @return array
     */
    public function getProductAttsAttribute()
    {
        if (isset($this->productTypeWithAttributes->atts)) {
            return
                array_merge(
                    $this->productTypeWithAttributes->atts->keyBy('name')->pluck('attr_value', 'name')->toArray(),
                    $this->productAttributes->keyBy('attr_name')->pluck('value', 'attr_name')->toArray());
        } else {
            return $this->productAttributes->keyBy('attr_name')->pluck('value', 'attr_name')->toArray();
        }
    }

    /**
     * @return mixed
     */
    public function getProductTypeAttsAttribute()
    {
        return isset($this->productTypeWithAttributes->atts) ? $this->productTypeWithAttributes->atts : null;
    }

    /**
     * @param $type
     * @return int
     */
    public function setType($type)
    {
        if (count($this->productType()->get())) {
            return $this->productType()->rawUpdate(['type_id' => $type]);
        } else {
            return ProductType::find($type)->product()->attach($this->id);
        }

    }

    /**
     * @param $request
     * @return bool
     * @throws \Exception
     */
    public function setAtts($request)
    {
        if ($this->product_type_atts) {
            foreach ($this->productAttributes as $attribute) {
                if (!in_array(
                        $attribute->attribute_id,
                        array_keys($this->product_type_atts->keyBy('id')->toArray())
                    ) || !$request->get($attribute->name)) {
                    $attribute->delete();
                }
            }
            foreach ($this->product_type_atts as $attribute) {
                if ($request->get($attribute->name)) {
                    if (isset($this->productAttributes->keyBy('attribute_id')[$attribute->id])) {
                        $this->productAttributes->keyBy('attribute_id')[$attribute->id]->value = $request->get($attribute->name);
                        $this->productAttributes->keyBy('attribute_id')[$attribute->id]->save();
                    } else {
                        ProductAttributeValue::create(
                            [
                                'product_id' => $this->id,
                                'attribute_id' => $attribute->id,
                                'value' => $request->get($attribute->name)
                            ]
                        );
                    }
                }
            }
        }
        return true;
    }

    /**
     * @param $request
     * @return mixed
     */
    public static function search($request)
    {
        $request = array_clean($request->all(), ['', null, false, [], 0, '0']);
        $query = self::select(['product.id', 'product.sku']);

        if (isset($request['sku'])) {
            $query->where('sku', 'like', '%' . $request['sku'] . '%');
        }

        if (isset($request['type'])) {
            $query->leftJoin('p_t', 'product.id', '=', 'p_t.product_id')
                ->where('p_t.type_id', $request['type']);
        }

        if (isset($request['attributes'])) {
            $query->leftJoin('product_attribute_value', 'product.id', '=', 'product_attribute_value.product_id')
                ->where(function ($query) use ($request) {
                    foreach ($request['attributes'] as $attribute_id => $attribute) {
                        $query->orWhere([
                            ['product_attribute_value.attribute_id', $attribute_id],
                            ['product_attribute_value.value', 'like', '%' . $attribute . '%']
                        ]);
                    }
                });
        }
        return $query->groupBy('product.id')->paginate(9);
    }
}
