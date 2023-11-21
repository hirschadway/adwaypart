<?php

namespace Database\Factories\Helpers;

class FactoryHelper
{

    /**
     * This method will get a random model id from the database
     * @param string | HasFactory $model
     */
    public static function getRandomModelId(string $model)
    {
        // get model count
        $count = $model::query()->count();

        // if model count is zero ,we should create a new record and retrieve the record id
        if ($count === 0) {
            return $model::factory()->create()->id;
        }
        // generate random number between 1 and model acount
        while (true) {
            $model_id = rand(1, $count);
            if ($model::find($model_id)) {
                return $model_id;
            }
        }
    }
}
