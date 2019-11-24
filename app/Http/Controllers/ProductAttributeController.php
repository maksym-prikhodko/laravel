<?php

namespace App\Http\Controllers;

use App\ProductAttribute;
use App\ProductAttributeValue;
use Illuminate\Http\Request;

/**
 * Class ProductAttributeController
 * @package App\Http\Controllers
 */
class ProductAttributeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all()
    {
        return view('desktop.attributes',
            ['attributes' => ProductAttribute::all()]
        );
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('desktop.attribute.edit',
            [
                'attribute' => null
            ]
        );
    }

    /**
     * @param $id
     * @param string $message
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, $message = '')
    {
        return view('desktop.attribute.edit',
            [
                'attribute' => ProductAttribute::find($id),
                'message' => $message
            ]
        );
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        ProductAttribute::find($id)->update('name', $request->get('name'));
        return $this->edit($id, "Attribute Updated");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function make(Request $request)
    {
        $attribute = new ProductAttribute();
        $attribute->name = $request->get('name');
        $attribute->save();
        return redirect('product-attribute/edit/'.$attribute->id, 302)->with('message', 'Attribute Created!');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        ProductAttribute::destroy($id);
//        ProductAttributeValue::where('attribute_id', $id)->delete();
        return redirect('/product-attributes', 302)->with('message', 'Product attribute deleted!');
    }
}
