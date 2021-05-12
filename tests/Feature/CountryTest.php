<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Country;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CountryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_country_screen_can_not_be_rendered_for_unloggedin_user()
    {
        $response = $this->get('/countries');

        $response->assertRedirect('/login');
    }

    public function test_country_screen_can_be_rendered_for_loggedin_user()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->get('/countries');

        $response->assertStatus(200);
    }

    public function test_user_can_create_country()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->get('/countries/create');

        $response = $this->post('/countries', [
            'name' => 'Test Country',
            'country_code' => 'TC',
        ]);

        $response->assertRedirect('/countries');
    }

    public function test_user_can_update_country()
    {
        $user = User::factory()->create();
        $country = Country::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->get('/countries/' . $country->id . '/edit');

        $response = $this->put('/countries/' . $country->id, [
            'name' => 'Test Country 1',
            'country_code' => 'TC',
        ]);

        $response->assertRedirect('/countries');
    }

    public function test_user_can_delete_country()
    {
        $user = User::factory()->create();
        $country = Country::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->delete('/countries/' . $country->id);

        $response->assertRedirect('/countries');
    }
}
