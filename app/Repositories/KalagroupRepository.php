<?php

namespace App\Repositories;

// use App\Events\Models\Kalagroup\KalagroupCreated;
// use App\Events\Models\Kalagroup\KalagroupDeleted;
// use App\Events\Models\Kalagroup\KalagroupUpdated;
use App\Exceptions\GeneralJsonExecption;
use App\Models\Kalagroup;
use Illuminate\Support\Facades\DB;

class KalagroupRepository extends BaseRepository
{

    public function create($attributes)
    {
        return DB::transaction(function () use ($attributes) {
            $model = Kalagroup::query()->firstWhere('name', '=', data_get($attributes, 'name'));
            throw_if($model, GeneralJsonExecption::class, 'Failed to create new kalagroup,The record is duplicated');
            $created = Kalagroup::query()
                ->create([
                    'name' =>(string) data_get($attributes, 'name'),
                    'title' =>(string) data_get($attributes, 'title'),
                ]);
            throw_if(!$created, GeneralJsonExecption::class, 'Failed to create new kalagroup');
            // event(new KalagroupCreated($created));
            return $created;
        });
    }

    public function update($model, $attributes)
    {
        return DB::transaction(function () use ($model, $attributes) {

            $updated = $model->update([
                'title' =>(string) data_get($attributes, 'title', $model->title),
            ]);
            throw_if(!$updated, GeneralJsonExecption::class, 'Failed to update kalagroup');
            // event(new KalagroupUpdated($model));
            return $model;
        });
    }
    public function forceDelete($model)
    {
        return DB::transaction(function () use ($model) {
            $deleted = $model->forceDelete();

            throw_if(!$deleted, GeneralJsonExecption::class, 'can not delete kalagroup');
            // event(new KalagroupDeleted($model));
            return $deleted;
        });
    }
}
