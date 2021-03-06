<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RegionSeeder::class,
            PropertySeeder::class,
            LeaseSeeder::class,
            TenantSeeder::class,
            EmployeeSeeder::class,
            RequestCategorySeeder::class,
            ServiceRequestSeeder::class,
            WorkOrderSeeder::class,
            WorkDetailsSeeder::class,
            UserSeeder::class,
            PropertyListingSeeder::class,
        ]);
    }
}
