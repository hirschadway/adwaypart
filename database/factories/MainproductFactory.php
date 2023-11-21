<?php

namespace Database\Factories;

use App\Models\Productcategory;
use Database\Factories\Helpers\FactoryHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mainproduct>
 */
class MainproductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imgs =[];
        for ($i=0; $i < 3; $i++) { 
            $imgs[]=$this->faker->unique()->imageUrl();
        }
        return [
            'code'=>$this->faker->unique()->currencyCode(),
            'name'=>$this->faker->unique()->jobTitle(),
            'link'=>$this->faker->unique()->url(),
            'img'=>$imgs,
            'productcategory_id'=>FactoryHelper::getRandomModelId(Productcategory::class),
            'properties'=>[],
        ];
    }
}
