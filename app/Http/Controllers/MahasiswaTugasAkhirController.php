<?php

namespace App\Http\Controllers;

use App\Models\PengajuanTugasAkhir;
use App\Models\SuratKeteranganTugasAkhir;
use Illuminate\Http\Request;

class MahasiswaTugasAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.mahasiswa_ta.index', [
            'pengajuantas' => PengajuanTugasAkhir::latest()->paginate(5),
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
    public function show(PengajuanTugasAkhir $mahasiswa_tum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengajuanTugasAkhir $mahasiswa_tum)
    {
        return view('dashboard.mahasiswa_ta.edit', [
            'detailpengajuanta' => $mahasiswa_tum,
            'list_sk_ta' => SuratKeteranganTugasAkhir::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengajuanTugasAkhir $mahasiswa_tum)
    {
        $mahasiswa_tum->update([
            'sk_ta_id' => $request->input('sk_ta'),
        ]);

        return redirect('dashboard/mahasiswa-ta')->with('success', 'SK TA has been added!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengajuanTugasAkhir $mahasiswa_tum)
    {
        //
    }
}
