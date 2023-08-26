<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenjadwalanSeminarTugasAkhir;

class PenjadwalanSeminarSidangController extends Controller
{
    public function index() {
        return view('dashboard.penjadwalan_seminar_sidang.index', [
            'jadwal_seminarta' => PenjadwalanSeminarTugasAkhir::latest()->paginate(5),
        ]);
    }
}
