<?php

namespace App\Http\Controllers;

use App\ProductAttribute;
use App\ProductType;
use Illuminate\Http\Request;
use App\ProductAttributeValue;

/**
 * Class ProductTypeController
 * @package App\Http\Controllers
 */
class ProductTypeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all()
    {
        return view('desktop.types',
            [
                'types' => ProductType::with('atts')->orderBy('id')->get()
            ]
        );
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('desktop.type.edit',
            [
                'type' => null,
                'attributes' => ProductAttribute::all(),
                'type_attributes' => []
            ]
        );
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, $message = '')
    {
        $type = ProductType::find($id);
        return view('desktop.type.edit',
            [
                'type' => $type,
                'attributes' => ProductAttribute::all(),
                'type_attributes' => $type->atts->keyBy('name')->pluck('id', 'name')->toArray(),
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
        $type = ProductType::find($id);
        $type->name = $request->get('name');
        $type->save();
        $type->updateAtts($request->get('attribute') ?: []);
        return $this->edit($id, 'Product type updated!');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function make(Request $request)
    {
        $type = new ProductType();
        $type->name = $request->get('name');
        $type->save();
        $type->setAtts($request->get('attribute'));
        return redirect('/product-type/edit/' . $type->id, 302)->with('message', 'Product type created!');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        ProductType::destroy($id);
        return redirect('/product-types', 302)->with('message', 'Product type deleted!');
    }
}
