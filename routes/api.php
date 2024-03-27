<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('doctors')->group(function () {
    Route::get('/',        [DoctorController::class, 'index']);
    Route::get('/{id}',    [DoctorController::class, 'show']);
    Route::post('/',       [DoctorController::class, 'store']);
    Route::post('/{id}',   [DoctorController::class, 'update']);
    Route::delete('/{id}', [DoctorController::class, 'delete']);
});

Route::prefix('patients')->group(function () {
    Route::get('/',        [PatientController::class, 'index']);
    Route::get('/{id}',    [PatientController::class, 'show']);
    Route::post('/',       [PatientController::class, 'store']);
    Route::post('/{id}',   [PatientController::class, 'updateDiagnosis']);
    Route::delete('/{id}', [PatientController::class, 'delete']);
});
