<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;
use App\TypeProduct;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class ProductController extends Controller
{
    private function custom_response($data = null, $message = 'success')
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $product = Product::with('type_products:id,name')->get();
        return $this->custom_response($product);
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
        return DB::transaction(function () use ($request) {
            $nameProduct = $request->get('type_products');
            $typeProduct = TypeProduct::firstOrNew(['name' => $nameProduct]);
            $typeProduct->save();

            $request['type_products_id'] = $typeProduct->id;
            $product = Product::create($request->all());

            return $this->custom_response($product, 'create success');
        });
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $product = Product::with('type_products:id,name')->findOrFail($id);
        return $this->custom_response($product);
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
            $nameProduct = $request->get('type_products');
            $typeProduct = TypeProduct::firstOrNew(['name' => $nameProduct]);
            $typeProduct->save();

            $request['type_products_id'] = $typeProduct->id;
            $product->update($request->all());
        }

        return $this->custom_response($product, 'update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return $this->custom_response(null, 'delete success');
    }
}
