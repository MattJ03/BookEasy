<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class AuthTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_register_user(): void
    {
        $response = $this->postJson('/api/register', [
            'name' => 'James',
            'email' => 'james@example.com',
            'password' => 'abcdefg',
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'email' => 'james@example.com',
        ]);
    }

    public function test_register_empty_email(): void {

        $response = $this->postJson('/api/register', [
            'name' => 'Matt',
            'email' => '',
            'password' => 'totallyReal',
        ]);
        $response->assertStatus(422);
        $this->assertDatabaseMissing('users', [
            'name' => 'Matt']);
    }
}
