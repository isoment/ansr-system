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
        // Create an employee for testing
        User::create([
            'id' => 1,
            'name' => 'Test Employee',
            'email' => 'employee@test.com',
            'userable_type' => 'App\Models\Employee',
            'userable_id' => 1,
            'password' => Hash::make('password'),
        ]);

        // Create a tenant for testing
        User::create([
            'id' => 2,
            'name' => 'Test Tenant',
            'email' => 'tenant@test.com',
            'userable_type' => 'App\Models\Tenant',
            'userable_id' => 1,
            'password' => Hash::make('password'),
        ]);
    }
}
