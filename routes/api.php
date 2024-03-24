<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Professional\ProfessionalController;
use App\Http\Controllers\Appointment\AppointmentController;


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

Route::controller(UserController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login')->name('login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/professionals', [ProfessionalController::class, 'index']);

    Route::controller(AppointmentController::class)->group(function () {
        Route::post('appointment/store', 'store');
        Route::get('appointment/', 'index');
        Route::get('appointment/{appointment}/{status}', 'update_status');
    });
});
