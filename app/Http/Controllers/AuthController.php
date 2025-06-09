<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Services\AuthService;

class AuthController extends Controller
{
    public function register(Request $request) {
        $credentials = $request->validate([
            'name' => 'required|min:3|max:15',
          'emaill' => 'required|email|max:15',
          'password' => 'required|min:3|max:15',
        ]);

    }
}
