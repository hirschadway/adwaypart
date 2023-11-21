<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKalaRequest;
use App\Http\Requests\UpdateKalaRequest;
use App\Http\Resources\KalaResource;
use App\Models\Kala;
use App\Repositories\KalaRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $shops = Kala::query()->paginate($request->page_size ?? 20);
        return KalaResource::collection($shops);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKalaRequest $request,KalaRepository $repository)
    {
        $created = $repository->create($request->only([
            'name',
            'images',
            'properties',
            'product_id',

        ]));
        return new KalaResource($created);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kala $kala)
    {
        return new KalaResource($kala);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKalaRequest $request, Kala $kala,KalaRepository $repository)
    {
        $updatedModel = $repository->update($kala, $request->only([
            'images',
            'properties',
            'product_id',

        ]));
        return new KalaResource($updatedModel);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kala $kala,KalaRepository $repository)
    {
        $repository->forceDelete($kala);

        return new JsonResponse([
            'data' => 'success',
        ]);
    }
}
