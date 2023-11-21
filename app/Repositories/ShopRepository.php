<?php

namespace App\Repositories;

use App\Events\Models\Shop\ShopCreated;
use App\Events\Models\Shop\ShopDeleted;
use App\Events\Models\Shop\ShopUpdated;
use App\Exceptions\GeneralJsonExecption;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;

class ShopRepository extends BaseRepository
{

    public function create($attributes)
    {
        return DB::transaction(function () use ($attributes) {
            // dd($attributes);
            $model = Shop::query()->firstWhere('name', '=', data_get($attributes, 'name'));
            throw_if($model, GeneralJsonExecption::class, 'Failed to create new Shop,The record is duplicated');
            $created = Shop::query()
                ->create([
                    'name' => (string)data_get($attributes, 'name'),
                    'title' => (string)data_get($attributes, 'title'),
                    'properties' => (array)data_get($attributes, 'properties'),
                ]);
            throw_if(!$created, GeneralJsonExecption::class, 'Failed to create new Shop');
            // event(new ShopCreated($created));
            return $created;
        });
    }

    public function update($model, $attributes)
    {
        return DB::transaction(function () use ($model, $attributes) {

            $updated = $model->update([
                'title' => (string)data_get($attributes, 'title', $model->title),
                'properties' => (array)data_get($attributes, 'properties', $model->properties),
            ]);
            throw_if(!$updated, GeneralJsonExecption::class, 'Failed to update shop');
            // event(new ShopUpdated($model));
            return $model;
        });
    }
    public function forceDelete($model)
    {
        return DB::transaction(function () use ($model) {
            $deleted = $model->forceDelete();

            throw_if(!$deleted, GeneralJsonExecption::class, 'can not delete shop');
            // event(new ShopDeleted($model));
            return $deleted;
        });
    }
}
