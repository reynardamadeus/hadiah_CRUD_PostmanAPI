<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApiController;
use App\Http\Middleware\IsAdmin;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/store-mahasiswa', [ApiController::class, 'storeMahasiswa'])->middleware('auth:sanctum', IsAdmin::class);
Route::post('/update-mahasiswa/{id}', [ApiController::class, 'updateMahasiswa'])->middleware('auth-sanctum', IsAdmin::class);
Route::post('/delete-mahasiswa/{id}', [ApiController::class, 'deleteMahasiswa'])->middleware('auth:sanctum', IsAdmin::class);
Route::get('/mahasiswa-data',[ApiController::class, 'getMahasiswa']);

Route::post('/register', [UserController::class, 'registerUser']);
Route::post('/login', [UserController::class, 'loginUser']);
Route::post('/log-out', [UserController::class, 'logoutUser'])->middleware('auth:sanctum');
