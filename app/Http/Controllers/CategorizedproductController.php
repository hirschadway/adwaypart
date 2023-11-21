<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategorizedproductRequest;
use App\Http\Requests\UpdateCategorizedproductRequest;
use App\Http\Resources\CategorizedproductResource;
use App\Http\Resources\GroupingResource;
use App\Models\Categorizedproduct;
use App\Models\Kalagroup;
use App\Repositories\CategorizedproductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class CategorizedproductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $models = Categorizedproduct::query()->paginate($request->page_size ?? 20);
        return CategorizedproductResource::collection($models);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategorizedproductRequest $request,CategorizedproductRepository $repository)
    {
        $created = $repository->create($request->only([
            'product_id',
            'kalagroup_id',
            'situation',
            'price',

        ]));
        return new CategorizedproductResource($created);
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorizedproduct $categorizedproduct)
    {
        return new CategorizedproductResource($categorizedproduct);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategorizedproductRequest $request, Categorizedproduct $categorizedproduct,CategorizedproductRepository $repository)
    {
        $updatedModel = $repository->update($categorizedproduct, $request->only([
            'product_id',
            'kalagroup_id',
            'situation',
            'price',
        ]));
        return new CategorizedproductResource($updatedModel);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorizedproduct $categorizedproduct,CategorizedproductRepository $repository)
    {
        $repository->forceDelete($categorizedproduct);

        return new JsonResponse([
            'data' => 'success',
        ]);
    }

     /**
     * Display a listing of the resource.
     */
    public function getGroup(Request $request,$groupname)
    {
            $id =Kalagroup::query()->where('name','=',Str::replace('_',' ',$groupname))->first()->id;
        $models = Categorizedproduct::query()->where('kalagroup_id','=',$id)->paginate($request->page_size ?? 20);
       return GroupingResource::collection($models);
    }

}
