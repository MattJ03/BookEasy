<?php

namespace App\Services;
use App\Models\User;


class AuthService {
   
    public function register(array $credentials) {
      return User::create([
        'name' => $credentials['name'],
        'email' => $credentials['email'],
        'password' => bcrypt($credentials['password']),
      ]);

    }

     public function test_api_register(): void {
        $response = $this->postJson('/api/register',[
            'name' => 'James',
            'email'=> 'james@gmail.com',
            'password' => 'jamesPassword',
        ]);
        
        $response->assertStatus(200);
     
     $this->assertDatabaseHas('users', [
        'email' => 'james@gmail.com',
        
     ]);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
    }

}