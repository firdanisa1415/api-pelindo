<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/pelaporan',[PelaporanController::class, 'index']);
Route::post('/pelaporan/store', [PelaporanController::class,'store']);
Route::get('/pelaporan/{id?}', [PelaporanController::class,'{id?}']);
Route::post('/pelaporan/update/{id?}', [PelaporanController::class,'update']);
Route::delete('/pelaporan/{id?}', 'PostsController@destroy');
