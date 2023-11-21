<?php

namespace App\Repositories;

// use App\Events\Models\Kala\KalaCreated;
// use App\Events\Models\Kala\KalaDeleted;
// use App\Events\Models\Kala\KalaUpdated;
use App\Exceptions\GeneralJsonExecption;
use App\Models\Kala;
use Illuminate\Support\Facades\DB;

class KalaRepository extends BaseRepository
{

    public function create($attributes)
    {
        return DB::transaction(function () use ($attributes) {
            $model = Kala::query()->firstWhere('name', '=', data_get($attributes, 'name'));
            throw_if($model, GeneralJsonExecption::class, 'Failed to create new Kala,The record is duplicated');
            $created = Kala::query()
                ->create([
                    'name' =>(string) data_get($attributes, 'name'),
                    'img' =>(array) data_get($attributes, 'images'),
                    'properties' =>(array) data_get($attributes, 'properties'),
                    'product_id' =>(int) data_get($attributes, 'product_id'),
                ]);
            throw_if(!$created, GeneralJsonExecption::class, 'Failed to create new kala');
            // event(new KalaCreated($created));
            return $created;
        });
    }

    public function update($model, $attributes)
    {
        return DB::transaction(function () use ($model, $attributes) {

            $updated = $model->update([
                'img' =>(array) data_get($attributes, 'images',$model->img),
                'properties' =>(array) data_get($attributes, 'properties',$model->properties),
                'product_id' =>(int) data_get($attributes, 'product_id',$model->product_id),
            ]);
            throw_if(!$updated, GeneralJsonExecption::class, 'Failed to update kala');
            // event(new KalaUpdated($model));
            return $model;
        });
    }
    public function forceDelete($model)
    {
        return DB::transaction(function () use ($model) {
            $deleted = $model->forceDelete();

            throw_if(!$deleted, GeneralJsonExecption::class, 'can not delete kala');
            // event(new KalaDeleted($model));
            return $deleted;
        });
    }
}
