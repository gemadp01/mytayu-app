<?php

namespace App\Http\Controllers;

use App\Models\DetailPengajuanSidangTugasAkhir;
use App\Models\PengajuanTugasAkhir;
use App\Models\Dosen;
use App\Models\PenjadwalanSidangTugasAkhir;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DetailPengajuanSidangTugasAkhirController extends Controller
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
    public function show(DetailPengajuanSidangTugasAkhir $detail_pengajuan_sidangtum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailPengajuanSidangTugasAkhir $detail_pengajuan_sidangtum)
    {
        $userTerkait = PengajuanTugasAkhir::where('user_id', $detail_pengajuan_sidangtum->pengajuansidangta->user_id)->get()->first();
        $dosenPertama = Dosen::where('id', $userTerkait->detailpengajuantugasakhir->usulan_pembimbing_kaprodi1_id)->get()->first();
        $dosenKedua = Dosen::where('id', $userTerkait->detailpengajuantugasakhir->usulan_pembimbing_kaprodi2_id)->get()->first();
        return view('dashboard.detail_pengajuan_sidangta.edit', [
            'detailpengajuan_sidangta' => $detail_pengajuan_sidangtum->with(['pengajuansidangta'])->get()->first(),
            'dospem1' => $dosenPertama,
            'dospem2' => $dosenKedua,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailPengajuanSidangTugasAkhir $detail_pengajuan_sidangtum)
    {

        if(Gate::allows('IsKoordinator')) {
            // dd($detail_pengajuan_sidangtum->pengajuansidangta);
            $inputs = $request->all();

            if($request->input('ket_lampiran_kwitansi_wisuda') !== "Diterima") {
                $imageName = $detail_pengajuan_sidangtum->pengajuansidangta->foto_kwitansi_wisuda;
                if ($imageName) {
                    Storage::delete($imageName);
                }
                $detail_pengajuan_sidangtum->pengajuansidangta->foto_kwitansi_wisuda = "";
            }

            if($request->input('ket_lampiran_kwitansi_ta') !== "Diterima") {
                $imageName = $detail_pengajuan_sidangtum->pengajuansidangta->foto_kwitansi_ta; 
                if ($imageName) {
                    Storage::delete($imageName);
                }
                $detail_pengajuan_sidangtum->pengajuansidangta->foto_kwitansi_ta = "";
            }

            
            if($request->input('ket_lampiran_khs') !== "Diterima") {
                $imageName = $detail_pengajuan_sidangtum->pengajuansidangta->khs; 
                if ($imageName) {
                    Storage::delete($imageName);
                }
                $detail_pengajuan_sidangtum->pengajuansidangta->khs = "";
            }
            
            if($request->input('ket_lampiran_krs') !== "Diterima") {
                $imageName = $detail_pengajuan_sidangtum->pengajuansidangta->krs; 
                if ($imageName) {
                    Storage::delete($imageName);
                }
                $detail_pengajuan_sidangtum->pengajuansidangta->krs = "";
            }

            if($request->input('ket_lampiran_ktm') !== "Diterima") {
                $imageName = $detail_pengajuan_sidangtum->pengajuansidangta->ktm; 
                if ($imageName) {
                    Storage::delete($imageName);
                }
                $detail_pengajuan_sidangtum->pengajuansidangta->ktm = "";
            }

            if($request->input('ket_lampiran_sk_pembimbing') !== "Diterima") {
                $fileName = $detail_pengajuan_sidangtum->pengajuansidangta->sk_pembimbing; 
                if ($fileName) {
                    Storage::delete($fileName);
                }
                $detail_pengajuan_sidangtum->pengajuansidangta->sk_pembimbing = "";
            }

            if($request->input('ket_persetujuan_sidang') !== "Diterima") {
                $imageName = $detail_pengajuan_sidangtum->pengajuansidangta->lembar_persetujuan_sidang; 
                if ($imageName) {
                    Storage::delete($imageName);
                }
                $detail_pengajuan_sidangtum->pengajuansidangta->lembar_persetujuan_sidang = "";
            }

            if($request->input('ket_lampiran_draft') !== "Diterima") {
                $fileName = $detail_pengajuan_sidangtum->pengajuansidangta->draft_laporan; 
                if ($fileName) {
                    Storage::delete($fileName);
                }
                $detail_pengajuan_sidangtum->pengajuansidangta->draft_laporan = "";
            }

            if ($request->input('ket_lampiran_sertifikat_kegiatan') !== "Diterima") {
                $sertifikatPaths = json_decode($detail_pengajuan_sidangtum->pengajuansidangta->sertifikat_kegiatan);

                foreach ($sertifikatPaths as $path) {
                    // Menghapus gambar fisik dari sistem penyimpanan
                    Storage::delete($path);
                }

                // Menghapus semua paths dari array $sertifikatPaths
                $sertifikatPaths = [];

                // Mengubah array kembali menjadi JSON dan menyimpan perubahan ke kolom 'sertifikat_kegiatan' dalam database
                $detail_pengajuan_sidangtum->pengajuansidangta->sertifikat_kegiatan = json_encode($sertifikatPaths);
                $detail_pengajuan_sidangtum->pengajuansidangta->save(); // Simpan perubahan ke database
            }

            if($request->input('ket_lampiran_sertifikat_pkkmb') !== "Diterima") {
                $imageName = $detail_pengajuan_sidangtum->pengajuansidangta->sertifikat_pkkmb; 
                if ($imageName) {
                    Storage::delete($imageName);
                }
                $detail_pengajuan_sidangtum->pengajuansidangta->sertifikat_pkkmb = "";
            }

            if($request->input('ket_lampiran_sertifikat_toefl') !== "Diterima") {
                $imageName = $detail_pengajuan_sidangtum->pengajuansidangta->sertifikat_toefl; 
                if ($imageName) {
                    Storage::delete($imageName);
                }
                $detail_pengajuan_sidangtum->pengajuansidangta->sertifikat_toefl = "";
            }

            if($request->input('ket_lampiran_ijazah') !== "Diterima") {
                $imageName = $detail_pengajuan_sidangtum->pengajuansidangta->foto_ijazah_sma; 
                if ($imageName) {
                    Storage::delete($imageName);
                }
                $detail_pengajuan_sidangtum->pengajuansidangta->foto_ijazah_sma = "";
            }

            if($request->input('ket_lampiran_sbb_pendidikan') !== "Diterima") {
                $imageName = $detail_pengajuan_sidangtum->pengajuansidangta->sbb; 
                if ($imageName) {
                    Storage::delete($imageName);
                }
                $detail_pengajuan_sidangtum->pengajuansidangta->sbb = "";
            }

            if($request->input('ket_lampiran_sbb_perpustakaan') !== "Diterima") {
                $imageName = $detail_pengajuan_sidangtum->pengajuansidangta->sbb_perpustakaan; 
                if ($imageName) {
                    Storage::delete($imageName);
                }
                $detail_pengajuan_sidangtum->pengajuansidangta->sbb_perpustakaan = "";
            }

            $detail_pengajuan_sidangtum->ket_lampiran_kwitansi_wisuda = $request->input('ket_lampiran_kwitansi_wisuda') === "Diterima" ? true : false;
            $detail_pengajuan_sidangtum->ket_lampiran_kwitansi_ta = $request->input('ket_lampiran_kwitansi_ta') === "Diterima" ? true : false;
            $detail_pengajuan_sidangtum->ket_lampiran_khs = $request->input('ket_lampiran_khs') === "Diterima" ? true : false;
            $detail_pengajuan_sidangtum->ket_lampiran_krs = $request->input('ket_lampiran_krs') === "Diterima" ? true : false;
            $detail_pengajuan_sidangtum->ket_lampiran_ktm = $request->input('ket_lampiran_ktm') === "Diterima" ? true : false;
            $detail_pengajuan_sidangtum->ket_persetujuan_sidang = $request->input('ket_persetujuan_sidang') === "Diterima" ? true : false;
            $detail_pengajuan_sidangtum->ket_lampiran_bimbingan1 = $request->input('ket_lampiran_bimbingan1') === "Diterima" ? true : false;
            $detail_pengajuan_sidangtum->ket_lampiran_bimbingan2 = $request->input('ket_lampiran_bimbingan2') === "Diterima" ? true : false;
            $detail_pengajuan_sidangtum->ket_lampiran_sk_pembimbing = $request->input('ket_lampiran_sk_pembimbing') === "Diterima" ? true : false;
            $detail_pengajuan_sidangtum->ket_sbb_pendidikan = $request->input('ket_sbb_pendidikan') === "Diterima" ? true : false;
            $detail_pengajuan_sidangtum->ket_sbb_perpustakaan = $request->input('ket_sbb_perpustakaan') === "Diterima" ? true : false;
            $detail_pengajuan_sidangtum->ket_lampiran_draft = $request->input('ket_lampiran_draft') === "Diterima" ? true : false;
            $detail_pengajuan_sidangtum->ket_lampiran_sertifikat_kegiatan = $request->input('ket_lampiran_sertifikat_kegiatan') === "Diterima" ? true : false;
            $detail_pengajuan_sidangtum->ket_lampiran_sertifikat_pkkmb = $request->input('ket_lampiran_sertifikat_pkkmb') === "Diterima" ? true : false;
            $detail_pengajuan_sidangtum->ket_lampiran_sertifikat_toefl = $request->input('ket_lampiran_sertifikat_toefl') === "Diterima" ? true : false;
            $detail_pengajuan_sidangtum->ket_lampiran_ijazah = $request->input('ket_lampiran_ijazah') === "Diterima" ? true : false;
            
            $detail_pengajuan_sidangtum->tanggapan = $request->input('tanggapan');

            if (in_array(false, [
                    $detail_pengajuan_sidangtum->ket_lampiran_kwitansi_wisuda,
                    $detail_pengajuan_sidangtum->ket_lampiran_kwitansi_ta,
                    $detail_pengajuan_sidangtum->ket_lampiran_khs,
                    $detail_pengajuan_sidangtum->ket_lampiran_krs,
                    $detail_pengajuan_sidangtum->ket_lampiran_ktm,
                    $detail_pengajuan_sidangtum->ket_persetujuan_sidang,
                    $detail_pengajuan_sidangtum->ket_lampiran_bimbingan1,
                    $detail_pengajuan_sidangtum->ket_lampiran_bimbingan2,
                    $detail_pengajuan_sidangtum->ket_lampiran_sk_pembimbing,
                    $detail_pengajuan_sidangtum->ket_sbb_pendidikan,
                    $detail_pengajuan_sidangtum->ket_sbb_perpustakaan,
                    $detail_pengajuan_sidangtum->ket_lampiran_draft,
                    $detail_pengajuan_sidangtum->ket_lampiran_sertifikat_kegiatan,
                    $detail_pengajuan_sidangtum->ket_lampiran_sertifikat_pkkmb,
                    $detail_pengajuan_sidangtum->ket_lampiran_sertifikat_toefl,
                    $detail_pengajuan_sidangtum->ket_lampiran_ijazah,

                ], true)) {
                    // Jika ada setidaknya satu status bernilai false
                    $detail_pengajuan_sidangtum->pengajuansidangta->status_pengajuan_sidang = 0;
                } else {
                    // Jika semua status bernilai true
                    $detail_pengajuan_sidangtum->pengajuansidangta->status_pengajuan_sidang = 2;
                    $detail_pengajuan_sidangtum->tanggal_penerimaan = Carbon::now('Asia/Jakarta')->format('d-m-Y');
                }
                
                
            // dd($request->input('tanggapan_koordinator'));
            $detail_pengajuan_sidangtum->pengajuansidangta->save(); // Simpan perubahan pada objek terkait
            $detail_pengajuan_sidangtum->save(); // Simpan perubahan pada objek DetailPengajuanTugasAkhir

            $userTerkait = PengajuanTugasAkhir::where('user_id', $detail_pengajuan_sidangtum->pengajuansidangta->user_id)->get()->first();
            $dosenPertama = Dosen::where('id', $userTerkait->detailpengajuantugasakhir->usulan_pembimbing_kaprodi1_id)->get()->first();
            $dosenKedua = Dosen::where('id', $userTerkait->detailpengajuantugasakhir->usulan_pembimbing_kaprodi2_id)->get()->first();
            PenjadwalanSidangTugasAkhir::create([
                'pengajuan_sidang_tugas_akhir_id' => $detail_pengajuan_sidangtum->pengajuansidangta->id,
                'pembimbing1_id' => $dosenPertama->id,
                'pembimbing2_id' => $dosenKedua->id,
            ]);
            
            return redirect('dashboard/pengajuan-sidangta')->with('success', 'Data Pengajuan sidang Mahasiswa has been Updated!');
            
        }elseif (Gate::allows('IsKaprodi')) {
            
        }elseif (Gate::allows('IsDekan')) {
            // $detail_pengajuan_sidangtum->status_approve = 1;
            // $detail_pengajuan_sidangtum->tanggal_penerimaan = Carbon::now('Asia/Jakarta')->format('d-m-Y');
            // $detail_pengajuan_sidangtum->pengajuansidangta->status_pengajuan_seminar = 4;

            // $detail_pengajuan_sidangtum->pengajuansidangta->save();
            // $detail_pengajuan_sidangtum->save();

            // $userIdSeminar = $detail_pengajuan_sidangtum->pengajuansidangta->user_id;
            // $detailPengajuanTa = PengajuanTugasAkhir::where('user_id', $userIdSeminar)->get()->first();

            // $penjadwalansidangta = new PenjadwalanSeminarTugasAkhir();
            // $penjadwalansidangta->create([
            //     'pengajuan_sidangta_id' => $detail_pengajuan_sidangtum->pengajuansidangta->id,
            //     'tanggal_approve_sidangta' => $detail_pengajuan_sidangtum->tanggal_penerimaan,
            //     'pembimbing_1' => $detailPengajuanTa->detailpengajuantugasakhir->usulanDospemKaprodiPertama->singkatan,
            //     'pembimbing_2' => $detailPengajuanTa->detailpengajuantugasakhir->usulanDospemKaprodiKedua->singkatan,
            //     'tanggal_penjadwalan' => "",
            //     'waktu_seminar' => "",
            //     'ruangan' => "",
            //     'keterangan' => "", 
            // ]);

            // return redirect('dashboard/pengajuan-sidangta')->with('success', 'Pengajuan Seminar Mahasiswa has been approved!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailPengajuanSidangTugasAkhir $detail_pengajuan_sidangtum)
    {
        //
    }
}
