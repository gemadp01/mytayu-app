<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
use Carbon\Carbon;

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
    return view('landing');
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware(
    'guest', 'redirectToDashboardIfLoggedIn');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::middleware('auth')->group(function() {
    Route::get('dashboard/profile', [ProfileController::class, 'edit']);
    Route::put('dashboard/profile', [ProfileController::class, 'update']);
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::get('/dashboard', function() {
        return view('dashboard.index', [
            'date' => Carbon::now('Asia/Jakarta')->format('d-m-Y'),
        ]);
    });
});


Route::middleware('auth', 'check.user.status:koordinator')->group(function () {
    Route::resource('/dashboard/dosen', DosenController::class);
    Route::post('/dashboard/dosen/{dosen}/toggle-status', [DosenController::class, 'toggleStatus']);

    Route::resource('/dashboard/mahasiswa', MahasiswaController::class);
    Route::post('/dashboard/mahasiswa/{mahasiswa}/toggle-status', [MahasiswaController::class, 'toggleStatus']);
});

