<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductcategoryRequest;
use App\Http\Requests\UpdateProductcategoryRequest;
use App\Http\Resources\ProductcategoryResource;
use App\Models\Productcategory;
use App\Repositories\ProductcategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $models = Productcategory::query()->paginate($request->page_size ?? 20);
        return ProductcategoryResource::collection($models);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductcategoryRequest $request,ProductcategoryRepository $repository)
    {
        $created = $repository->create($request->only([
            'name',
            'title',
            'description',
            'parent_id',

        ]));
        return new ProductcategoryResource($created);
    }

    /**
     * Display the specified resource.
     */
    public function show(Productcategory $productcategory)
    {
        return new ProductcategoryResource($productcategory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductcategoryRequest $request, Productcategory $productcategory,ProductcategoryRepository $repository)
    {
        $updatedModel = $repository->update($productcategory, $request->only([
            'title',
            'description',
            'parent_id',

        ]));
        return new ProductcategoryResource($updatedModel);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Productcategory $productcategory,ProductcategoryRepository $repository)
    {
        $repository->forceDelete($productcategory);

        return new JsonResponse([
            'data' => 'success',
        ]);
    }
}
