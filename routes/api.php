<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/mahasiswa-data',[ApiController::class, 'getMahasiswa']);
Route::post('/store-mahasiswa', [ApiController::class, 'storeMahasiswa']);
Route::post('/update-mahasiswa/{id}', [ApiController::class, 'updateMahasiswa']);
Route::post('/delete-mahasiswa/{id}', [ApiController::class, 'deleteMahasiswa']);
