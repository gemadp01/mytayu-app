<?php

namespace App\Http\Controllers;

use App\Models\PengajuanTugasAkhir;
use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Mahasiswa;


class PengajuanTugasAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.pengajuan_tugas_akhir.index', [
            'pengajuantas' => PengajuanTugasAkhir::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pengajuan_tugas_akhir.create', [
            'dospems' => Dosen::all(),
            'mahasiswa' => Mahasiswa::where('user_id', auth()->user()->id)
                ->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $request;
    }

    /**
     * Display the specified resource.
     */
    public function show(PengajuanTugasAkhir $pengajuanTugasAkhir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengajuanTugasAkhir $pengajuanTugasAkhir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengajuanTugasAkhir $pengajuanTugasAkhir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengajuanTugasAkhir $pengajuanTugasAkhir)
    {
        //
    }
}
