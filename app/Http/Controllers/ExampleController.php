<?php

namespace App\Http\Controllers;

use App\Example;
use App\Http\Requests\ExamplePostRequest;
use App\Http\Requests\ExamplePutRequest;
use App\Http\Resources\ExampleGetListResource;
use App\Http\Resources\ExampleGetResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExampleController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //
        $examples = Example::all();
        return $this->responseSuccess(ExampleGetListResource::collection($examples));
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
     * @param ExamplePostRequest $request
     * @return \Illuminate\Http\Response
//     */
    public function store(ExamplePostRequest $request)
    {
        //
        return DB::transaction(function () use ($request) {
            $example = Example::create($request->all());
            return $this->responseSuccess($example);
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
        //
        $example = Example::find($id);
        if (!$example) {
            return $this->responseError(null, 'Not found');
        }
        return $this->responseSuccess(ExampleGetResource::make($example));
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
     * @param ExamplePutRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ExamplePutRequest $request, $id)
    {
        //
        $example = Example::find($id);
        if (!$example) {
            return $this->responseError(null, 'Not found');
        }
        $example->update($request->all());

        return $this->responseSuccess($example);
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
        $example = Example::find($id);
        if ($example) {
            $example->delete();
        }
        return $this->responseSuccess();
    }
}
