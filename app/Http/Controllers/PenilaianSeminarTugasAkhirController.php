<?php

namespace App\Http\Controllers;

use App\Models\PenilaianSeminarTugasAkhir;
use App\Models\PenjadwalanSeminarTugasAkhir;
use App\Models\PengajuanTugasAkhir;
use App\Models\PengajuanSeminarTugasAkhir;
use App\Models\Dosen;
use Illuminate\Http\Request;

class PenilaianSeminarTugasAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengajuanSeminarTa = PengajuanSeminarTugasAkhir::where('user_id', auth()->user()->id)->get()->first();
        return view('dashboard.penilaian_tugas_akhir.index', [
            'jadwal_seminarta' => PenjadwalanSeminarTugasAkhir::where('pengajuan_seminarta_id', $pengajuanSeminarTa->id)->get()->first(),
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
    public function show(PenilaianSeminarTugasAkhir $penilaian_seminar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenilaianSeminarTugasAkhir $penilaian_seminar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenilaianSeminarTugasAkhir $penilaian_seminar)
    {
        
        if(auth()->user()->dosen->id === $penilaian_seminar->pembimbing1_id) {
            $penilaian_seminar->approve_pembimbing1 = 1;
            $penilaian_seminar->save();

            return redirect('berita-acara-seminar/' . $penilaian_seminar->penjadwalansta->id);
        }elseif (auth()->user()->dosen->id === $penilaian_seminar->pembimbing2_id) {
            $penilaian_seminar->approve_pembimbing2 = 1;
            $penilaian_seminar->save();

            return redirect('berita-acara-seminar/' . $penilaian_seminar->penjadwalansta->id);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenilaianSeminarTugasAkhir $penilaian_seminar)
    {
        //
    }

    public function beritaAcara(PenjadwalanSeminarTugasAkhir $id) {
        // dd($id);
        $datetimeRange = $id->tanggal_penjadwalan;
        $dates = explode(' ', $datetimeRange);
        $infoPenilaian = PenilaianSeminarTugasAkhir::where('pengajuan_seminarta_id', $id->id)->get()->first();
        $dosenPertama = Dosen::where('id', $infoPenilaian->pembimbing1_id)->get()->first();
        $dosenKedua = Dosen::where('id', $infoPenilaian->pembimbing2_id)->get()->first();

        return view('dashboard.berita-acara-seminar.index', [
            'infoSeminar' => $id->load('pengajuansta'),
            'tanggal_waktu' => $dates,
            'dospem1' => $dosenPertama,
            'dospem2' => $dosenKedua,
            'penilaian_seminar' => $infoPenilaian,
        ]);
    }

    public function formPerbaikan(PenjadwalanSeminarTugasAkhir $id) {
        $datetimeRange = $id->tanggal_penjadwalan;
        $dates = explode(' ', $datetimeRange);
        $infoPenilaian = PenilaianSeminarTugasAkhir::where('pengajuan_seminarta_id', $id->id)->get()->first();
        $dosenPertama = Dosen::where('id', $infoPenilaian->pembimbing1_id)->get()->first();
        $dosenKedua = Dosen::where('id', $infoPenilaian->pembimbing2_id)->get()->first();

        return view('dashboard.form-perbaikan-seminar.index', [
            'infoSeminar' => $id->load('pengajuansta'),
            'tanggal_waktu' => $dates,
            'dospem1' => $dosenPertama,
            'dospem2' => $dosenKedua,
            'penilaian_seminar' => $infoPenilaian,
        ]);
    }
}
