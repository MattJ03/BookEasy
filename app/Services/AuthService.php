<?php

namespace App\Services;
use App\Models\User;
use  Illuminate\Support\Facades\Hash;

class AuthService
{

    public function register(array $data): User
    {
        $user = User::create([
           'name' => $data['name'],
           'email' => $data['email'],
           'password' => Hash::make($data['password']),
        ]);
        return $user;
    }
    public function login(array $data): User {
        $user = User::where('email', $data['email'])->first();
        if(!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['error' => 'wrong credentials'], 402);
        }
        return $user->createToken('auth_token')->plainTextToken;
    }

}
