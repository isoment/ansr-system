<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Region;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::factory()->create([
            'id' => 1,
            'region_id' => Region::all()->random()->id,
            'first_name' => 'Test',
            'last_name' => 'Employee',
            'employee_id_number' => 'a8839910',
            'email' => 'employee@test.com',
        ]);

        Employee::factory()->times(48)->create();
    }
}
