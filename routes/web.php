<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PengajuanTugasAkhirController;
use App\Http\Controllers\DetailPengajuanTugasAkhirController;
use App\Http\Controllers\MahasiswaBimbinganController;
use App\Http\Controllers\AppointmentBimbinganController;
use App\Http\Controllers\BimbinganTugasAkhirController;
use App\Http\Controllers\PengajuanSeminarTugasAkhirController;
use App\Http\Controllers\DetailPengajuanSeminarTugasAkhirController;
use App\Http\Controllers\PenjadwalanSeminarTugasAkhirController;
use App\Http\Controllers\PenilaianSeminarTugasAkhirController;
use App\Http\Controllers\PenjadwalanSeminarSidangController;
use App\Http\Controllers\FormPerbaikanSeminarController;
use App\Http\Controllers\ProfileController;
use Carbon\Carbon;
use App\Http\Controllers\Gate;


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
    Route::put('dashboard/profile/{idUser}', [ProfileController::class, 'update']);
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::get('/dashboard', function() {
        return view('dashboard.index', [
            'date' => Carbon::now('Asia/Jakarta')->format('d-m-Y'),
        ]);
    });
});

Route::middleware('auth', 'check.user.status:mahasiswa,koordinator,kaprodi,dekan')->group(function () {
    Route::resource('/dashboard/pengajuan-ta', PengajuanTugasAkhirController::class);
    Route::resource('/dashboard/pengajuan-seminarta', PengajuanSeminarTugasAkhirController::class);
});

Route::middleware('auth', 'check.user.status:mahasiswa,koordinator,kaprodi,dekan,dospem')->group(function () {
    Route::resource('/dashboard/penjadwalan-seminar', PenjadwalanSeminarTugasAkhirController::class);
    Route::resource('/dashboard/penilaian-seminar', PenilaianSeminarTugasAkhirController::class);
    Route::resource('/dashboard/form-perbaikan', FormPerbaikanSeminarController::class)->only(['update']);
    Route::get('/berita-acara-seminar/{id}', [PenilaianSeminarTugasAkhirController::class, 'beritaAcara']);
    Route::get('/form-perbaikan-seminar/{id}', [PenilaianSeminarTugasAkhirController::class, 'formPerbaikan']);
    Route::get('/dashboard/penjadwalan-seminar-sidang', [PenjadwalanSeminarSidangController::class, 'index']);
});

Route::middleware('auth', 'check.user.status:koordinator,kaprodi,dekan')->group(function () {
    Route::resource('/dashboard/detail-pengajuan-ta', DetailPengajuanTugasAkhirController::class)->only(['show', 'edit', 'update']);

});

Route::middleware('auth', 'check.user.status:koordinator,dekan')->group(function () {
    Route::resource('/dashboard/detail-pengajuan-seminarta', DetailPengajuanSeminarTugasAkhirController::class)->only(['show', 'edit', 'update']);
});

Route::middleware('auth', 'check.user.status:koordinator')->group(function () {
    Route::resource('/dashboard/dosen', DosenController::class);
    Route::post('/dashboard/dosen/{dosen}/toggle-status', [DosenController::class, 'toggleStatus']);
    Route::post('/dosen/import', [DosenController::class, 'import']);
    Route::get('/dosen/export-to-excel', [DosenController::class, 'exportToExcel']);
    Route::get('/dosen/export-to-pdf', [DosenController::class, 'exportToPDF']);

    Route::resource('/dashboard/mahasiswa', MahasiswaController::class);
    Route::post('/dashboard/mahasiswa/{mahasiswa}/toggle-status', [MahasiswaController::class, 'toggleStatus']);
    Route::post('/mahasiswa/import', [MahasiswaController::class, 'import']);
    Route::get('/mahasiswa/export-to-excel', [MahasiswaController::class, 'exportToExcel']);
    Route::get('/mahasiswa/export-to-pdf', [MahasiswaController::class, 'exportToPDF']);

    
});

Route::middleware('auth', 'check.user.status:mahasiswa,dospem')->group(function () {
    Route::resource('/dashboard/mahasiswa-bimbingan', MahasiswaBimbinganController::class);
    Route::resource('/dashboard/agenda-bimbingan', AppointmentBimbinganController::class);
    Route::resource('/dashboard/bimbingan', BimbinganTugasAkhirController::class);
    Route::get('/dashboard/info-pembimbing', [AppointmentBimbinganController::class, 'infopembimbing']);
    Route::get('/dashboard/dospemsatu-appointment', [AppointmentBimbinganController::class, 'dospemsatuAppointment']);
    Route::get('/dashboard/dospemdua-appointment', [AppointmentBimbinganController::class, 'dospemduaAppointment']);
    Route::post('/dashboard/bimbingan/{bimbingan}/declined-bimbingan', [BimbinganTugasAkhirController::class, 'declinedBimbingan']);
    Route::get('/form-bimbingan/{idUser}/{idDospem}', [MahasiswaBimbinganController::class, 'formBimbingan']);
});