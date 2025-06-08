<?php

namespace Database\Seeders;
use App\Models\Player;
use App\Models\Country;
use App\Models\Team;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{

    public function run(): void
    {

        $teams = Team::all();
        $countries = Country::all();

        if( $teams->isEmpty() || $countries->isEmpty() ) {
            $this->command->warn("No teams or countries found. Skipping player seeding.");
            return;
        }

        $teams->each(function ($team) use ($countries) {
            Player::factory(30)->create([
                'team_id' => $team->id,
            ]);
        });

        $this->command->info('Players seeded successfully using factories!');


    }
}
