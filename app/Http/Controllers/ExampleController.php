<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExamplePostRequest;
use App\Http\Requests\ExamplePutRequest;
use App\Http\Resources\ExampleGetListResource;
use App\Http\Resources\ExampleGetResource;
use App\Repositories\Example\IExampleRepository;
use Illuminate\Support\Facades\DB;

class ExampleController extends Controller
{
    use ApiResponse;
    protected $exampleRepository;
    public function __construct(IExampleRepository $exampleRepository)
    {
        $this->exampleRepository = $exampleRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //
        $examples = $this->exampleRepository->getAll();
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
            $example = $this->exampleRepository->create($request->all());
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
        $example = $this->exampleRepository->find($id);
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
        $example = $this->exampleRepository->update($id, $request->all());
        if (!$example) {
            return $this->responseError(null, 'Not found');
        }
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
        $this->exampleRepository->delete($id);
        return $this->responseSuccess();
    }
}
