<?php

namespace Routes\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\AuthController;



Route::post('/register', [AuthController::class, 'register']);