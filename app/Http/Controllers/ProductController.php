<?php

namespace App\Http\Controllers;

use App\Product as ProductModel;
use App\ProductAttribute;
use App\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all()
    {
        $products = ProductModel::with(['productAttributes', 'productTypeWithAttributes'])
            ->orderBy('product.id')
            ->paginate(9);

        $types = ProductType::all();
        $attributes = ProductAttribute::all();
        return view(
            'desktop.collection',
            [
                'products' => $products,
                'types' => $types,
                'attributes' => $attributes,
                'is_search' => false
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
        $product = ProductModel::with(['productAttributes', 'productTypeWithAttributes'])->findOrFail($id);
        $types = ProductType::all();
        return view(
            'desktop.product.edit',
            [
                'product' => $product,
                'type' => $product->type,
                'attributes' => $product->product_atts,
                'types' => $types,
                'message' => $message
            ]
        );
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $types = ProductType::all();
        return view(
            'desktop.product.edit',
            [
                'product' => null,
                'type' => null,
                'attributes' => null,
                'types' => $types
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
        $product = ProductModel::find($id);
        $product->sku = $request->get('sku');
        $product->setType($request->get('type'));
        $product->setAtts($request);
        $product->save();
        return $this->edit($id, 'Saved!');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function make(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sku' => 'required|unique:product|',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'SKU already exists');
        }
        $product = new ProductModel();
        $product->sku = $request->get('sku');
        $product->save();
        ProductType::find($request->get('type'))->product()->attach($product->id);
        return redirect('/product/edit/' . $product->id, 302)->with('message', 'Product Created!');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $products = ProductModel::search($request);
        $types = ProductType::all();
        $attributes = ProductAttribute::all();
        return view(
            'desktop.collection',
            [
                'products' => $products,
                'types' => $types,
                'attributes' => $attributes,
                'is_search' => true
            ]
        );
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        ProductModel::destroy($id);
        return redirect('/products', 302)->with('message', 'Product type deleted!');
    }
}
