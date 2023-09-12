<?php

namespace App\Http\Controllers;

use App\Models\PenjadwalanSidangTugasAkhir;
use App\Models\PenilaianSidangTugasAkhir;
use App\Models\PengajuanSidangTugasAkhir;
use App\Models\Dosen;
use Illuminate\Http\Request;

class PenilaianSidangTugasAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengajuanSidangTa = PengajuanSidangTugasAkhir::where('user_id', auth()->user()->id)->get()->first();
        
        if ($pengajuanSidangTa !== null) {
            $penilaianSidangTa = PenilaianSidangTugasAkhir::where('pengajuan_sidangta_id', $pengajuanSidangTa->id)->get()->first();
            $penjadwalanSidangTa = PenjadwalanSidangTugasAkhir::where('pengajuan_sidang_tugas_akhir_id', $pengajuanSidangTa->id)->get()->first();

            // $dosenPertama = Dosen::where('id', $pengajuanSidangTa->penjadwalansidangta->pembimbing1_id)->get()->first();
            // $dosenKedua = Dosen::where('id', $pengajuanSidangTa->penjadwalansidangta->pembimbing2_id)->get()->first();

            if ($penjadwalanSidangTa !== null) {
                $dosenPertama = Dosen::where('id', $pengajuanSidangTa->penjadwalansidangta->pembimbing1_id)->get()->first();
                $dosenKedua = Dosen::where('id', $pengajuanSidangTa->penjadwalansidangta->pembimbing2_id)->get()->first();
            }else{
                $dosenPertama = "";
                $dosenKedua = "";
            }

            return view('dashboard.penilaian_sidang.index', [
                'jadwal_sidangta' => PenjadwalanSidangTugasAkhir::where('pengajuan_sidang_tugas_akhir_id', $pengajuanSidangTa->id)->get()->first(),
                'dospem1' => $dosenPertama,
                'dospem2' => $dosenKedua,
                'penilaian_sidangta' => $penilaianSidangTa,
            ]);
        }else {
            return view('dashboard.penilaian_sidang.index');
        }
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
    public function show(PenjadwalanSidangTugasAkhir $penilaian_sidang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenjadwalanSidangTugasAkhir $penilaian_sidang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenjadwalanSidangTugasAkhir $penilaian_sidang)
    {
        $penilaianSidangTa = PenilaianSidangTugasAkhir::where('penjadwalan_sidangta_id', $penilaian_sidang->id)->get()->first();
        if(auth()->user()->dosen->id === $penilaian_sidang->penguji_utama_id) {
            $penilaianSidangTa->nilai_penguji_utama = $request->input('input_nilai');
            $penilaianSidangTa->approve_penguji_utama = 1;
            $penilaianSidangTa->save();

            return redirect('berita-acara-sidang/' . $penilaian_sidang->id);
        }elseif (auth()->user()->dosen->id === $penilaian_sidang->uji1_id) {
            $penilaianSidangTa->nilai_penguji1 = $request->input('input_nilai');
            $penilaianSidangTa->approve_penguji1 = 1;
            $penilaianSidangTa->save();

            return redirect('berita-acara-sidang/' . $penilaian_sidang->id);
        }elseif (auth()->user()->dosen->id === $penilaian_sidang->uji2_id) {
            $penilaianSidangTa->nilai_penguji2 = $request->input('input_nilai');
            $penilaianSidangTa->approve_penguji2 = 1;
            $penilaianSidangTa->save();

            return redirect('berita-acara-sidang/' . $penilaian_sidang->id);
        }elseif (auth()->user()->dosen->id === $penilaian_sidang->uji3_id) {
            $penilaianSidangTa->nilai_penguji3 = $request->input('input_nilai');
            $penilaianSidangTa->approve_penguji3 = 1;
            $penilaianSidangTa->save();

            return redirect('berita-acara-sidang/' . $penilaian_sidang->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenjadwalanSidangTugasAkhir $penilaian_sidang)
    {
        //
    }

    public function beritaAcara(PenjadwalanSidangTugasAkhir $id) {
        $infoPenilaian = PenilaianSidangTugasAkhir::where('pengajuan_sidangta_id', $id->pengajuan_sidang_tugas_akhir_id)->get()->first();

        $hasil = ($infoPenilaian->nilai_penguji_utama + $infoPenilaian->nilai_penguji1 + $infoPenilaian->nilai_penguji2 + $infoPenilaian->nilai_penguji3) / 4;

        $dosenPertama = Dosen::where('id', $infoPenilaian->penguji_utama_id)->get()->first();
        $dosenKedua = Dosen::where('id', $infoPenilaian->penguji1_id)->get()->first();
        $dosenKetiga = Dosen::where('id', $infoPenilaian->penguji2_id)->get()->first();
        $dosenKeempat = Dosen::where('id', $infoPenilaian->penguji3_id)->get()->first();

        return view('dashboard.berita_acara_sidang.index', [
            'infoSidang' => $id->load('pengajuansidangta'),
            'dospem1' => $dosenPertama,
            'dospem2' => $dosenKedua,
            'dospem3' => $dosenKetiga,
            'dospem4' => $dosenKeempat,
            'penilaian_sidang' => $infoPenilaian,
            'hasil_penilaian' => $hasil,
        ]);
    }

    public function formPerbaikan(PenjadwalanSidangTugasAkhir $id) {
        $datetimeRange = $id->tanggal_penjadwalan;
        $dates = explode(' ', $datetimeRange);
        $infoPenilaian = PenilaianSidangTugasAkhir::where('pengajuan_sidangta_id', $id->pengajuan_sidang_tugas_akhir_id)->get()->first();

        $dosenPertama = Dosen::where('id', $infoPenilaian->penguji_utama_id)->get()->first();
        $dosenKedua = Dosen::where('id', $infoPenilaian->penguji1_id)->get()->first();
        $dosenKetiga = Dosen::where('id', $infoPenilaian->penguji2_id)->get()->first();
        $dosenKeempat = Dosen::where('id', $infoPenilaian->penguji3_id)->get()->first();

        return view('dashboard.form_perbaikan_sidang.index', [
            'infoSidang' => $id->load('pengajuansidangta'),
            'tanggal_waktu' => $dates,
            'dospem1' => $dosenPertama,
            'dospem2' => $dosenKedua,
            'dospem3' => $dosenKetiga,
            'dospem4' => $dosenKeempat,
            'penilaian_sidang' => $infoPenilaian,
        ]);
    }
}
