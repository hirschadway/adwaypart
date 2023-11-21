<?php

namespace App\Repositories;

// use App\Events\Models\Categorizedproduct\CategorizedproductCreated;
// use App\Events\Models\Categorizedproduct\CategorizedproductDeleted;
// use App\Events\Models\Categorizedproduct\CategorizedproductUpdated;
use App\Exceptions\GeneralJsonExecption;
use App\Models\Categorizedproduct;
use Illuminate\Support\Facades\DB;

class CategorizedproductRepository extends BaseRepository
{

    public function create($attributes)
    {
        return DB::transaction(function () use ($attributes) {
            // dd($attributes);
            $model = Categorizedproduct::query()->Where('product_id', '=', data_get($attributes, 'product_id'))
            ->where('kalagroup_id','=', data_get($attributes, 'kalagroup_id'))->first();
            throw_if($model, GeneralJsonExecption::class, 'Failed to create new categorizedproduct,The record is duplicated');
            $created = Categorizedproduct::query()
                ->create([
                    'product_id' =>(int) data_get($attributes, 'product_id'),
                    'kalagroup_id' =>(int) data_get($attributes, 'kalagroup_id'),
                    'situation' =>(int) data_get($attributes, 'situation'),
                    'price' =>(int) data_get($attributes, 'price'),
                ]);
            throw_if(!$created, GeneralJsonExecption::class, 'Failed to create new categorizedproduct');
            // event(new CategorizedproductCreated($created));
            return $created;
        });
    }

    public function update($model, $attributes)
    {
        return DB::transaction(function () use ($model, $attributes) {

            $updated = $model->update([
                'kala_id' =>(int) data_get($attributes, 'kala_id', $model->kala_id),
                'kalagroup_id' =>(int) data_get($attributes, 'kalagroup_id', $model->kalagroup_id),
                'price' =>(int) data_get($attributes, 'price', $model->price),
            ]);
            throw_if(!$updated, GeneralJsonExecption::class, 'Failed to update categorizedproduct');
            // event(new CategorizedproductUpdated($model));
            return $model;
        });
    }
    public function forceDelete($model)
    {
        return DB::transaction(function () use ($model) {
            $deleted = $model->forceDelete();

            throw_if(!$deleted, GeneralJsonExecption::class, 'can not delete categorizedproduct');
            // event(new CategorizedproductDeleted($model));
            return $deleted;
        });
    }
}
