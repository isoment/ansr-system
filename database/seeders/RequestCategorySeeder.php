<?php

namespace Database\Seeders;

use App\Models\RequestCategory;
use Illuminate\Database\Seeder;

class RequestCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RequestCategory::create([
            'name' => 'Plumbing'
        ]);

        RequestCategory::create([
            'name' => 'Electric'
        ]);

        RequestCategory::create([
            'name' => 'Appliance Repair'
        ]);

        RequestCategory::create([
            'name' => 'Structural'
        ]);

        RequestCategory::create([
            'name' => 'Misc'
        ]);
    }
}
