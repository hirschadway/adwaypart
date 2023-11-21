<?php

namespace Database\Factories;

use App\Models\Product;
use Database\Factories\Helpers\FactoryHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kala>
 */
class KalaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->unique()->colorName(),
            'img'=>[],
            'properties'=>[],
            'product_id'=>FactoryHelper::getRandomModelId(Product::class),
        ];
    }
}
