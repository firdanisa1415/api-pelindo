<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\EpicsController;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\TugasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::controller(AuthenticationController::class)->group(function () {
    Route::get('auth', 'index');
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::controller(PelaporanController::class)->group(function () {
    Route::get('pelaporan', 'index');
    Route::post('pelaporan', 'store');
    Route::get('pelaporan/{id}', 'show');
    Route::put('pelaporan/{id}', 'update');
    Route::delete('pelaporan/{id}', 'destroy');
});

Route::controller(EpicsController::class)->group(function () {
    Route::get('epic', 'index');
    Route::post('epic', 'store');
    Route::get('epic/{id}', 'show');
    Route::put('epic/{id}', 'update');
    Route::delete('epic/{id}', 'destroy');
});

Route::controller(StoryController::class)->group(function () {
    Route::get('story', 'index');
    Route::post('story', 'store');
    Route::get('story/{id}', 'show');
    Route::put('story/{id}', 'update');
    Route::delete('story/{id}', 'destroy');
});

Route::controller(TugasController::class)->group(function () {
    Route::get('tugas', 'index');
    Route::post('tugas', 'store');
    Route::get('tugas/{id}', 'show');
    Route::put('tugas/{id}', 'update');
    Route::delete('tugas/{id}', 'destroy');
});

Route::controller(SprintController::class)->group(function () {
    Route::get('sprint', 'index');
    Route::post('sprint', 'store');
    Route::get('sprint/{id}', 'show');
    Route::put('sprint/{id}', 'update');
    Route::delete('sprint/{id}', 'destroy');
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::controller(AuthenticationController::class)->group(function () {
            Route::post('logout', 'logout');
        });
});
