<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::query()->paginate($request->page_size ?? 20);
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request, ProductRepository $repository)
    {
        $created = $repository->create($request->only([
            'name',
            'images',
            'link',
            'situation',
            'price',
            'properties',
            'main_id',
            'shop_id',

        ]));
        return new ProductResource($created);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product, ProductRepository $repository)
    {
        $updatedModel = $repository->update($product, $request->only([
            'images',
            'link',
            'situation',
            'price',
            'properties',
            'main_id',
            'shop_id',
        ]));
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, ProductRepository $repository)
    {
        $repository->forceDelete($product);

        return new JsonResponse([
            'data' => 'success',
        ]);
    }
}
