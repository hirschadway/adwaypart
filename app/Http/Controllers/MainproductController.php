<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMainproductRequest;
use App\Http\Requests\UpdateMainproductRequest;
use App\Http\Resources\MainproductResource;
use App\Models\Mainproduct;
use App\Repositories\MainproductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MainproductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $shops = Mainproduct::query()->paginate($request->page_size ?? 20);
        return MainproductResource::collection($shops);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMainproductRequest $request,MainproductRepository $repository)
    {
        $created = $repository->create($request->only([
            'code',
            'name',
            'link',
            'images',
            'properties',
            'category_id',

        ]));
        return new MainproductResource($created);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mainproduct $mainproduct)
    {
        return new MainproductResource($mainproduct);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMainproductRequest $request, Mainproduct $mainproduct,MainproductRepository $repository)
    {
        $updatedModel = $repository->update($mainproduct, $request->only([
            'name',
            'link',
            'images',
            'properties',
            'category_id',
        ]));
        return new MainproductResource($updatedModel);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mainproduct $mainproduct,MainproductRepository $repository)
    {
        $repository->forceDelete($mainproduct);

        return new JsonResponse([
            'data' => 'success',
        ]);
    }
}
