<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/posts', [PostController::class, 'index']) -> name('index');

Route::post('/posts/{id}', [PostController::class, 'show']);

Route::post('/posts', [PostController::class, 'store']);

Route::delete('/posts/{id}', [PostController::class, 'destroy']);

Route::put('/posts/{id}', [PostController::class, 'update']);