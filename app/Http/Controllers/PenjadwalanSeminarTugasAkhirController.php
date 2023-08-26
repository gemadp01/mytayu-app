<?php

namespace App\Http\Controllers;

use App\Models\PenjadwalanSeminarTugasAkhir;
use Illuminate\Http\Request;

class PenjadwalanSeminarTugasAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.penjadwalan_seminar_sidang.index', [
            'jadwal_seminarta' => PenjadwalanSeminarTugasAkhir::latest()->paginate(5),
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
    public function show(PenjadwalanSeminarTugasAkhir $penjadwalan_seminar_sidang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenjadwalanSeminarTugasAkhir $penjadwalan_seminar_sidang)
    {
        // dd($penjadwalan_seminar_sidang);
        return view('dashboard.penjadwalan_seminar_sidang.edit', [
            'inputJadwal' => $penjadwalan_seminar_sidang->load('pengajuansta'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenjadwalanSeminarTugasAkhir $penjadwalan_seminar_sidang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenjadwalanSeminarTugasAkhir $penjadwalan_seminar_sidang)
    {
        //
    }
}
