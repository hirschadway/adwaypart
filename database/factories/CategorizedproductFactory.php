<?php

namespace Database\Factories;

use App\Models\Kalagroup;
use App\Models\Product;
use Database\Factories\Helpers\FactoryHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categorizedproduct>
 */
class CategorizedproductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
     
        return [
            'price'=>$this->faker->numberBetween(),
            'situation'=>$this->faker->boolean(80),
            'product_id'=>FactoryHelper::getRandomModelId(Product::class),
            'kalagroup_id'=>FactoryHelper::getRandomModelId(Kalagroup::class),
        ];
    }
}
