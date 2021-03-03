<?php

namespace Database\Seeders;

use App\Models\Lease;
use Illuminate\Database\Seeder;

class LeaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lease::factory()->times(225)->create();
    }
}
