<?php

namespace App\Http\Controllers;

use App\Models\PenjadwalanSidangTugasAkhir;
use App\Models\PengajuanSidangTugasAkhir;
use App\Models\PengajuanTugasAkhir;
use App\Models\Dosen;
use App\Models\TahunAkademik;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class InputUsulanPengujiSidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('IsKaprodi')) {
            $penjadwalanSidang = PenjadwalanSidangTugasAkhir::latest()->paginate(5);
            return view('dashboard.usulan_penguji_sidang.index', [
                'penguji_sidang' => $penjadwalanSidang,
                'infoDosen' => Dosen::all(),
                'tahunAkademik' => TahunAkademik::get()->first(),
            ]);
        }elseif (Gate::allows('IsDekan')) {
            return view('dashboard.usulan_penguji_sidang.index', [
                'data_pengajuan' => PenjadwalanSidangTugasAkhir::latest()->paginate(5),
                'infoDosen' => Dosen::all(),
                'tahunAkademik' => TahunAkademik::get()->first(),
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
    public function show(PenjadwalanSidangTugasAkhir $usulan_penguji_sidang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenjadwalanSidangTugasAkhir $usulan_penguji_sidang)
    {
        if (Gate::allows('IsKaprodi')) {
            // dd($usulan_penguji_sidang);
            $userTerkait = PengajuanTugasAkhir::where('user_id', $usulan_penguji_sidang->pengajuansidangta->user_id)->get()->first();
            $dosenPertama = Dosen::where('id', $userTerkait->detailpengajuantugasakhir->usulan_pembimbing_kaprodi1_id)->get()->first();
            $dosenKedua = Dosen::where('id', $userTerkait->detailpengajuantugasakhir->usulan_pembimbing_kaprodi2_id)->get()->first();
            $pilihanPenguji = Dosen::whereNotIn('id', [$dosenPertama->id, $dosenKedua->id])->get();
            return view('dashboard.usulan_penguji_sidang.edit', [
                'data_pengajuan' => $usulan_penguji_sidang->load('pengajuansidangta'),
                'infoDosen' => Dosen::all(),
                'pilihanPenguji' => $pilihanPenguji,
            ]);
        }elseif (Gate::allows('IsDekan')) {
            return view('dashboard.usulan_penguji_sidang.edit', [
                'data_pengajuan' => $usulan_penguji_sidang->load('pengajuansidangta'),
                'infoDosen' => Dosen::all(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenjadwalanSidangTugasAkhir $usulan_penguji_sidang)
    {
        if (Gate::allows('IsKaprodi')) {
            $validatedData = $request->validate([
                'penguji1_id' => 'required',
                'penguji2_id' => 'required',
            ]);

            $validatedData['tanggal_input_penguji'] = Carbon::now('Asia/Jakarta')->format('d-m-Y');

            $usulan_penguji_sidang->update($validatedData);
            $usulan_penguji_sidang->pengajuansidangta->status_pengajuan_sidang = 3;
            $usulan_penguji_sidang->pengajuansidangta->save();

            return redirect('dashboard/usulan-penguji-sidang')->with('success', 'New Penguji Sidang Tugas Akhir has been added!');

        }elseif (Gate::allows('IsDekan')) {
            // dd($request);
            $validatedData = $request->validate([
                'penguji_utama_id' => 'required',
                'uji1_id' => 'required',
                'uji2_id' => 'required',
                'uji3_id' => 'required',
            ]);

            $usulan_penguji_sidang->update($validatedData);
            $usulan_penguji_sidang->pengajuansidangta->status_pengajuan_sidang = 4;
            $usulan_penguji_sidang->pengajuansidangta->save();

            return redirect('dashboard/usulan-penguji-sidang')->with('success', 'New Penguji Sidang Tugas Akhir has been updated!');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenjadwalanSidangTugasAkhir $usulan_penguji_sidang)
    {
        //
    }

    public function getPenguji($selectedPembimbingSatu, $selectedPembimbingDua) {
        $dosenPertama = Dosen::where('id', $selectedPembimbingSatu)->get()->first();
        $dosenKedua = Dosen::where('id', $selectedPembimbingDua)->get()->first();
        $pilihanPenguji = Dosen::whereNotIn('id', [$dosenPertama->id, $dosenKedua->id])->get();

        return json_encode($pilihanPenguji);
    }
}
