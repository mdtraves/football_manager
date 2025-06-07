<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\League;
use App\Models\Country;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $jsonPath = base_path('database/data/teams.json');
        $json = file_get_contents($jsonPath);
        $data = json_decode($json, true);
        foreach ($data as $team) {

            $country = Country::where('name', $team['country'])->first();
            $league = League::where('name', $team['league'])->first();

            if (!$country) {
                $this->command->warn("Country '{$team['country']}' not found for league '{$team['name']}'. Skipping.");
                continue; // Skip this team if country doesn't exist
            }
            if (!$league) {
                $this->command->warn("League '{$team['league']}' not found for league '{$team['name']}'. Skipping.");
                continue; // Skip this team if league doesn't exist
            }

            $countryID = $country->id;
            $leagueID = $league->id;

            Team::firstOrCreate([
                'name' => $team['name'],
                'manager_name' => $team['manager_name'],
                'overall_rating' => $team['overall_rating'],
                'country_id' => $countryID,
                'league_id' => $leagueID,
            ]);
        }

        $this->command->info('Teams seeded successfully!');
    }
}
