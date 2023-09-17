<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSeminarTugasAkhir;
use App\Models\DetailPengajuanSeminarTugasAkhir;
use App\Models\PengajuanTugasAkhir;
use App\Models\Bimbingan;
use App\Models\Appointment;
use App\Models\User;
use App\Models\TahunAkademik;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class PengajuanSeminarTugasAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('IsMahasiswa')) {
            // dd(auth()->user()->pengajuantugasakhir->count() > 0);
            if (auth()->user()->pengajuantugasakhir->count() > 0) {
                $appointments = Appointment::all();
                $bimbingans = Bimbingan::all();

                $infoPembimbingPertama = auth()->user()->pengajuantugasakhir[0]->detailpengajuantugasakhir->usulan_pembimbing_kaprodi1_id;
                $infoPembimbingKedua = auth()->user()->pengajuantugasakhir[0]->detailpengajuantugasakhir->usulan_pembimbing_kaprodi2_id;

                $minimumRequiredBimbinganCount = 5; // Ubah sesuai kebutuhan

                $approvedBimbinganCounts = [];

                foreach ($appointments as $appointment) {
                    $bimbingansInAppointment = $bimbingans->where('appointment_id', $appointment->id);

                    foreach ($bimbingansInAppointment as $bimbingan) {
                        $pembimbingId = $bimbingan->pembimbing_id;
                        $userId = $bimbingan->user_id;
                        
                        // Pastikan hanya bimbingan yang di-approve yang dihitung
                        if ($bimbingan->status_bimbingan === 2 &&
                            ($pembimbingId === $infoPembimbingPertama || $pembimbingId === $infoPembimbingKedua)) {
                            
                            if (!isset($approvedBimbinganCounts[$userId])) {
                                $approvedBimbinganCounts[$userId] = 0;
                            }

                            $approvedBimbinganCounts[$userId]++;
                        }
                    }
                }

                $userIdForSeminar = auth()->user()->id; // Ganti dengan user_id yang ingin diperiksa
                // if (isset($approvedBimbinganCounts[$userIdForSeminar]) && $approvedBimbinganCounts[$userIdForSeminar] >= $minimumRequiredBimbinganCount) {
                    
                // } else {
                    
                // }
                return view('dashboard.pengajuan_seminarta.index', [
                    'pengajuanseminarta' => PengajuanSeminarTugasAkhir::latest()->where('user_id', auth()->user()->id)->get(),
                    'userid_seminar' => $userIdForSeminar,
                    'min_bimbingan' => $minimumRequiredBimbinganCount,
                    'approved_seminar' => $approvedBimbinganCounts,
                    'tahunAkademik' => TahunAkademik::get()->first(),
                ]);
            }else {
                return view('dashboard.pengajuan_seminarta.index', [
                    'pengajuanseminarta' => PengajuanSeminarTugasAkhir::latest()->where('user_id', auth()->user()->id)->get(),
                    'tahunAkademik' => TahunAkademik::get()->first(),
                ]);
            }
        }elseif (Gate::allows('IsKoordinator') || Gate::allows('IsDekan')) {
            return view('dashboard.pengajuan_seminarta.index', [
                'pengajuanseminartas' => PengajuanSeminarTugasAkhir::with(['detailpengajuanseminarta'])->latest()->paginate(10),
                'tahunAkademik' => TahunAkademik::get()->first(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pengajuan_seminarta.create', [
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
            'foto_kwitansi' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'foto_khs' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'foto_krs' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'sk_ta' => 'required|mimes:pdf|max:1024',
            'lembar_persetujuan_seminarta' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'lembar_bimbingan1' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'lembar_bimbingan2' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'judul_smta' => 'required',
            'draft_laporan' => 'required|mimes:pdf|max:5120',
            'sertifikat_kegiatan.*' => 'image|file|mimes:jpeg,png,jpg|max:2048', 
            'sertifikat_kegiatan' => 'max:5', 
        ]);

        $validatedData['foto_kwitansi'] = $request->file('foto_kwitansi')->store('pengajuan-seminarta-images');
        $validatedData['foto_khs'] = $request->file('foto_khs')->store('pengajuan-seminarta-images');
        $validatedData['foto_krs'] = $request->file('foto_krs')->store('pengajuan-seminarta-images');

        $validatedData['sk_ta'] = $request->file('sk_ta')->store('pengajuan-seminarta-files');

        $validatedData['lembar_persetujuan_seminarta'] = $request->file('lembar_persetujuan_seminarta')->store('pengajuan-seminarta-images');

        $validatedData['lembar_bimbingan1'] = $request->file('lembar_bimbingan1')->store('pengajuan-seminarta-images');
        $validatedData['lembar_bimbingan2'] = $request->file('lembar_bimbingan2')->store('pengajuan-seminarta-images');

        $validatedData['draft_laporan'] = $request->file('draft_laporan')->store('pengajuan-seminarta-files');

        $sertifikatKegiatan = $request->file('sertifikat_kegiatan');

        if ($sertifikatKegiatan) {
            $sertifikatPaths = [];

            foreach ($sertifikatKegiatan as $sertifikat) {
                $path = $sertifikat->store('pengajuan-seminarta-images');
                $sertifikatPaths[] = $path;
            }

            
            $validatedData['sertifikat_kegiatan'] = json_encode($sertifikatPaths);
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['no_pengajuan_seminar'] = 'SMTA' . rand(100000, 999999);
        $validatedData['tanggal_pengajuan'] = Carbon::now('Asia/Jakarta')->format('d-m-Y');
        $validatedData['status_pengajuan_seminar'] = 1;

        $pengajuanseminarta = PengajuanSeminarTugasAkhir::create($validatedData);

        DetailPengajuanSeminarTugasAkhir::create([
            'pengajuan_seminar_tugas_akhir_id' => $pengajuanseminarta->id,
        ]);

        return redirect('dashboard/pengajuan-seminarta')->with('success', 'New Pengajuan Seminar Tugas Akhir has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PengajuanSeminarTugasAkhir $pengajuan_seminartum)
    {
        // dd($pengajuan_seminartum);
        return view('dashboard.pengajuan_seminarta.show', [
            'detailpengajuan_seminarta' => $pengajuan_seminartum->load(['detailpengajuanseminarta']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengajuanSeminarTugasAkhir $pengajuan_seminartum)
    {
        return view('dashboard.pengajuan_seminarta.edit', [
            'detailpengajuan_seminarta' => $pengajuan_seminartum->load(['detailpengajuanseminarta']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengajuanSeminarTugasAkhir $pengajuan_seminartum)
    {
        $validatedData = $request->validate([
            'foto_kwitansi' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'foto_khs' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'foto_krs' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'lembar_persetujuan_seminarta' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'lembar_bimbingan1' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'lembar_bimbingan2' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'sk_ta' => 'required|mimes:pdf|max:1024',
            'draft_laporan' => 'required|mimes:pdf|max:5120',
            'sertifikat_kegiatan.*' => 'image|file|mimes:jpeg,png,jpg|max:2048', 
            'sertifikat_kegiatan' => 'max:5',
        ]);

        if($pengajuan_seminartum->detailpengajuanseminarta->ket_kwitansi){
            $validatedData['foto_kwitansi'] = $pengajuan_seminartum->foto_kwitansi;
        }else {
            $validatedData['foto_kwitansi'] = $request->file('foto_kwitansi')->store('pengajuan-seminarta-images');
        }

        if($pengajuan_seminartum->detailpengajuanseminarta->ket_khs){
            $validatedData['foto_khs'] = $pengajuan_seminartum->foto_khs;
        }else {
            $validatedData['foto_khs'] = $request->file('foto_khs')->store('pengajuan-seminarta-images');
        }

        if($pengajuan_seminartum->detailpengajuanseminarta->ket_krs){
            $validatedData['foto_krs'] = $pengajuan_seminartum->foto_krs;
        }else {
            $validatedData['foto_krs'] = $request->file('foto_krs')->store('pengajuan-seminarta-images');
        }

        if($pengajuan_seminartum->detailpengajuanseminarta->ket_persetujuan_seminarta){
            $validatedData['lembar_persetujuan_seminarta'] = $pengajuan_seminartum->lembar_persetujuan_seminarta;
        }else {
            $validatedData['lembar_persetujuan_seminarta'] = $request->file('lembar_persetujuan_seminarta')->store('pengajuan-seminarta-images');
        }

        if($pengajuan_seminartum->detailpengajuanseminarta->ket_lembar_bimbingan1){
            $validatedData['lembar_bimbingan1'] = $pengajuan_seminartum->lembar_bimbingan1;
        }else {
            $validatedData['lembar_bimbingan1'] = $request->file('lembar_bimbingan1')->store('pengajuan-seminarta-images');
        }

        if($pengajuan_seminartum->detailpengajuanseminarta->ket_lembar_bimbingan2){
            $validatedData['lembar_bimbingan2'] = $pengajuan_seminartum->lembar_bimbingan2;
        }else {
            $validatedData['lembar_bimbingan2'] = $request->file('lembar_bimbingan2')->store('pengajuan-seminarta-images');
        }

        if($pengajuan_seminartum->detailpengajuanseminarta->ket_sk_ta){
            $validatedData['sk_ta'] = $pengajuan_seminartum->sk_ta;
        }else {
            $validatedData['sk_ta'] = $request->file('sk_ta')->store('pengajuan-seminarta-files');
        }

        if($pengajuan_seminartum->detailpengajuanseminarta->ket_draft_laporan){
            $validatedData['draft_laporan'] = $pengajuan_seminartum->draft_laporan;
        }else {
            $validatedData['draft_laporan'] = $request->file('draft_laporan')->store('pengajuan-seminarta-files');
        }

        if($pengajuan_seminartum->detailpengajuanseminarta->ket_sertifikat_kegiatan){
            $validatedData['sertifikat_kegiatan'] = $pengajuan_seminartum->sertifikat_kegiatan;

        }else {           

            $sertifikatKegiatan = $request->file('sertifikat_kegiatan');

            if ($sertifikatKegiatan) {
                $sertifikatPaths = [];

                foreach ($sertifikatKegiatan as $sertifikat) {
                    $path = $sertifikat->store('pengajuan-seminarta-images');
                    $sertifikatPaths[] = $path;
                }

                
                $validatedData['sertifikat_kegiatan'] = json_encode($sertifikatPaths);
            }
        }

        $validatedData['status_pengajuan_seminar'] = 1;

        $pengajuan_seminartum->update($validatedData);

        return redirect('dashboard/pengajuan-seminarta')->with('success', 'New revisi has been added!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengajuanSeminarTugasAkhir $pengajuan_seminartum)
    {
        //
    }
}
