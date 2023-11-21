<?php

namespace Database\Seeders;

use App\Models\Mainproduct;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MainproductSeeder extends Seeder
{
    use TruncateTable;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->truncate('mainproducts');
        Mainproduct::factory(5)->create();
    }
}
