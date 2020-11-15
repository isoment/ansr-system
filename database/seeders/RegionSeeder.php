<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::create([
            'region_name' => 'New Glasro Metro',
            'slug' => 'NGR',
        ]);

        Region::create([
            'region_name' => 'Falkland City Metro',
            'slug' => 'FLC',
        ]);

        Region::create([
            'region_name' => 'Transnistria Metro',
            'slug' => 'TNM',
        ]);

        Region::create([
            'region_name' => 'Franhaven Metro',
            'slug' => 'FRH',
        ]);

        Region::create([
            'region_name' => 'San Benizo Metro',
            'slug' => 'SBN',
        ]);
    }
}
