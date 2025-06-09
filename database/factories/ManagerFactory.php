<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Manager;
use App\Models\Team;
use App\Models\Country;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manager>
 */
class ManagerFactory extends Factory
{
    protected $model = Manager::class;

    public function definition(): array
    {

    $countryIds = Country::pluck('id')->all();

    // If for some reason countries are still empty (shouldn't happen with the above fallback)
    if (empty($countryIds)) {
        $country = Country::firstOrCreate(['name' => 'Default Country']);
        $countryIds = [$country->id];
    }

    $dateOfBirth = $this->faker->dateTimeBetween('-75 years', '-35 years')->format('Y-m-d'); // Managers are typically older
    $contractEndDate = $this->faker->dateTimeBetween('+1 year', '+5 years')->format('Y-m-d');
        return [
            'first_name' => $this->faker->firstName(),
            'middle_names' => $this->faker->boolean(10) ? $this->faker->lastName() : null, // Less likely to have middle names
            'sur_name' => $this->faker->lastName(),
            'date_of_birth' => $dateOfBirth,
            'height' => $this->faker->numberBetween(160, 195), // Manager height in cm
            'weight' => $this->faker->numberBetween(65, 90), // Manager weight in kg
            'weekly_wage' => $this->faker->numberBetween(10000, 500000), // Manager's salary
            'contract_end_date' => $contractEndDate,
            'user_id' => null,
            'team_id' => null,
            'country_id' => $this->faker->randomElement($countryIds),
        ];
    }
}
