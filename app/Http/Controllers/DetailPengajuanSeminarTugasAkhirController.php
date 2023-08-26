<?php

namespace App\Http\Controllers;

use App\Models\DetailPengajuanSeminarTugasAkhir;
use App\Models\DetailPengajuanTugasAkhir;
use App\Models\PengajuanTugasAkhir;
use App\Models\PenjadwalanSeminarTugasAkhir;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DetailPengajuanSeminarTugasAkhirController extends Controller
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
    public function show(DetailPengajuanSeminarTugasAkhir $detail_pengajuan_seminartum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailPengajuanSeminarTugasAkhir $detail_pengajuan_seminartum)
    {
        // dd($detail_pengajuan_seminartum->pengajuanseminarta());
        return view('dashboard.detail_pengajuan_seminarta.edit', [
            'detailpengajuan_seminarta' => $detail_pengajuan_seminartum->with(['pengajuanseminarta'])->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailPengajuanSeminarTugasAkhir $detail_pengajuan_seminartum)
    {
        // dd($detail_pengajuan_seminartum->pengajuanseminarta->id);

        if(Gate::allows('IsKoordinator')) {
            // dd($request);
            $inputs = $request->all();

            if($request->input('ket_kwitansi') !== "Diterima") {
                $imageName = $detail_pengajuan_seminartum->pengajuanseminarta->foto_kwitansi; // Ganti ini dengan logika yang sesuai untuk mendapatkan nama gambar dari database
                if ($imageName) {
                    Storage::delete($imageName);
                }
                $detail_pengajuan_seminartum->pengajuanseminarta->foto_kwitansi = "";
            }

            
            if($request->input('ket_khs') !== "Diterima") {
                $imageName = $detail_pengajuan_seminartum->pengajuanseminarta->foto_khs; // Ganti ini dengan logika yang sesuai untuk mendapatkan nama gambar dari database
                if ($imageName) {
                    Storage::delete($imageName);
                }
                $detail_pengajuan_seminartum->pengajuanseminarta->foto_khs = "";
            }
            
            if($request->input('ket_krs') !== "Diterima") {
                $imageName = $detail_pengajuan_seminartum->pengajuanseminarta->foto_krs; // Ganti ini dengan logika yang sesuai untuk mendapatkan nama gambar dari database
                if ($imageName) {
                    Storage::delete($imageName);
                }
                $detail_pengajuan_seminartum->pengajuanseminarta->foto_krs = "";
            }

            if($request->input('ket_persetujuan_seminarta') !== "Diterima") {
                $imageName = $detail_pengajuan_seminartum->pengajuanseminarta->lembar_persetujuan_seminarta; // Ganti ini dengan logika yang sesuai untuk mendapatkan nama gambar dari database
                if ($imageName) {
                    Storage::delete($imageName);
                }
                $detail_pengajuan_seminartum->pengajuanseminarta->lembar_persetujuan_seminarta = "";
            }

            if($request->input('ket_lembar_bimbingan1') !== "Diterima") {
                $imageName = $detail_pengajuan_seminartum->pengajuanseminarta->lembar_bimbingan1; // Ganti ini dengan logika yang sesuai untuk mendapatkan nama gambar dari database
                if ($imageName) {
                    Storage::delete($imageName);
                }
                $detail_pengajuan_seminartum->pengajuanseminarta->lembar_bimbingan1 = "";
            }

            if($request->input('ket_lembar_bimbingan2') !== "Diterima") {
                $imageName = $detail_pengajuan_seminartum->pengajuanseminarta->lembar_bimbingan2; // Ganti ini dengan logika yang sesuai untuk mendapatkan nama gambar dari database
                if ($imageName) {
                    Storage::delete($imageName);
                }
                $detail_pengajuan_seminartum->pengajuanseminarta->lembar_bimbingan2 = "";
            }

            if($request->input('ket_sk_ta') !== "Diterima") {
                $fileName = $detail_pengajuan_seminartum->pengajuanseminarta->sk_ta; // Ganti ini dengan logika yang sesuai untuk mendapatkan nama gambar dari database
                if ($fileName) {
                    Storage::delete($fileName);
                }
                $detail_pengajuan_seminartum->pengajuanseminarta->sk_ta = "";
            }

            if($request->input('ket_draft_laporan') !== "Diterima") {
                $fileName = $detail_pengajuan_seminartum->pengajuanseminarta->draft_laporan; // Ganti ini dengan logika yang sesuai untuk mendapatkan nama gambar dari database
                if ($fileName) {
                    Storage::delete($fileName);
                }
                $detail_pengajuan_seminartum->pengajuanseminarta->draft_laporan = "";
            }

            if($request->input('ket_sertifikat_kegiatan') !== "Diterima") {
                $imageName = $detail_pengajuan_seminartum->pengajuanseminarta->sertifikat_kegiatan; // Ganti ini dengan logika yang sesuai untuk mendapatkan nama gambar dari database
                if ($imageName) {
                    Storage::delete($imageName);
                }
                $sertifikatPaths = array_filter($sertifikatPaths, function ($path) use ($imageName) {
                    return $path !== $imageName;
                });
                $detail_pengajuan_seminartum->pengajuanseminarta->sertifikat_kegiatan = json_encode($sertifikatPaths);
            }

            $detail_pengajuan_seminartum->ket_kwitansi = $request->input('ket_kwitansi') === "Diterima" ? true : false;
            $detail_pengajuan_seminartum->ket_khs = $request->input('ket_khs') === "Diterima" ? true : false;
            $detail_pengajuan_seminartum->ket_krs = $request->input('ket_krs') === "Diterima" ? true : false;
            $detail_pengajuan_seminartum->ket_persetujuan_seminarta = $request->input('ket_persetujuan_seminarta') === "Diterima" ? true : false;
            $detail_pengajuan_seminartum->ket_lembar_bimbingan1 = $request->input('ket_lembar_bimbingan1') === "Diterima" ? true : false;
            $detail_pengajuan_seminartum->ket_lembar_bimbingan2 = $request->input('ket_lembar_bimbingan2') === "Diterima" ? true : false;
            $detail_pengajuan_seminartum->ket_sk_ta = $request->input('ket_sk_ta') === "Diterima" ? true : false;
            $detail_pengajuan_seminartum->ket_draft_laporan = $request->input('ket_draft_laporan') === "Diterima" ? true : false;
            $detail_pengajuan_seminartum->ket_sertifikat_kegiatan = $request->input('ket_sertifikat_kegiatan') === "Diterima" ? true : false;
            
            $detail_pengajuan_seminartum->tanggapan = $request->input('tanggapan');

            if (in_array(false, [
                    $detail_pengajuan_seminartum->ket_kwitansi,
                    $detail_pengajuan_seminartum->ket_khs,
                    $detail_pengajuan_seminartum->ket_krs,
                    $detail_pengajuan_seminartum->ket_persetujuan_seminarta,
                    $detail_pengajuan_seminartum->ket_lembar_bimbingan1,
                    $detail_pengajuan_seminartum->ket_lembar_bimbingan2,
                    $detail_pengajuan_seminartum->ket_sk_ta,
                    $detail_pengajuan_seminartum->ket_draft_laporan,
                    $detail_pengajuan_seminartum->ket_sertifikat_kegiatan,
                ], true)) {
                    // Jika ada setidaknya satu status bernilai false
                    $detail_pengajuan_seminartum->pengajuanseminarta->status_pengajuan_seminar = 0;
                } else {
                    // Jika semua status bernilai true
                    $detail_pengajuan_seminartum->pengajuanseminarta->status_pengajuan_seminar = 3;
                    // $detail_pengajuan_seminartum->tanggal_penerimaan = Carbon::now('Asia/Jakarta')->format('d-m-Y');
                }
                
                
            // dd($request->input('tanggapan_koordinator'));
            $detail_pengajuan_seminartum->pengajuanseminarta->save(); // Simpan perubahan pada objek terkait
            $detail_pengajuan_seminartum->save(); // Simpan perubahan pada objek DetailPengajuanTugasAkhir
            
            return redirect('dashboard/pengajuan-seminarta')->with('success', 'Data Pengajuan seminar Mahasiswa has been Updated!');
            
        }elseif (Gate::allows('IsDekan')) {
            $detail_pengajuan_seminartum->status_approve = 1;
            $detail_pengajuan_seminartum->tanggal_penerimaan = Carbon::now('Asia/Jakarta')->format('d-m-Y');
            $detail_pengajuan_seminartum->pengajuanseminarta->status_pengajuan_seminar = 4;

            $detail_pengajuan_seminartum->pengajuanseminarta->save();
            $detail_pengajuan_seminartum->save();

            $userIdSeminar = $detail_pengajuan_seminartum->pengajuanseminarta->user_id;
            $detailPengajuanTa = PengajuanTugasAkhir::where('user_id', $userIdSeminar)->get()->first();
            
            // dd($detailPengajuanTa->detailpengajuantugasakhir->usulanDospemKaprodiPertama);

            $penjadwalanseminarta = new PenjadwalanSeminarTugasAkhir();
            $penjadwalanseminarta->create([
                'pengajuan_seminarta_id' => $detail_pengajuan_seminartum->pengajuanseminarta->id,
                'tanggal_approve_seminarta' => $detail_pengajuan_seminartum->tanggal_penerimaan,
                'pembimbing_1' => $detailPengajuanTa->detailpengajuantugasakhir->usulanDospemKaprodiPertama->singkatan,
                'pembimbing_2' => $detailPengajuanTa->detailpengajuantugasakhir->usulanDospemKaprodiKedua->singkatan,
                'tanggal_penjadwalan' => "",
                'waktu_seminar' => "",
                'ruangan' => "",
                'keterangan' => "", 
            ]);

            return redirect('dashboard/pengajuan-seminarta')->with('success', 'Pengajuan Seminar Mahasiswa has been approved!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailPengajuanSeminarTugasAkhir $detail_pengajuan_seminartum)
    {
        //
    }
}
