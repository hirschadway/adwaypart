<?php

namespace Database\Factories;

use App\Models\Mainproduct;
use App\Models\Productcategory;
use App\Models\Shop;
use Database\Factories\Helpers\FactoryHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->unique()->jobTitle(),
            'link'=>$this->faker->url(),
            'img'=>[],
            'price' =>$this->faker->numberBetween(0,1000000),
            'situation'=>$this->faker->boolean(80),
            'properties'=>[],
            'mainproduct_id'=>FactoryHelper::getRandomModelId(Mainproduct::class),
            'shop_id'=>FactoryHelper::getRandomModelId(Shop::class),

        ];
    }
}
