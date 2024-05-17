<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('public.welcome');
});

Route::get('/login', function(){
    return view('auth.login');
})->name('login');


//AdminController
Route::get('/admin', function(){
    return view('admin.dashboard');
})->name('dashboard')->middleware('checkRole:Admin;Kaprodi');

Route::middleware(['checkRole:Admin'])->group(function () {
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // userControllter
    Route::prefix('Admin/User')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/add', [UserController::class, 'create'])->name('user.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/edit', [UserController::class, 'edit'])->name('user.edit');

    });
});