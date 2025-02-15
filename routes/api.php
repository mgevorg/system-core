<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:api')->get('/user', [AuthController::class, 'user']);
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/check', [AuthController::class, 'check']);
Route::post('/payment', [AuthController::class, 'payment']);
Route::post('/md', [AuthController::class, 'md']);