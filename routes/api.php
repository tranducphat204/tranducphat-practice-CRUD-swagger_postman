<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', [PostController::class, 'index'])->name('index');

Route::post('/posts/{id}', [PostController::class, 'show']);

Route::post('/posts', [PostController::class, 'store']);

Route::delete('/posts/{id}', [PostController::class, 'destroy']);

Route::put('/posts/{id}', [PostController::class, 'update']);