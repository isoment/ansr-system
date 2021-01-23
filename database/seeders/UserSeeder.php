<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a tenant for testing
        User::create([
            'id' => 1,
            'name' => 'Test Tenant',
            'email' => 'tenant@test.com',
            'userable_type' => 'App\Models\Tenant',
            'userable_id' => 1,
            'password' => Hash::make('password'),
        ]);

        // Create a Manager Employee
        User::create([
            'id' => 2,
            'name' => 'Test Manager',
            'email' => 'manager@test.com',
            'userable_type' => 'App\Models\Employee',
            'userable_id' => 1,
            'password' => Hash::make('password'),
        ]);

        // Create a Administrative Employee
        User::create([
            'id' => 3,
            'name' => 'Test Administrative',
            'email' => 'administrative@test.com',
            'userable_type' => 'App\Models\Employee',
            'userable_id' => 2,
            'password' => Hash::make('password'),
        ]);

        // Create a Maintenance Employee
        User::create([
            'id' => 4,
            'name' => 'Test Maintenance',
            'email' => 'maintenance@test.com',
            'userable_type' => 'App\Models\Employee',
            'userable_id' => 3,
            'password' => Hash::make('password'),
        ]);
    }
}
