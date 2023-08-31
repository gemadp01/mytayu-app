<?php

namespace App\Http\Controllers;

use App\Models\PenjadwalanSidangTugasAkhir;
use App\Models\PenilaianSidangTugasAkhir;
use App\Models\PengajuanTugasAkhir;
use App\Models\PengajuanSidangTugasAkhir;
use App\Models\Dosen;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class PenjadwalanSidangTugasAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('IsMahasiswa')) {
            $pengajuanSidangTa = PengajuanSidangTugasAkhir::where('user_id', auth()->user()->id)->get()->first();
            $dosenPertama = Dosen::where('id', $pengajuanSidangTa->penjadwalansidangta->pembimbing1_id)->get()->first();
            $dosenKedua = Dosen::where('id', $pengajuanSidangTa->penjadwalansidangta->pembimbing2_id)->get()->first();

            return view('dashboard.penjadwalan_sidang.index', [
                'jadwal_sidangta' => PenjadwalanSidangTugasAkhir::where('pengajuan_sidang_tugas_akhir_id', $pengajuanSidangTa->id)->get()->first(),
                'dospem1' => $dosenPertama,
                'dospem2' => $dosenKedua,
            ]);
        }elseif (Gate::allows('IsDospem')) {
            $dosen = auth()->user()->dosen;
            return view('dashboard.penjadwalan_sidang.index', [
                'jadwal_sidangta1' => PenjadwalanSidangTugasAkhir::where('penguji_utama_id', $dosen->id)
                        ->orWhere('penguji_utama_id', $dosen->id)
                        ->paginate(5),
                'jadwal_sidangta2' => PenjadwalanSidangTugasAkhir::where('uji1_id', $dosen->id)
                        ->orWhere('uji1_id', $dosen->id)
                        ->paginate(5),
                'jadwal_sidangta3' => PenjadwalanSidangTugasAkhir::where('uji2_id', $dosen->id)
                        ->orWhere('uji2_id', $dosen->id)
                        ->paginate(5),
                'jadwal_sidangta4' => PenjadwalanSidangTugasAkhir::where('uji3_id', $dosen->id)
                        ->orWhere('uji3_id', $dosen->id)
                        ->paginate(5),
            ]);
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
    public function show(PenjadwalanSidangTugasAkhir $penjadwalan_sidang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenjadwalanSidangTugasAkhir $penjadwalan_sidang)
    {
        $ruangan = ['LAB A', 'LAB B', 'LAB C', 'LAB D', 'B209', 'B210', 'B211'];
        return view('dashboard.penjadwalan_sidang.edit', [
            'inputJadwal' => $penjadwalan_sidang->load('pengajuansidangta'),
            'ruangan' => $ruangan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenjadwalanSidangTugasAkhir $penjadwalan_sidang)
    {
        $validatedData = $request->validate([
            'tanggal_penjadwalan' => 'required',
            'ruangan' => 'required',
            'keterangan' => 'required',
        ]);

        // $validatedData['waktu_seminar'] = $request->input('tanggal_penjadwalan');

        $penjadwalan_sidang->update($validatedData);

        $datetimeRange = $request->input('tanggal_penjadwalan');
        $dates = explode(' ', $datetimeRange);

        $penjadwalan_sidang->waktu_sidang = $dates[1];
        $penjadwalan_sidang->save();

        PenilaianSidangTugasAkhir::create([
            'pengajuan_sidangta_id' => $penjadwalan_sidang->pengajuan_sidang_tugas_akhir_id,
            'penjadwalan_sidangta_id' => $penjadwalan_sidang->id,
            'penguji_utama_id' => $penjadwalan_sidang->penguji_utama_id,
            'penguji1_id' => $penjadwalan_sidang->uji1_id,
            'penguji2_id' => $penjadwalan_sidang->uji2_id,
            'penguji3_id' => $penjadwalan_sidang->uji3_id,
            'tanggal_berita_acara' => $dates[0],
        ]);

        

        return redirect('dashboard/penjadwalan-seminar-sidang')->with('success', 'New Penjadwalan has been added!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenjadwalanSidangTugasAkhir $penjadwalan_sidang)
    {
        //
    }
}
