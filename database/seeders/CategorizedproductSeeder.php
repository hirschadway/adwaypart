<?php

namespace Database\Seeders;

use App\Models\Categorizedproduct;
use App\Models\Kala;
use App\Models\Kalagroup;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorizedproductSeeder extends Seeder
{
    use TruncateTable;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->truncate('categorizedproducts');
        $kala_count= Kala::count();
        $kalagroup_count= Kalagroup::count();
        Categorizedproduct::factory($kala_count*$kalagroup_count)->create();
    }
}
