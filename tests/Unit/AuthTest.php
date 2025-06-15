<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;


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

    public function test_register_empty_password(): void {
        $response = $this->postJson('/api/register', [
            'name' => 'Jake',
            'email' => 'my@email.com',
            'password' => '',
        ]);
        $response->assertStatus(422);
        $this->assertDatabaseMissing('users', [
            'name' => 'Jake',
        ]);
    }

    public function test_register_empty_name(): void {
        $response = $this->postJson('/api/register', [
            'name' => '',
            'email' => 'pauriac@email.me',
            'password' => 'wwwhghwrwh',
        ]);
        $response->assertStatus(422);
        $this->assertDatabaseMissing('users', [
            'email' => 'pauriac@email.me',
        ]);
    }

    public function test_register_under_min_name(): void {
        $response = $this->postJson('/api/register', [
            'name' => 'AO',
            'email' => 'Ao@art.com',
            'password' => 'hdhefueuefe',
        ]);
        $response->assertStatus(422);
        $this->assertDatabaseMissing('users', [
            'name' => 'AO']);
    }

    public function test_register_over_max_name(): void {
        $response = $this->postJson('/api/register', [
            'name' => 'hdjsklakdgbartholomewra',
            'email' => 'longname@gmail.com',
            'password' => 'superlongname',
        ]);
        $response->assertStatus(422);
        $this->assertDatabaseMissing('users', [
            'email' => 'longname@gmail.com',
        ]);
    }

    public function test_email_is_email(): void {
        $response = $this->postJson('/api/register', [
            'name' => 'Lauren',
            'email' => 'NotAnEmail',
            'password' => 'hshsrhsah',
        ]);
        $response->assertStatus(422);
        $this->assertDatabaseMissing('users', [
            'email' => 'NotAnEmail',
        ]);
    }

    public function test_over_max_email(): void {
        $response = $this->postJson('/api/register', [
           'name' => 'Mark',
           'email' => 'markismyrealnameandthisshouldnotstore',
            'password' => 'hashfakepassword',
        ]);
        $response->assertStatus(422);
        $this->assertDatabaseMissing('users', [
           'name' => 'Mark',
        ]);
    }

    public function test_under_min_password(): void {
        $response = $this->postJson('/api/register', [
            'name' => 'Jack',
            'email' => 'brady@icloud.com',
            'password' => 'JB',
        ]);
        $response->assertStatus(422);
        $this->assertDatabaseMissing('users', [
            'password' => 'JB',
        ]);
    }

    public function test_over_max_password(): void {
        $response = $this->postJson('/api/register', [
            'name' => 'Alison',
            'email' => 'Alison@me.com',
            'password' => 'WhatIsMyPasswordAgain?',
        ]);
        $response->assertStatus(422);
        $this->assertDatabaseMissing('users',[
            'email' => 'Alison@me.com',
        ]);
    }

    public function test_completely_empty_form(): void {
        $response = $this->postJson('/api/register', [
            'name' => '',
            'email' => '',
            'password' => '',
        ]);
        $response->assertStatus(422);
        $this->assertDatabaseMissing('users', [
            'name' => '']);
    }

    public function test_login_user(): void {
        $response = $this->postJson('/api/register', [
            'name' => 'Adam',
            'email' => 'Adam@icloud.com',
            'password' => 'therealpassword',
                ]);
        $response->assertStatus(200);
        $response2 = $this->postJson('/api/login', [
            'email' => 'Adam@icloud.com',
            'password' => 'therealpassword',
        ]);
        $response2->assertJsonStructure([
            'access_token',
            'token_type'
        ]);
    }

    public function test_login_user_wrong_email(): void {
        $response = $this->postJson('/api/register', [
          'name' => 'Lenzo',
           'email' => 'mlenzo@gmail.com',
           'password' => 'secret123',
        ]);
        $response->assertStatus(200);
        $response2 = $this->postJson('/api/login', [
            'email' => 'Mark@gmail1.com',
            'password' => 'secret123',
        ]);
       ;
        $response2->assertStatus(401)
            ->assertJson([
            'message' => 'unauthorised',
        ]);
    }

    public function test_login_user_wrong_password(): void {
         $response = $this->postJson('/api/register', [
            'name' => 'Kathryn',
            'email' => 'Kathryn@gmail.com',
            'password' => 'rueKathryn',
         ]);
         $response->assertStatus(200);
         $response2 = $this->postJson('/api/login', [
             'email' => 'Kathryn@gmail.com',
             'password' => 'fakepassword456',
         ]);
         $response2->assertStatus(401)
             ->assertJson([
                 'message' => 'unauthorised',
             ]);
    }

    public function test_case_sensitive_email_login(): void {
        $response = $this->postJson('/api/register', [
           'name' => 'Stewart',
           'email' => 'iamstewart@gmail.com',
           'password' => 'stewarty123',
        ]);
        $response->assertStatus(200);
        $response2 = $this->postJson('/api/login', [
            'email' => 'IAMSTEWART@gmail.com',
            'password' => 'stewarty123',
        ]);
        $response2->assertStatus(200)
            ->assertJsonStructure([
               'access_token', 'token_type',
            ]);
    }

    public function test_case_sensitive_password(): void {
        $response = $this->postJson('/api/register', [
           'name' => 'Ellen',
           'email' => 'ellen531@gmail.com',
           'password' => 'ellenisme',
        ]);
        $response->assertStatus(200);
        $response2 = $this->postJson('/api/login', [
            'email' => 'ellen531@gmail.com',
            'password' => 'ELLENISME',
        ]);
        $response2->assertStatus(401)
            ->assertJson(['message' => 'unauthorised']);
    }

    public function test_email_contains_at_symbol(): void {
        $response = $this->postJson('/api/register', [
           'name' => 'Jane',
           'email' => 'janenovember@gmail.com',
           'password' => 'janesSecret',
        ]);
        $response->assertStatus(200);
        $response2 = $this->postJson('/api/login', [
            'email' => 'janenovember',
            'password' => 'janesSecret',
        ]);
        $response2->assertStatus(422)
            ->assertJson(['message' => 'The email field must be a valid email address.']);
    }

    public function test_unauthorised_upon_logout(): void {

    }

}
