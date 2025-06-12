<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Country;


class ManagerCreationTest extends TestCase
{

    use RefreshDatabase;

      public function test_authenticated_user_can_view_manager_creation_form(): void
    {
        $user = User::factory()->create();
        $user->manager()->delete(); // Delete any manager linked to this specific user.

        $response = $this->actingAs($user)->get(route('manager.create'));
                $response->dump(); // This will output the response headers and body to your terminal


        $response->assertStatus(200);
        $response->assertSee('Create Your Manager Profile');
    }

    public function test_authenticated_user_can_create_manager_with_valid_data(): void
    {
        $user = User::factory()->create(); // The user who will create the manager
        $country = Country::factory()->create(); // Need a country for the manager's nationality
    if (!$country) {
            // This case should ideally not happen if your seeders are working,
            // but it's a defensive check if you ever run tests without seeding.
            $this->fail('No countries found in the database to select for the test.');
        }

        $managerData = [
            'first_name' => 'Test',
            'middle_names' => 'M',
            'sur_name' => 'Manager',
            'date_of_birth' => '1980-01-01',
            'height' => 180,
            'weight' => 75,
            'country_id' => $country->id,
        ];

        $response = $this->actingAs($user)->post(route('manager.store'), $managerData);

        $response->assertStatus(302); // 302 is the HTTP status code for a redirect
        $response->assertRedirect(route('manager.show')); // Assert it redirects to the manager show page

        $this->assertDatabaseHas('managers', [
            'first_name' => 'Test',
            'sur_name' => 'Manager',
            'user_id' => $user->id, // Crucially, assert it's linked to the user!
            'country_id' => $country->id,
        ]);

        $this->assertNotNull($user->fresh()->manager); // Reload user to get fresh relationship state

        // Assert a success message is in the session (optional, but good for UX)
        $response->assertSessionHas('success', 'You are now a manager!');
    }

    public function test_manager_creation_fails_with_invalid_data(): void
    {
        // 1. Arrange:
        $user = User::factory()->create();
        // No country created, or we can send bad data for other fields
        // e.g., an empty first_name, date_of_birth in the future, invalid country_id

        $invalidManagerData = [
            'first_name' => '', // Invalid: required field missing
            'sur_name' => 'Invalid',
            'date_of_birth' => now()->addYear()->format('Y-m-d'), // Invalid: in the future (manager must be at least 18)
            'country_id' => 9999, // Invalid: country_id does not exist
        ];

        // 2. Act:
        $response = $this->actingAs($user)->post(route('manager.store'), $invalidManagerData);

        // 3. Assert:

        // Assert that the request failed with a 302 redirect back (due to validation errors)
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['first_name', 'country_id','date_of_birth', 'height','weight',]); // Assert specific fields have errors

        // Assert that no new manager was created in the database
        $this->assertDatabaseMissing('managers', [
            'user_id' => $user->id,
            'sur_name' => 'Invalid', // Look for unique identifier of this attempted creation
        ]);
        $this->assertNull($user->fresh()->manager); // Assert the user still has no manager
    }
}
