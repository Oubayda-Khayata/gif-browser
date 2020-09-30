<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    /**
     * Test user authentication functionalities.
     *
     * @return void
     */
    public function testAuthenticationTest()
    {
        // Signup test
        $response = $this->post('/api/signup', [
            'firstname' => 'Oubayda',
            'lastname' => 'Khayata',
            'email' => 'oubaydakhayata@gmail.com',
            'password' => 'my secure password'
        ], [
            'api-key' => env('API_KEY')
        ]);


        $response->assertStatus(200);


        // Login test

        $response = $this->post('/api/login', [
            'email' => 'oubaydakhayata@gmail.com',
            'password' => 'my secure password'
        ], [
            'api-key' => env('API_KEY')
        ]);

        $response->assertStatus(200);

        // Logout test

        $token = $response->decodeResponseJson()['data']['token'];
        $response = $this->post('/api/logout', [], [
            'api-key' => env('API_KEY'),
            'Authorization' => 'Bearer' . $token
        ]);

        $response->assertStatus(200);
    }
}
