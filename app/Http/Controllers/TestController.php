<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use App\Product;
use App\TypeProduct;

class TestController extends Controller
{
    public function index()
    {
        $products = Product::with('type_products')->get();
        return view('products.list')->with('products', $products);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(TestRequest $request)
    {
        $nameProduct = $request->get('type_products');
        $typeProduct = TypeProduct::firstOrNew(['name' => $nameProduct]);
        $typeProduct->save();

        $request['type_products_id'] = $typeProduct->id;
        $product = Product::create($request->all());

        return redirect(route('test.index'));
    }

    public function show($id)
    {
        $products = Product::find($id);
        return view('products.edit')->with('products', $products);
    }

    public function edit($id)
    {
        $products = Product::find($id);
        return view('products.edit')->with('products', $products);
    }

    public function update(TestRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        if ($product) {
            $nameProduct = $request->get('type_products');
            $typeProduct = TypeProduct::firstOrNew(['name' => $nameProduct]);
            $typeProduct->save();

            $request['type_products_id'] = $typeProduct->id;
            $product->update($request->all());
        }

        return redirect(route('test.index'));
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect(route('test.index'));
    }
}
