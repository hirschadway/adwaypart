<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKalagroupRequest;
use App\Http\Requests\UpdateKalagroupRequest;
use App\Http\Resources\KalagroupResource;
use App\Models\Kalagroup;
use App\Repositories\KalagroupRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KalagroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $shops = Kalagroup::query()->paginate($request->page_size ?? 20);
        return KalagroupResource::collection($shops);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKalagroupRequest $request, KalagroupRepository $repository)
    {
        $created = $repository->create($request->only([
            'name',
            'title',

        ]));
        return new KalagroupResource($created);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kalagroup $kalagroup)
    {
        return new KalagroupResource($kalagroup);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKalagroupRequest $request, Kalagroup $kalagroup,KalagroupRepository $repository)
    {
        $updatedModel = $repository->update($kalagroup, $request->only([
            'title',
        ]));
        return new KalagroupResource($updatedModel);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kalagroup $kalagroup,KalagroupRepository $repository)
    {
        $repository->forceDelete($kalagroup);

        return new JsonResponse([
            'data' => 'success',
        ]);
    }
}
