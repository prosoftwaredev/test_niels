<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([[
            'name' => 'United States',
            'country_code' => 'US'
        ],
        [
            'name' => 'United Kingdom',
            'country_code' => 'UK'
        ],
        [
            'name' => 'South Africa',
            'country_code' => 'SA'
        ],
        [
            'name' => 'France',
            'country_code' => 'FR'
        ],
        [
            'name' => 'Argentina',
            'country_code' => 'AR'
        ]]);
    }
}
