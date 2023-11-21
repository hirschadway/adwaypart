<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected Model $model;

    /**
     * @param array $attributes
     * @return Model
     */
    
    abstract public function create(array $attributes);

    /** 
     * @param Model $model
     * @param array $attributes
     * @return Model
     */
    abstract public function update($model, array $attributes);

    /** 
     * @param Model $model
     * @return Model
     */
    abstract public function forceDelete($model);
}
