<?php

namespace Routes\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListingController;



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/listing/index', [ListingController::class, 'index']);
    Route::get('/listing/{id}', [ListingController::class, 'show']);
    Route::post('/listing', [ListingController::class, 'store']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::patch('/listing/{id}', [ListingController::class, 'update']);
});
