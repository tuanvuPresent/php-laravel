<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;
use App\TypeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //
        $product = DB::table('products')
            ->join('type_products', 'products.type_products_id', '=', 'type_products.type_products_id')
            ->select('products.*')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $product
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request)
    {
//        $rules = array(
//            'URL' => 'required|max:10'
//        );
//        $messages = array(
//            'URL.required' => 'URL is required.',
//            'URL.max' => 'URL is max.'
//        );
//        $validator = Validator::make( $request->all(), $rules, $messages );
//
//        if ( $validator->fails() )
//        {
//            return [
//                'success' => 0,
//                'message' => $validator->errors()->first()
//            ];
//        }
        //
        $nameProduct = $request->get('type_products_id');
        $typeProduct = TypeProduct::firstOrNew(['name' => $nameProduct]);
        $typeProduct->save();

        $request['type_products_id'] = $typeProduct->id ? $typeProduct->id : $typeProduct->type_products_id;
        $product = Product::create($request->all());

        return response()->json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        //
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if ($product) {
            $nameProduct = $request->get('type_products_id');
            $typeProduct = TypeProduct::firstOrNew(['name' => $nameProduct]);
            $typeProduct->save();

            $request['type_products_id'] = $typeProduct->id ? $typeProduct->id : $typeProduct->type_products_id;
            $product->update($request->all());
        }

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        //
        Product::destroy($id);
        return response()->json('delete success');
    }
}
