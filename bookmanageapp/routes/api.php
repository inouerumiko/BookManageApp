<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FavoriteController;
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

Route::controller(AuthorController::class)->group(function () {
    Route::post('/author', 'create');
    Route::put('/author/{id}', 'update');
    Route::get('/author/{id}', 'read');
    Route::delete('/author/{id}', 'delete');
});

Route::controller(PublisherController::class)->group(function () {
    Route::post('/publisher', 'create');
    Route::put('/publisher/{id}', 'update');
    Route::get('/publisher/{id}', 'read');
    Route::delete('/publisher/{id}', 'delete');
});

Route::controller(BookController::class)->group(function () {
    Route::post('/book', 'create');
    Route::put('/book/{id}', 'update');
    Route::get('/book/{id}', 'read');
    Route::delete('/book/{id}', 'delete');
});

Route::group(['middleware' => 'auth'], function () {
    Route::controller(FavoriteController::class)->group(function () {
        Route::post('/favorite', 'create');
        Route::put('/favorite/{id}', 'update');
        Route::get('/favorite', 'read');
        Route::delete('/favorite/{id}', 'delete');
    });
});

Route::controller(LoginController::class)->group(function () {
    Route::post('/login', 'login');
    Route::get('/logout', 'logout')->middleware('auth');
    Route::post('/regist', 'create');
});

