<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call(MainproductSeeder::class);         //A
        $this->call(ShopSeeder::class);         //A
        $this->call(KalagroupSeeder::class);     //A
        $this->call(ProductcategorySeeder::class);  //A
        $this->call(ProductSeeder::class);          //B
        $this->call(KalaSeeder::class);          //B
        // $this->call(CategorizedproductSeeder::class);     //C
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
