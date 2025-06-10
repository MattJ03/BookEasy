<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function register(AuthService $authService, Request $request) {
        $credentials = $request->validate([
          'name' => 'required|min:3|max:15',
          'email' => 'required|email|max:35',
          'password' => 'required|min:3|max:15',
        ]);
        
        $user = $authService->register($credentials);
        return response()->json(['Message' => 'User Registered successfully', 'user' => $user]);
    }

    public function login(AuthService $authService, Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email|max:15',
            'password' => 'required|min:3|max:15',
        ]);
           $token = $authService->login($credentials);
           if(!$token) {
            return response()->json(['message' => 'failed to login'], 401);
           }
            return response()->json([
            'token' => $token,
            'token_type' => 'Bearer']);
    }
     
    public function logout(AuthService $authService, Request $request) {
        return $authService->logout($request);
        return response()->json(['message' => 'logged out']);
    }
}
