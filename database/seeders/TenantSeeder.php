<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tenant::factory()->create([
            'id' => 1,
            'first_name' => 'Test',
            'last_name' => 'Tenant',
            'email' => 'tenant@test.com',
        ]);

        Tenant::factory()->times(373)->create();
    }
}
