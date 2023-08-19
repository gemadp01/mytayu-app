<?php

namespace App\Http\Controllers;

use App\Models\DetailPengajuanTugasAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
// use App\Models\PengajuanTugasAkhir;

class DetailPengajuanTugasAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(DetailPengajuanTugasAkhir $detail_pengajuan_tum)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailPengajuanTugasAkhir $detail_pengajuan_tum)
    {
        return view('dashboard.detail_pengajuan_tugas_akhir.edit', [
            'detailpengajuanta' => $detail_pengajuan_tum->load('pengajuanta'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailPengajuanTugasAkhir $detail_pengajuan_tum)
    {
        // dd($request);
        $inputs = $request->all();

        if($request->input('ket_kwitansi') !== "Diterima") {
            $imageName = $detail_pengajuan_tum->pengajuanta->foto_kwitansi; // Ganti ini dengan logika yang sesuai untuk mendapatkan nama gambar dari database
            if ($imageName) {
                Storage::delete($imageName);
            }
            $detail_pengajuan_tum->pengajuanta->foto_kwitansi = "";
        }

        if($request->input('ket_ktm') !== "Diterima") {
            $imageName = $detail_pengajuan_tum->pengajuanta->foto_ktm; // Ganti ini dengan logika yang sesuai untuk mendapatkan nama gambar dari database
            if ($imageName) {
                Storage::delete($imageName);
            }
            $detail_pengajuan_tum->pengajuanta->foto_ktm = "";
        }

        if($request->input('ket_khs') !== "Diterima") {
            $imageName = $detail_pengajuan_tum->pengajuanta->foto_khs; // Ganti ini dengan logika yang sesuai untuk mendapatkan nama gambar dari database
            if ($imageName) {
                Storage::delete($imageName);
            }
            $detail_pengajuan_tum->pengajuanta->foto_khs = "";
        }

        if($request->input('ket_krs') !== "Diterima") {
            $imageName = $detail_pengajuan_tum->pengajuanta->foto_krs; // Ganti ini dengan logika yang sesuai untuk mendapatkan nama gambar dari database
            if ($imageName) {
                Storage::delete($imageName);
            }
            $detail_pengajuan_tum->pengajuanta->foto_krs = "";
        }
        $detail_pengajuan_tum->tanggapan = $request->input('tanggapan_koordinator');
        $detail_pengajuan_tum->ket_kwitansi = $request->input('ket_kwitansi') === "Diterima" ? true : false;
        $detail_pengajuan_tum->ket_ktm = $request->input('ket_ktm') === "Diterima" ? true : false;
        $detail_pengajuan_tum->ket_khs = $request->input('ket_khs') === "Diterima" ? true : false;
        $detail_pengajuan_tum->ket_krs = $request->input('ket_krs') === "Diterima" ? true : false;
        

        if (in_array(false, [
                $detail_pengajuan_tum->ket_kwitansi,
                $detail_pengajuan_tum->ket_ktm,
                $detail_pengajuan_tum->ket_khs,
                $detail_pengajuan_tum->ket_krs,
            ], true)) {
                // Jika ada setidaknya satu status bernilai false
                $detail_pengajuan_tum->pengajuanta->status_pengajuan = 0;
            } else {
                // Jika semua status bernilai true
                $detail_pengajuan_tum->pengajuanta->status_pengajuan = 2;
                $detail_pengajuan_tum->tanggal_penerimaan = Carbon::now('Asia/Jakarta')->format('d-m-Y');
            }
            
        // dd($request->input('tanggapan_koordinator'));
        $detail_pengajuan_tum->pengajuanta->save(); // Simpan perubahan pada objek terkait
        $detail_pengajuan_tum->save(); // Simpan perubahan pada objek DetailPengajuanTugasAkhir
        
        return redirect('dashboard/pengajuan-ta')->with('success', 'Dosen has been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailPengajuanTugasAkhir $detail_pengajuan_tum)
    {
        //
    }
}