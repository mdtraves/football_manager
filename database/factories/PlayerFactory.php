<?php

namespace Database\Factories;
use App\Models\Player; // Import your Player model
use App\Models\Team;   // Import your Team model
use App\Models\Country; // Import your Country model
use App\Models\League; // Import your Country model
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    protected $model = Player::class;

    public function definition(): array
    {

        $teamIds = Team::pluck('id')->all();
        $countryIds = Country::pluck('id')->all();

        // Fallback for when no teams/countries exist (e.g., during initial setup or tests)
        if (empty($teamIds)) {
            // Create a dummy team if none exist
            $country = Country::firstOrCreate(['name' => 'Default Country']);
            $team = Team::firstOrCreate([
                'name' => 'Default Team',
                'league_id' => League::firstOrCreate(['name' => 'Default League', 'level' => 1, 'country_id' => $country->id])->id,
                'country_id' => $country->id
            ]);
            $teamIds = [$team->id];
            $countryIds = [$country->id];
        }

        // If for some reason countries are still empty (shouldn't happen with the above fallback)
        if (empty($countryIds)) {
            $country = Country::firstOrCreate(['name' => 'Default Country']);
            $countryIds = [$country->id];
        }

        // Generate a random date of birth that makes sense for a football player (e.g., 18-35 years old)
        $dateOfBirth = $this->faker->dateTimeBetween('-35 years', '-18 years')->format('Y-m-d');
        $contractEndDate = $this->faker->dateTimeBetween('+1 year', '+5 years')->format('Y-m-d');


        return [
             'first_name' => $this->faker->firstName('male'),
            'middle_names' => $this->faker->boolean(20) ? $this->faker->lastName() : null, // 20% chance of having a middle name
            'sur_name' => $this->faker->lastName(),
            'position' => $this->faker->randomElement(['GK', 'CB', 'LB', 'RB', 'LWB', 'RWB', 'CM', 'CDM', 'CAM', 'LM', 'RM', 'LW', 'RW', 'ST']),
            'footed' => $this->faker->randomElement(['Left', 'Right', 'Both']),
            'injured' => $this->faker->boolean(10), // 10% chance of being injured

            // Assign random team_id and country_id from existing records
            'team_id' => $this->faker->randomElement($teamIds),
            'country_id' => $this->faker->randomElement($countryIds),

            'overall_rating' => $this->faker->numberBetween(50, 99), // Ratings from 50 to 99
            'height' => $this->faker->numberBetween(165, 205), // height in cm
            'weight' => $this->faker->numberBetween(60, 95), // weight in kg

            'value' => $this->faker->numberBetween(1000000, 150000000), // Player value in game currency
            'weekly_wage' => $this->faker->numberBetween(5000, 300000), // Weekly wage

            'date_of_birth' => $dateOfBirth,
            'contract_end_date' => $contractEndDate,
        ];
    }
}
