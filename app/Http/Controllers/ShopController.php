<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Http\Resources\ShopResource;
use App\Models\Shop;
use App\Repositories\ShopRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $models = Shop::query()->paginate($request->page_size ?? 20);
        return ShopResource::collection($models);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShopRequest $request,ShopRepository $repository)
    {
        $created = $repository->create($request->only([
            'name',
            'title',
            'properties',

        ]));
        return new ShopResource($created);
    }

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
        return new ShopResource($shop);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShopRequest $request, Shop $shop, ShopRepository $repository)
    {
        $updatedModel = $repository->update($shop, $request->only([
            'title',
            'properties',

        ]));
        return new ShopResource($updatedModel);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop, ShopRepository $repository)
    {
        $repository->forceDelete($shop);

        return new JsonResponse([
            'data' => 'success',
        ]);
    }
}
