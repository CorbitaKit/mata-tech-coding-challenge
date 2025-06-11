<?php

namespace Tests\Feature\v1\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;
   public function test_user_authentication(): void
   {
    $password = fake()->regexify('[A-Za-z0-9]{10}');
    $user = User::factory()->create([
        'password' => $password
    ]);

    $response = $this->postJson(route('api.v1.user.login'), [
        'email' => $user->email,
        'password' => $password
    ])
    ->assertStatus(200);

    $response->assertJsonStructure([
        'access_token',
        'user',
        'message'
    ])
    ->assertJsonFragment([
        'message' => 'Logged in successfully!'
    ]);
   }

   public function test_failed_user_authentication()
   {
    User::factory()->create();

    $response = $this->postJson(route('api.v1.user.login'), [
        'email' => fake()->email(),
        'password' => fake()->regexify('[A-Za-z0-9]{10}')
    ])->assertStatus(401);

    $response->assertJsonFragment([
        'message' => 'Invalid Credentials'
    ]);
   }
}
