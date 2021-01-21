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
        Lease::factory()->times(175)->create();

        Lease::factory()->times(95)->create(['end_date' => NULL]);
    }
}
