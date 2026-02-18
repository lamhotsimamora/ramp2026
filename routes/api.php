<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\PetaniController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\TokenAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/admin/login', [AdminController::class, 'login'])->middleware(TokenAuth::class);
Route::post('/admin/logout', [AdminController::class, 'logout'])->middleware(TokenAuth::class);

Route::post('/petani/save', [PetaniController::class, 'save'])->middleware(TokenAuth::class);
Route::post('/petani/load', [PetaniController::class, 'load'])->middleware(TokenAuth::class);
Route::post('/petani/update', [PetaniController::class, 'update'])->middleware(TokenAuth::class);
Route::post('/petani/delete', [PetaniController::class, 'delete'])->middleware(TokenAuth::class);
Route::post('/petani/search', [PetaniController::class, 'search'])->middleware(TokenAuth::class);


Route::post('/profile/load', [ProfileController::class, 'load'])->middleware(TokenAuth::class);
Route::post('/profile/save', [ProfileController::class, 'save'])->middleware(TokenAuth::class);
Route::post('/profile/upload', [ProfileController::class, 'upload'])->middleware(TokenAuth::class);


Route::post('/nota/save', [NotaController::class, 'save'])->middleware(TokenAuth::class);

Route::post('/transaction/load', [TransactionController::class, 'load'])->middleware(TokenAuth::class);
Route::post('/transaction/delete', [TransactionController::class, 'delete'])->middleware(TokenAuth::class);

Route::post('/transaction/total/load', [TransactionController::class, 'totalLoad'])->middleware(TokenAuth::class);
