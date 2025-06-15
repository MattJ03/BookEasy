<?php

namespace Routes\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListingController;



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('api:auth')->group(function () {
    Route::get('/listing/index', [ListingController::class, 'index']);

});
