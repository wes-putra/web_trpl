<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AkreditasiController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BeritaController;
use App\Http\Controllers\API\FasilitasController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\KerjasamaMitraController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('checkRole:Admin;Kaprodi');

// UserController
Route::prefix('admin/')->middleware('checkRole:Admin')->group(function () {
    Route::get('users', [UserController::class, 'index']);
    Route::post('user', [UserController::class, 'store']);
    Route::put('user/{id}', [UserController::class, 'update']);
    Route::delete('user/{id}', [UserController::class, 'destroy']);
});

// RoleController
Route::prefix('admin/')->middleware('checkRole:Admin')->group(function(){
    Route::get('roles', [RoleController::class, 'index']);
    Route::post('role', [RoleController::class, 'store']);
    Route::delete('role/{id}', [RoleController::class, 'destroy']);
});

// BeritaController
Route::prefix('admin/')->middleware('checkRole:Admin;Kaprodi')->group(function () {
    Route::get('beritas', [BeritaController::class, 'index']);
    Route::post('berita', [BeritaController::class, 'store']);
    Route::get('berita/{id}', [BeritaController::class, 'show']);
    Route::put('berita/{id}', [BeritaController::class, 'update']);
    Route::delete('berita/single/{id}', [BeritaController::class, 'destroy_gambar']);
    Route::delete('berita/{id}', [BeritaController::class, 'destroy']);
});
// FasilitasController
Route::prefix('admin/')->middleware('checkRole:Admin;Kaprodi')->group(function () {
    Route::get('fasilitas', [FasilitasController::class, 'index']);
    Route::post('fasilitas', [FasilitasController::class, 'store']);
    Route::get('fasilitas/{id}', [FasilitasController::class, 'show']);
    Route::put('fasilitas/{id}', [FasilitasController::class, 'update']);
    Route::delete('fasilitas/{id}', [FasilitasController::class, 'destroy']);
});

// AkreditasiController
Route::prefix('admin/')->middleware('checkRole:Admin;Kaprodi')->group(function () {
    Route::get('akreditasi', [AkreditasiController::class, 'index']);
    Route::post('akreditasi', [AkreditasiController::class, 'store']);
    Route::put('akreditasi', [AkreditasiController::class, 'update']);
    Route::delete('akreditasi', [AkreditasiController::class, 'destroy']);
});

Route::prefix('admin/')->middleware('checkRole:Admin;Kaprodi')->group(function () {
    Route::get('/kerjasama-mitra', [KerjasamaMitraController::class, 'index']);
    Route::post('/kerjasama-mitra', [KerjasamaMitraController::class, 'store']);
    Route::put('/kerjasama-mitra/{id}', [KerjasamaMitraController::class, 'update']);
    Route::delete('/kerjasama-mitra/{id}', [KerjasamaMitraController::class, 'destroy']);
});



