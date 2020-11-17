<?php

namespace Database\Seeders;

use App\Models\WorkDetails;
use Illuminate\Database\Seeder;

class WorkDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WorkDetails::factory()->count(425)->create();
    }
}
