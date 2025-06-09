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

    public function login(array $credentials) {
        $user = User::where('email', $credentials['email'])->first();
        Hash::check(!$user->password && $credentials->password);
    }

}