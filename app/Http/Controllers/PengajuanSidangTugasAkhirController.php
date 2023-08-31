<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSidangTugasAkhir;
use App\Models\DetailPengajuanSidangTugasAkhir;
use App\Models\PengajuanTugasAkhir;
use App\Models\Dosen;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class PengajuanSidangTugasAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('IsMahasiswa')) {
            return view('dashboard.pengajuan_sidangta.index', [
                'pengajuansidangta' => PengajuanSidangTugasAkhir::latest()->where('user_id', auth()->user()->id)->get(),
            ]);
            
        }elseif (Gate::allows('IsKoordinator') || Gate::allows('IsKaprodi') || Gate::allows('IsDekan')) {
            return view('dashboard.pengajuan_sidangta.index', [
                'pengajuansidangtas' => PengajuanSidangTugasAkhir::with(['detailpengajuansidangta'])->latest()->paginate(10),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pengajuan_sidangta.create', [
            'data_ta' => PengajuanTugasAkhir::where('user_id', auth()->user()->id)->get()->first(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'npm' => 'required|max:8',
            'nama' => 'required',
            'program_studi' => 'required',
            'kelas' => 'required',
            'nomor_telepon' => 'nullable',
            'email' => 'nullable',
            'foto_kwitansi_wisuda' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'foto_kwitansi_ta' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'khs' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'krs' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'ktm' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'sk_pembimbing' => 'required|mimes:pdf|max:2048',
            'sbb' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'sbb_perpustakaan' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'foto_ijazah_sma' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'lembar_persetujuan_sidang' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'judul_sdta' => 'required',
            'draft_laporan' => 'required|mimes:pdf|max:5120',
            'sertifikat_pkkmb' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'sertifikat_toefl' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'sertifikat_kegiatan.*' => 'image|file|mimes:jpeg,png,jpg|max:2048', 
            'sertifikat_kegiatan' => 'max:10', 
        ]);

        $validatedData['foto_kwitansi_wisuda'] = $request->file('foto_kwitansi_wisuda')->store('pengajuan-sidangta-images');
        $validatedData['foto_kwitansi_ta'] = $request->file('foto_kwitansi_ta')->store('pengajuan-sidangta-images');
        $validatedData['khs'] = $request->file('khs')->store('pengajuan-sidangta-images');
        $validatedData['krs'] = $request->file('krs')->store('pengajuan-sidangta-images');
        $validatedData['ktm'] = $request->file('ktm')->store('pengajuan-sidangta-images');
        $validatedData['sbb'] = $request->file('sbb')->store('pengajuan-sidangta-images');
        $validatedData['sbb_perpustakaan'] = $request->file('sbb_perpustakaan')->store('pengajuan-sidangta-images');
        $validatedData['foto_ijazah_sma'] = $request->file('foto_ijazah_sma')->store('pengajuan-sidangta-images');

        $validatedData['lembar_persetujuan_sidang'] = $request->file('lembar_persetujuan_sidang')->store('pengajuan-sidangta-images');

        $validatedData['draft_laporan'] = $request->file('draft_laporan')->store('pengajuan-sidangta-files');
        $validatedData['sk_pembimbing'] = $request->file('sk_pembimbing')->store('pengajuan-sidangta-files');

        $validatedData['sertifikat_pkkmb'] = $request->file('sertifikat_pkkmb')->store('pengajuan-sidangta-images');
        $validatedData['sertifikat_toefl'] = $request->file('sertifikat_toefl')->store('pengajuan-sidangta-images');

        $sertifikatKegiatan = $request->file('sertifikat_kegiatan');

        if ($sertifikatKegiatan) {
            $sertifikatPaths = [];

            foreach ($sertifikatKegiatan as $sertifikat) {
                $path = $sertifikat->store('pengajuan-sidangta-images');
                $sertifikatPaths[] = $path;
            }

            
            $validatedData['sertifikat_kegiatan'] = json_encode($sertifikatPaths);
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['no_pengajuan_sidang'] = 'SDTA' . rand(100000, 999999);
        $validatedData['tanggal_pengajuan'] = Carbon::now('Asia/Jakarta')->format('d-m-Y');
        $validatedData['status_pengajuan_sidang'] = 1;

        $pengajuansidangta = PengajuanSidangTugasAkhir::create($validatedData);

        DetailPengajuanSidangTugasAkhir::create([
            'pengajuan_sidang_tugas_akhir_id' => $pengajuansidangta->id,
        ]);

        return redirect('dashboard/pengajuan-sidangta')->with('success', 'New Pengajuan Sidang Tugas Akhir has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PengajuanSidangTugasAkhir $pengajuan_sidangtum)
    {
        $userTerkait = PengajuanTugasAkhir::where('user_id', $pengajuan_sidangtum->user_id)->get()->first();
        $dosenPertama = Dosen::where('id', $userTerkait->detailpengajuantugasakhir->usulan_pembimbing_kaprodi1_id)->get()->first();
        $dosenKedua = Dosen::where('id', $userTerkait->detailpengajuantugasakhir->usulan_pembimbing_kaprodi2_id)->get()->first();
        return view('dashboard.pengajuan_sidangta.show', [
            'detailpengajuan_sidang' => $pengajuan_sidangtum->load(['detailpengajuansidangta', 'penjadwalansidangta']),
            'dospem1' => $dosenPertama,
            'dospem2' => $dosenKedua,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengajuanSidangTugasAkhir $pengajuan_sidangtum)
    {
        return view('dashboard.pengajuan_sidangta.edit', [
            'detailpengajuan_sidangta' => $pengajuan_sidangtum->load(['detailpengajuansidangta']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengajuanSidangTugasAkhir $pengajuan_sidangtum)
    {
        $validatedData = $request->validate([
            'foto_kwitansi_wisuda' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'foto_kwitansi_ta' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'khs' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'krs' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'ktm' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'sk_pembimbing' => 'file|mimes:pdf|max:2048',
            'sbb' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'sbb_perpustakaan' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'foto_ijazah_sma' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'lembar_persetujuan_sidang' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'draft_laporan' => 'file|mimes:pdf|max:5120',
            'sertifikat_pkkmb' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'sertifikat_toefl' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'sertifikat_kegiatan.*' => 'image|file|mimes:jpeg,png,jpg|max:2048', 
            'sertifikat_kegiatan' => 'max:10', 
        ]);

        if($pengajuan_sidangtum->detailpengajuansidangta->ket_lampiran_kwitansi_wisuda){
            $validatedData['foto_kwitansi_wisuda'] = $pengajuan_sidangtum->foto_kwitansi_wisuda;
        }else {
            $validatedData['foto_kwitansi_wisuda'] = $request->file('foto_kwitansi_wisuda')->store('pengajuan-sidangta-images');
        }


        if($pengajuan_sidangtum->detailpengajuansidangta->ket_lampiran_kwitansi_ta){
            $validatedData['foto_kwitansi_ta'] = $pengajuan_sidangtum->foto_kwitansi_ta;
        }else {
            $validatedData['foto_kwitansi_ta'] = $request->file('foto_kwitansi_ta')->store('pengajuan-sidangta-images');
        }

        if($pengajuan_sidangtum->detailpengajuansidangta->ket_lampiran_khs){
            $validatedData['khs'] = $pengajuan_sidangtum->khs;
        }else {
            $validatedData['khs'] = $request->file('khs')->store('pengajuan-sidangta-images');
        }

        if($pengajuan_sidangtum->detailpengajuansidangta->ket_lampiran_krs){
            $validatedData['krs'] = $pengajuan_sidangtum->krs;
        }else {
            $validatedData['krs'] = $request->file('krs')->store('pengajuan-sidangta-images');
        }

        if($pengajuan_sidangtum->detailpengajuansidangta->ket_lampiran_ktm){
            $validatedData['ktm'] = $pengajuan_sidangtum->ktm;
        }else {
            $validatedData['ktm'] = $request->file('ktm')->store('pengajuan-sidangta-images');
        }

        if($pengajuan_sidangtum->detailpengajuansidangta->ket_sbb_pendidikan){
            $validatedData['sbb'] = $pengajuan_sidangtum->sbb;
        }else {
            $validatedData['sbb'] = $request->file('sbb')->store('pengajuan-sidangta-images');
        }

        if($pengajuan_sidangtum->detailpengajuansidangta->ket_sbb_perpustakaan){
            $validatedData['sbb_perpustakaan'] = $pengajuan_sidangtum->sbb_perpustakaan;
        }else {
            $validatedData['sbb_perpustakaan'] = $request->file('sbb_perpustakaan')->store('pengajuan-sidangta-images');
        }

        if($pengajuan_sidangtum->detailpengajuansidangta->ket_persetujuan_sidang){
            $validatedData['lembar_persetujuan_sidang'] = $pengajuan_sidangtum->lembar_persetujuan_sidang;
        }else {
            $validatedData['lembar_persetujuan_sidang'] = $request->file('lembar_persetujuan_sidang')->store('pengajuan-sidangta-images');
        }

        if($pengajuan_sidangtum->detailpengajuansidangta->ket_lampiran_sk_pembimbing){
            $validatedData['sk_pembimbing'] = $pengajuan_sidangtum->sk_pembimbing;
        }else {
            $validatedData['sk_pembimbing'] = $request->file('sk_pembimbing')->store('pengajuan-sidangta-files');
        }

        if($pengajuan_sidangtum->detailpengajuansidangta->ket_lampiran_draft){
            $validatedData['draft_laporan'] = $pengajuan_sidangtum->draft_laporan;
        }else {
            $validatedData['draft_laporan'] = $request->file('draft_laporan')->store('pengajuan-sidangta-files');
        }

        if($pengajuan_sidangtum->detailpengajuansidangta->ket_lampiran_sertifikat_kegiatan){
            $validatedData['sertifikat_kegiatan'] = $pengajuan_sidangtum->sertifikat_kegiatan;

        }else {           

            $sertifikatKegiatan = $request->file('sertifikat_kegiatan');

            if ($sertifikatKegiatan) {
                $sertifikatPaths = [];

                foreach ($sertifikatKegiatan as $sertifikat) {
                    $path = $sertifikat->store('pengajuan-sidangta-images');
                    $sertifikatPaths[] = $path;
                }

                
                $validatedData['sertifikat_kegiatan'] = json_encode($sertifikatPaths);
            }
        }

        if($pengajuan_sidangtum->detailpengajuansidangta->ket_lampiran_sertifikat_pkkmb){
            $validatedData['sertifikat_pkkmb'] = $pengajuan_sidangtum->sertifikat_pkkmb;
        }else {
            $validatedData['sertifikat_pkkmb'] = $request->file('sertifikat_pkkmb')->store('pengajuan-sidangta-images');
        }

        if($pengajuan_sidangtum->detailpengajuansidangta->ket_lampiran_sertifikat_toefl){
            $validatedData['sertifikat_toefl'] = $pengajuan_sidangtum->sertifikat_toefl;
        }else {
            $validatedData['sertifikat_toefl'] = $request->file('sertifikat_toefl')->store('pengajuan-sidangta-images');
        }

        if($pengajuan_sidangtum->detailpengajuansidangta->ket_lampiran_ijazah){
            $validatedData['foto_ijazah_sma'] = $pengajuan_sidangtum->foto_ijazah_sma;
        }else {
            $validatedData['foto_ijazah_sma'] = $request->file('foto_ijazah_sma')->store('pengajuan-sidangta-images');
        }

        $validatedData['status_pengajuan_sidang'] = 1;

        $pengajuan_sidangtum->update($validatedData);

        return redirect('dashboard/pengajuan-sidangta')->with('success', 'New revisi has been added!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengajuanSidangTugasAkhir $pengajuan_sidangtum)
    {
        //
    }
}
