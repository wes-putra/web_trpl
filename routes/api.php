<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AkreditasiController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BeritaController;
use App\Http\Controllers\API\DosenStaffController;
use App\Http\Controllers\API\FasilitasController;
use App\Http\Controllers\API\KegiatanController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\KerjasamaMitraController;
use App\Http\Controllers\API\KurikulumController;
use App\Http\Controllers\API\PrestasiController;
use App\Http\Controllers\API\SejarahController;
use App\Http\Controllers\API\StrukturOrganisasiController;
use App\Http\Controllers\API\VisiMisiTujuanController;

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

// Auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('checkRole:Admin;Kaprodi');

// UserController
Route::prefix('admin/')->middleware('checkRole:Admin')->group(function () {
    Route::get('user', [UserController::class, 'index']);
    Route::post('user', [UserController::class, 'store']);
    Route::get('user/edit/{id}', [UserController::class, 'edit']);
    Route::put('user/{id}', [UserController::class, 'update']);
    Route::delete('user/{id}', [UserController::class, 'destroy']);
});

// RoleController
Route::prefix('admin/')->middleware('checkRole:Admin')->group(function(){
    Route::get('roles', [RoleController::class, 'index']);
    Route::post('role', [RoleController::class, 'store']);
    Route::delete('role/{id}', [RoleController::class, 'destroy']);
});

// Beranda Menu
// BeritaController
Route::prefix('admin/')->middleware('checkRole:Admin;Kaprodi')->group(function () {
    Route::get('berita', [BeritaController::class, 'index']);
    Route::post('berita', [BeritaController::class, 'store']);
    Route::get('berita/{id}', [BeritaController::class, 'show']);
    Route::get('berita/edit/{id}', [BeritaController::class, 'edit']);
    Route::put('berita/{id}', [BeritaController::class, 'update']);
    Route::delete('berita/single/{id}', [BeritaController::class, 'destroy_gambar']);
    Route::delete('berita/{id}', [BeritaController::class, 'destroy']);
});

// FasilitasController
Route::prefix('admin/')->middleware('checkRole:Admin;Kaprodi')->group(function () {
    Route::get('fasilitas', [FasilitasController::class, 'index']);
    Route::post('fasilitas', [FasilitasController::class, 'store']);
    Route::get('fasilitas/{id}', [FasilitasController::class, 'show']);
    Route::get('fasilitas/edit/{id}', [FasilitasController::class, 'edit']);
    Route::put('fasilitas/{id}', [FasilitasController::class, 'update']);
    Route::delete('fasilitas/{id}', [FasilitasController::class, 'destroy']);
});

// AkreditasiController
Route::prefix('admin/')->middleware('checkRole:Admin;Kaprodi')->group(function () {
    Route::get('akreditasi', [AkreditasiController::class, 'index']);
    Route::post('akreditasi', [AkreditasiController::class, 'store']);
    Route::get('akreditasi/edit', [AkreditasiController::class, 'edit']);
    Route::put('akreditasi', [AkreditasiController::class, 'update']);
    // Route::delete('akreditasi', [AkreditasiController::class, 'destroy']);
});

// KerjasamaMitraController 
Route::prefix('admin/')->middleware('checkRole:Admin;Kaprodi')->group(function () {
    Route::get('/kerjasama-mitra', [KerjasamaMitraController::class, 'index']);
    Route::post('/kerjasama-mitra', [KerjasamaMitraController::class, 'store']);
    Route::get('kerjasama-mitra/edit/{id}', [KerjasamaMitraController::class, 'edit']);
    Route::put('/kerjasama-mitra/{id}', [KerjasamaMitraController::class, 'update']);
    Route::delete('/kerjasama-mitra/{id}', [KerjasamaMitraController::class, 'destroy']);
});

// Profil Prodi Menu
// SejarahController
Route::prefix('admin/')->middleware('checkRole:Admin')->group(function () {
    Route::get('sejarah', [SejarahController::class, 'index']);
    Route::post('sejarah', [SejarahController::class, 'store']);
    Route::get('sejarah/edit', [SejarahController::class, 'edit']);
    Route::put('sejarah', [SejarahController::class, 'update']);
    // Route::delete('sejarah', [SejarahController::class, 'destroy']);
});

// VisiMisiTujuanController 
Route::prefix('admin/')->middleware('checkRole:Admin')->group(function () {
    Route::get('visi-misi-tujuan', [VisiMisiTujuanController::class, 'index']);
    Route::post('visi-misi-tujuan', [VisiMisiTujuanController::class, 'store']);
    Route::get('visi-misi-tujuan/edit', [VisiMisiTujuanController::class, 'edit']);
    Route::put('visi-misi-tujuan', [VisiMisiTujuanController::class, 'update']);
    // Route::delete('visi-misi-tujuan', [VisiMisiTujuanController::class, 'destroy']);
});

// KurikulumController
Route::prefix('admin/')->middleware('checkRole:Admin')->group(function () {
    Route::get('kurikulum', [KurikulumController::class, 'index']);
    Route::post('kurikulum', [KurikulumController::class, 'store']);
    Route::get('kurikulum/{id}/download', [KurikulumController::class, 'download']);
    Route::get('kurikulum/{id}/view', [KurikulumController::class, 'view']);
    Route::delete('kurikulum/{id}', [KurikulumController::class, 'destroy']);
});

// DosenStaffController
Route::prefix('admin/')->middleware('checkRole:Admin')->group(function () {
    Route::get('dosen-staff', [DosenStaffController::class, 'index']);
    Route::post('dosen-staff', [DosenStaffController::class, 'store']);
    Route::get('dosen-staff/edit/{id}', [DosenStaffController::class, 'edit']);
    Route::put('dosen-staff/{id}', [DosenStaffController::class, 'update']);
    Route::delete('dosen-staff/{id}', [DosenStaffController::class, 'destroy']);
});

// StrukturOrganisasiController
Route::prefix('admin/')->middleware('checkRole:Admin')->group(function () {
    Route::get('struktur-organisasi', [StrukturOrganisasiController::class, 'index']);
    Route::post('struktur-organisasi', [StrukturOrganisasiController::class, 'store']);
    Route::get('struktur-organisasi/edit', [StrukturOrganisasiController::class, 'edit']);
    Route::put('struktur-organisasi', [StrukturOrganisasiController::class, 'update']);
    // Route::delete('struktur-organisasi', [StrukturOrganisasiController::class, 'destroy']);
});

// Kemahasiswaan menu
// KegiatanController
Route::prefix('admin/')->middleware('checkRole:Admin')->group(function () {
    Route::get('kegiatan', [KegiatanController::class, 'index']);
    Route::post('kegiatan', [KegiatanController::class, 'store']);
    Route::get('kegiatan/{id}', [KegiatanController::class, 'show']);
    Route::get('kegiatan/edit/{id}', [KegiatanController::class, 'edit']);
    Route::put('kegiatan/{id}', [KegiatanController::class, 'update']);
    Route::delete('kegiatan/{id}', [KegiatanController::class, 'destroy']);
});

// PrestasiController
Route::prefix('admin/')->middleware('checkRole:Admin')->group(function () {
    Route::get('prestasi', [PrestasiController::class, 'index']);
    Route::post('prestasi', [PrestasiController::class, 'store']);
    Route::get('prestasi/{id}', [PrestasiController::class, 'show']);
    Route::get('prestasi/edit/{id}', [PrestasiController::class, 'edit']);
    Route::put('prestasi/{id}', [PrestasiController::class, 'update']);
    Route::delete('prestasi/{id}', [PrestasiController::class, 'destroy']);
});