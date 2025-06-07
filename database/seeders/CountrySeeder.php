<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{

    public function run(): void
    {

        $jsonPath = base_path('database/data/countries.json');
        $json = file_get_contents($jsonPath);
        $data = json_decode($json, true);
        foreach ($data as $country) {
            Country::firstOrCreate([
                'name' => $country['name'],
            ]);
        }

        $this->command->info('Countries seeded successfully!');
    }
}
