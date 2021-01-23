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
        // Create a Manager Employee
        Employee::factory()->create([
            'id' => 1,
            'region_id' => Region::all()->random()->id,
            'first_name' => 'Test',
            'last_name' => 'Manager',
            'role' => 'Management',
            'employee_id_number' => 'm8839910',
            'email' => 'manager@test.com',
        ]);

        // Create a Administrative Employee
        Employee::factory()->create([
            'id' => 2,
            'region_id' => Region::all()->random()->id,
            'first_name' => 'Test',
            'last_name' => 'Administrative',
            'role' => 'Administrative',
            'employee_id_number' => 'a7483294',
            'email' => 'administrative@test.com',
        ]);

        // Create a Maintenance Employee
        Employee::factory()->create([
            'id' => 3,
            'region_id' => Region::all()->random()->id,
            'first_name' => 'Test',
            'last_name' => 'Maintenance',
            'role' => 'Maintenance',
            'employee_id_number' => 'm8326123',
            'email' => 'maintenance@test.com',
        ]);

        Employee::factory()->times(48)->create();
    }
}
