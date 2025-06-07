<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\League;
use App\Models\Country;

class LeagueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {

        $jsonPath = base_path('database/data/leagues.json');
        $json = file_get_contents($jsonPath);
        $data = json_decode($json, true);
        foreach ($data as $league) {

            $country = Country::where('name', $league['country'])->first();

            if (!$country) {
                $this->command->warn("Country '{$league['country']}' not found for league '{$league['name']}'. Skipping.");
                continue; // Skip this league if country doesn't exist
            }

            $countryID = $country->id;

            League::firstOrCreate([
                'name' => $league['name'],
                'level' => $league['level'],
                'country_id' => $countryID,
            ]);
        }

        $this->command->info('Leagues seeded successfully!');
    }
}
