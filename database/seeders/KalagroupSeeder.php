<?php

namespace Database\Seeders;

use App\Models\Kalagroup;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KalagroupSeeder extends Seeder
{
    use TruncateTable;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->truncate('kalagroups');
     Kalagroup::factory(4)->create();
    }
}
