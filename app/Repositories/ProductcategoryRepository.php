<?php

namespace App\Repositories;

// use App\Events\Models\Productcategory\ProductcategoryCreated;
// use App\Events\Models\Productcategory\ProductcategoryDeleted;
// use App\Events\Models\Productcategory\ProductcategoryUpdated;
use App\Exceptions\GeneralJsonExecption;
use App\Models\Productcategory;
use Illuminate\Support\Facades\DB;

class ProductcategoryRepository extends BaseRepository
{

    public function create($attributes)
    {
        return DB::transaction(function () use ($attributes) {
            $model = Productcategory::query()->firstWhere('name', '=', data_get($attributes, 'name'));
            throw_if($model, GeneralJsonExecption::class, 'Failed to create new productcategory,The record is duplicated');
            $created = Productcategory::query()
                ->create([
                    'name' => (string)data_get($attributes, 'name'),
                    'title' => (string)data_get($attributes, 'title'),
                    'description' => (string)data_get($attributes, 'description'),
                    'parent_id' => (int)data_get($attributes, 'parent_id', 0),
                ]);
            throw_if(!$created, GeneralJsonExecption::class, 'Failed to create new Productcategory');
            // event(new ProductcategoryCreated($created));
            return $created;
        });
    }

    public function update($model, $attributes)
    {
        return DB::transaction(function () use ($model, $attributes) {

            $updated = $model->update([
                'title' => (string) data_get($attributes, 'title', $model->title),
                'description' => (string) data_get($attributes, 'description', $model->description),
                'parent_id' => (int) data_get($attributes, 'parent_id', $model->parent_id),
            ]);
            throw_if(!$updated, GeneralJsonExecption::class, 'Failed to update productcategory');
            // event(new ProductcategoryUpdated($model));
            return $model;
        });
    }
    public function forceDelete($model)
    {
        return DB::transaction(function () use ($model) {
            $deleted = $model->forceDelete();

            throw_if(!$deleted, GeneralJsonExecption::class, 'can not delete productcategory');
            // event(new ProductcategoryDeleted($model));
            return $deleted;
        });
    }
}
