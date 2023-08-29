<?php

namespace App\Http\Controllers;

use App\Models\DetailPengajuanTugasAkhir;
use App\Models\Bimbingan;
use App\Models\PengajuanTugasAkhir;
use App\Models\Dosen;
use Illuminate\Http\Request;

class MahasiswaBimbinganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen = auth()->user()->dosen;
        return view('dashboard.mahasiswa_bimbingan.index', [
            'dospemsatu' => DetailPengajuanTugasAkhir::where('usulan_pembimbing_kaprodi1_id', $dosen->id)
                    ->orWhere('usulan_pembimbing_kaprodi1_id', $dosen->id)
                    ->paginate(5),
            'dospemdua' => DetailPengajuanTugasAkhir::where('usulan_pembimbing_kaprodi2_id', $dosen->id)
                    ->orWhere('usulan_pembimbing_kaprodi2_id', $dosen->id)
                    ->paginate(5),
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
    public function show(DetailPengajuanTugasAkhir $detailPengajuanTugasAkhir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailPengajuanTugasAkhir $detailPengajuanTugasAkhir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailPengajuanTugasAkhir $detailPengajuanTugasAkhir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailPengajuanTugasAkhir $detailPengajuanTugasAkhir)
    {
        //
    }

    public function formBimbingan($idUser, $idDospem) {
        $userTerkait = PengajuanTugasAkhir::where('user_id', $idUser)->get()->first();
        $dosenPertama = Dosen::where('id', $userTerkait->detailpengajuantugasakhir->usulan_pembimbing_kaprodi1_id)->get()->first();
        $dosenKedua = Dosen::where('id', $userTerkait->detailpengajuantugasakhir->usulan_pembimbing_kaprodi2_id)->get()->first();
        $bimbinganMahasiswa = Bimbingan::where('user_id', $idUser)->where('pembimbing_id', $idDospem)->latest()->paginate(5);

        return view('dashboard.form_bimbingan.index', [
            'bimbingans' => $bimbinganMahasiswa,
            'infoMahasiswa' => $userTerkait,
            'dospem1' => $dosenPertama,
            'dospem2' => $dosenKedua,
        ]);
    }
}
