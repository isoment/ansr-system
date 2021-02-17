<?php

namespace Database\Seeders;

use App\Models\PropertyListing;
use Illuminate\Database\Seeder;

class PropertyListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PropertyListing::factory()->times(45)->create();
    }
}
