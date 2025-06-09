<?php

use App\Models\User;

class AuthService {
   
    public function register(array $credentials) {
      return User::create([
        'name' => $credentials['name'],
        'email' => $credentials['email'],
        'password' => bcrypt($credentials['password']),
      ]);

    }

}