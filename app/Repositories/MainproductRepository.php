<?php

namespace App\Repositories;

// use App\Events\Models\Mainproduct\MainproductCreated;
// use App\Events\Models\Mainproduct\MainproductDeleted;
// use App\Events\Models\Mainproduct\MainproductUpdated;
use App\Exceptions\GeneralJsonExecption;
use App\Models\Mainproduct;
use Illuminate\Support\Facades\DB;

class MainproductRepository extends BaseRepository
{

    public function create($attributes)
    {
        return DB::transaction(function () use ($attributes) {
            $model = Mainproduct::query()->firstWhere('code', '=', data_get($attributes, 'code'));
            throw_if($model, GeneralJsonExecption::class, 'Failed to create new mainproduct,The record is duplicated');
            $code =(string)data_get($attributes, 'code');
            throw_if($code ==='', GeneralJsonExecption::class, 'code should be a string with value');

            $created = Mainproduct::query()
                ->create([
                    'code' => $code,
                    'name' => (string) data_get($attributes, 'name'),
                    'link' => (string)data_get($attributes, 'link'),
                    'img' => (array)data_get($attributes, 'images'),
                    'properties' => (array)data_get($attributes, 'properties'),
                    'productcategory_id' => (int)data_get($attributes, 'category_id'),
                ]);
            throw_if(!$created, GeneralJsonExecption::class, 'Failed to create new mainproduct');
            // event(new MainproductCreated($created));
            return $created;
        });
    }

    public function update($model, $attributes)
    {
        return DB::transaction(function () use ($model, $attributes) {

            $updated = $model->update([
                'name' => (string)data_get($attributes, 'name', $model->name),
                'link' => (string)data_get($attributes, 'link', $model->link),
                'img' => (array)data_get($attributes, 'images', $model->img),
                'properties' => (array)data_get($attributes, 'properties', $model->properties),
                'productcategory_id' => (int)data_get($attributes, 'category_id', $model->productcategory_id),
            ]);
            throw_if(!$updated, GeneralJsonExecption::class, 'Failed to update mainproduct');
            // event(new MainproductUpdated($model));
            return $model;
        });
    }
    public function forceDelete($model)
    {
        return DB::transaction(function () use ($model) {
            $deleted = $model->forceDelete();

            throw_if(!$deleted, GeneralJsonExecption::class, 'can not delete mainproduct');
            // event(new MainproductDeleted($model));
            return $deleted;
        });
    }
}
