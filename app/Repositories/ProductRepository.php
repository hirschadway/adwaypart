<?php

namespace App\Repositories;

// use App\Events\Models\Product\ProductCreated;
// use App\Events\Models\Product\ProductDeleted;
// use App\Events\Models\Product\ProductUpdated;
use App\Exceptions\GeneralJsonExecption;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository
{

    public function create($attributes)
    {
        return DB::transaction(function () use ($attributes) {
            $model = Product::query()->firstWhere('name', '=', data_get($attributes, 'name'));
            throw_if($model, GeneralJsonExecption::class, 'Failed to create new Product,The record is duplicated');
            $created = Product::query()
                ->create([
                    'name' =>(string) data_get($attributes, 'name'),
                    'img' =>(array) data_get($attributes, 'images'),
                    'link' =>(string) data_get($attributes, 'link'),
                    'situation' =>(bool) data_get($attributes, 'situation',true),
                    'price' => (int)data_get($attributes, 'price',0),
                    'properties' =>(array) data_get($attributes, 'properties'),
                    'mainproduct_id' =>(int) data_get($attributes, 'main_id'),
                    'shop_id' =>(int) data_get($attributes, 'shop_id'),
                ]);
            throw_if(!$created, GeneralJsonExecption::class, 'Failed to create new product');
            // event(new ProductCreated($created));
            return $created;
        });
    }

    public function update($model, $attributes)
    {
        return DB::transaction(function () use ($model, $attributes) {

            $updated = $model->update([
                    'img' =>(array) data_get($attributes, 'images',$model->img),
                    'link' => (string) data_get($attributes, 'link',$model->link),
                    'situation' => (bool)data_get($attributes, 'situation',$model->situation),
                    'price' => (int) data_get($attributes, 'price',$model->price),
                    'properties' => (array) data_get($attributes, 'properties',$model->properties),
                    'mainproduct_id' => (int) data_get($attributes, 'main_id',$model->mainproduct_id),
                    'shop_id' => (int) data_get($attributes, 'shop_id',$model->shop_id),
            ]);
            throw_if(!$updated, GeneralJsonExecption::class, 'Failed to update product');
            // event(new ProductUpdated($model));
            return $model;
        });
    }
    public function forceDelete($model)
    {
        return DB::transaction(function () use ($model) {
            $deleted = $model->forceDelete();

            throw_if(!$deleted, GeneralJsonExecption::class, 'can not delete product');
            // event(new ProductDeleted($model));
            return $deleted;
        });
    }
}
