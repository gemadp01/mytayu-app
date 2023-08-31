<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenjadwalanSeminarTugasAkhir;
use App\Models\PenjadwalanSidangTugasAkhir;
use App\Models\Dosen;

class PenjadwalanSeminarSidangController extends Controller
{
    public function index() {
        return view('dashboard.penjadwalan_seminar_sidang.index', [
            'jadwal_seminarta' => PenjadwalanSeminarTugasAkhir::latest()->paginate(5),
            'jadwal_sidangta' => PenjadwalanSidangTugasAkhir::latest()->paginate(5),
            'infoDosen' => Dosen::all(),
        ]);
    }
}
