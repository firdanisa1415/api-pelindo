<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\EpicsController;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\TrainingController;

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
    Route::get('user', 'index');
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::get('role','roles');
    Route::get('operator', 'getListOperator');
    Route::delete('users/{id}', 'destroy');
    });

Route::controller(DivisiController::class)->group(function(){
    Route::get('divisi', 'index');
    Route::post('divisi', 'store');
    Route::get('divisi/{id}', 'show');
}
);
// Route::controller(AuthenticationController::class)->group(function () {
//     Route::post('auth', 'register');
//     Route::post('auth', 'login');
//     Route::post('auth', 'logout');
// });

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

Route::controller(PelaporanController::class)->group(function () {
    Route::get('pelaporan', 'index');
    Route::post('pelaporan', 'store');
    Route::get('pelaporan/{id}', 'show');
    Route::put('pelaporan/{id}', 'update');
    Route::delete('pelaporan/{id}', 'destroy');
});

Route::controller(TrainingController::class)->group(function () {
    Route::get('training', 'index');
    Route::post('training', 'store');
    Route::get('training/{id}', 'show');
    Route::put('training/{id}', 'update');
    Route::delete('training/{id}', 'destroy');
});

Route::controller(GuestController::class)->group(function(){
    Route::post('send-email', 'sendEmail');
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::controller(AuthenticationController::class)->group(function () {
        Route::get('user', 'index');
        Route::get('user/{id}', 'show');
        Route::post('logout', 'logout');
        Route::put('user/{id}', 'update');
    });
    Route::controller(PelaporanController::class)->group(function () {
        Route::get('pelaporan', 'index');
        Route::post('pelaporan', 'store');
        Route::get('pelaporan/{id}', 'show');
        Route::put('pelaporan/{id}', 'update');
        Route::delete('pelaporan/{id}', 'destroy');
        Route::get('product', 'product');
        Route::get('bulan', 'monthly');
        Route::get('status', 'status');
        Route::get('pic', 'pic');
    });
    Route::controller(EpicsController::class)->group(function () {
        Route::get('epic', 'index');
        Route::post('epic', 'store');
        Route::get('epic/{id}', 'show');
        Route::put('epic/{id}', 'update');
        Route::delete('epic/{id}', 'destroy');
    });

    Route::controller(StoryController::class)->group(function () {
        Route::get('story/epic/{epic_id}', 'index');
        Route::get('stories', 'allStory');
        Route::post('story/{epic_id}', 'store');
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
    Route::group(['middleware' => ['role:operator|manager']], function () {
        Route::controller(AuthenticationController::class)->group(function () {
            // Route::get('user', 'index');
        Route::get('user', 'index');
        Route::post('logout', 'logout');
        Route::get('role','roles');
        });

        Route::controller(PelaporanController::class)->group(function () {
        Route::get('pelaporan', 'index');
        Route::post('pelaporan', 'store');
        Route::get('pelaporan/{id}', 'show');
        Route::put('pelaporan/{id}', 'update');
        Route::delete('pelaporan/{id}', 'destroy');
    });

    });
    Route::group(['middleware' => ['role:karyawan']], function () {
        Route::controller(AuthenticationController::class)->group(function () {
            // Route::get('user', 'index');
        Route::get('user', 'index');
        Route::post('logout', 'logout');
        Route::get('role','roles');
        });

        Route::controller(PelaporanController::class)->group(function () {
        Route::get('pelaporan', 'index');
        Route::post('pelaporan', 'store');
        Route::get('pelaporan/{id}', 'show');
        Route::put('pelaporan/{id}', 'update');
        Route::delete('pelaporan/{id}', 'destroy');
        });

        Route::controller(TugasController::class)->group(function () {
        Route::get('tugas', 'index');
        Route::post('tugas', 'store');
        Route::get('tugas/{id}', 'show');
        Route::put('tugas/{id}', 'update');
        Route::delete('tugas/{id}', 'destroy');
        });
    });
});
