<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSidangTugasAkhir;
use Illuminate\Http\Request;

class MahasiswaSidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.mahasiswa_sidangta.index', [
            'pengajuansidangtas' => PengajuanSidangTugasAkhir::with(['detailpengajuansidangta'])->latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PengajuanSidangTugasAkhir $pengajuanSidangTugasAkhir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengajuanSidangTugasAkhir $pengajuanSidangTugasAkhir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengajuanSidangTugasAkhir $pengajuanSidangTugasAkhir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengajuanSidangTugasAkhir $pengajuanSidangTugasAkhir)
    {
        //
    }
}
