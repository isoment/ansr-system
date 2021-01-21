<?php

namespace Database\Seeders;

use App\Models\WorkOrder;
use Illuminate\Database\Seeder;

class WorkOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WorkOrder::factory()->count(250)->create(['end_date' => NULL]);
    }
}
