<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Team;
use App\Models\Manager;

class ManagerSeeder extends Seeder
{

    public function run(): void
    {

        $teams = Team::all();

        if( $teams->isEmpty()  ) {
            $this->command->warn("No teams or teams found. Skipping manager seeding.");
            return;
        }

        $teams->each(function ($team) {
            Manager::factory()->create([
                'team_id' => $team->id,
            ]);
        });

        $this->command->info('Managers seeded successfully using factories!');
    }
}
