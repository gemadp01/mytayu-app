<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DosenController;
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
    'guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/dashboard', function() {
    return view('dashboard.index', [
        'date' => Carbon::now('Asia/Jakarta')->format('d-m-Y'),
    ]);
})->middleware('auth');

Route::resource('/dashboard/dosen', DosenController::class)->middleware('is_koordinator');
