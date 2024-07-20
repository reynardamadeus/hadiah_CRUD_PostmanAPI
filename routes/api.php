<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApiController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/store-mahasiswa', [ApiController::class, 'storeMahasiswa'])->middleware('auth-sanctum', 'Teacher');
Route::post('/update-mahasiswa/{id}', [ApiController::class, 'updateMahasiswa'])->middleware('auth-sanctum', 'Teacher');
Route::post('/delete-mahasiswa/{id}', [ApiController::class, 'deleteMahasiswa'])->middleware('auth-sanctum', 'Admin');
Route::get('/mahasiswa-data',[ApiController::class, 'getMahasiswa']);

Route::post('/register', [UserController::class, 'registerUser']);
Route::post('/login', [UserController::class, 'loginUser']);
Route::post('/log-out', [UserController::class, 'logoutUser'])->middleware('auth:sanctum');
