<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class AuthTest extends TestCase
{
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
}
