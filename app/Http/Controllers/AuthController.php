<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Services\AuthService;

class AuthController extends Controller
{
    public function register(AuthService $authService, Request $request) {
        $credentials = $request->validate([
            'name' => 'required|min:3|max:15',
          'emaill' => 'required|email|max:15',
          'password' => 'required|min:3|max:15',
        ]);
        
        $user = $authService(register($credentials));
        return response()->json(['Message' => 'User Registered successfully', 'user' => $user]);
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email|max:15',
            'password' => 'required|min:3|max:15',
        ]);

    }
}
