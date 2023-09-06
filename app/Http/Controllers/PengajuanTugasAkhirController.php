<?php

namespace App\Http\Controllers;

use App\Models\PengajuanTugasAkhir;
use App\Models\DetailPengajuanTugasAkhir;
use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Carbon\Carbon;


class PengajuanTugasAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $saatIni = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        $dateNow = Carbon::createFromFormat('Y-m-d', $saatIni);

        $tanggalBerakhirSk = PengajuanTugasAkhir::with(['user', 'usulanDospemPertama', 'usulanDospemKedua'])->where('user_id', auth()->user()->id)->get();
        // dd($tanggalBerakhirSk !== null);
        if ($tanggalBerakhirSk->count() > 0) {
            if ($tanggalBerakhirSk[0]->suratketeranganta !== null) {
                $dateSk = Carbon::createFromFormat('Y-m-d', $tanggalBerakhirSk[0]->suratketeranganta->tanggal_berakhir);
            }else {
                $dateSk = "Belum ada SK TA";
            }
        }else {
            $dateSk = "Belum ada SK TA";
        }

        return view('dashboard.pengajuan_tugas_akhir.index', [
            'pengajuanta' => PengajuanTugasAkhir::with(['user', 'usulanDospemPertama', 'usulanDospemKedua'])->latest()->where('user_id', auth()->user()->id)->get(),
            'pengajuantas' => PengajuanTugasAkhir::with(['user', 'usulanDospemPertama', 'usulanDospemKedua', 'detailpengajuantugasakhir'])->latest()->paginate(10),
            'hariIni' => $dateNow,
            'tanggalBerakhirSk' => $dateSk,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pengajuan_tugas_akhir.create', [
            'dospems' => Dosen::all(),
            'mahasiswa' => Mahasiswa::where('user_id', auth()->user()->id)
                ->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->file('kwitansi')->store('pengajuan-ta-images');
        // $nomorPengajuan = 'TA' . rand(100000, 999999);
        // return $nomorPengajuan;
        // return Carbon::now('Asia/Jakarta')->format('d-m-Y');
        
        $validatedData = $request->validate([
            'npm' => 'required|max:8',
            'nama' => 'required',
            'program_studi' => 'required',
            'kelas' => 'required',
            'nomor_telepon' => 'nullable',
            'email' => 'nullable',
            'foto_kwitansi' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'foto_ktm' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'foto_khs' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'foto_krs' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'topik_penelitian' => 'required|max:255',
            'proposal_ta' => 'required|mimes:pdf|max:2048',
            'usulan_pembimbing_mhs1_id' => 'required',
            'usulan_pembimbing_mhs2_id' => 'required',
        ]);

        $validatedData['foto_kwitansi'] = $request->file('foto_kwitansi')->store('pengajuan-ta-images');
        $validatedData['foto_ktm'] = $request->file('foto_ktm')->store('pengajuan-ta-images');
        $validatedData['foto_khs'] = $request->file('foto_khs')->store('pengajuan-ta-images');
        $validatedData['foto_krs'] = $request->file('foto_krs')->store('pengajuan-ta-images');

        $validatedData['proposal_ta'] = $request->file('proposal_ta')->store('pengajuan-ta-files');

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['nomor_pengajuan'] = 'TA' . rand(100000, 999999);
        $validatedData['tanggal_pengajuan'] = Carbon::now('Asia/Jakarta')->format('d-m-Y');
        $validatedData['status_pengajuan'] = 1;

        // dd($validatedData);

        $pengajuanta = PengajuanTugasAkhir::create($validatedData);

        DetailPengajuanTugasAkhir::create([
            'pengajuan_tugas_akhir_id' => $pengajuanta->id,
        ]);

        return redirect('dashboard/pengajuan-ta')->with('success', 'New Pengajuan Tugas Akhir has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PengajuanTugasAkhir $pengajuan_tum)
    {
        // dd($pengajuan_tum->usulanDospemPertama);
        return view('dashboard.pengajuan_tugas_akhir.show', [
            'detailpengajuanta' => $pengajuan_tum->load(['user', 'usulanDospemPertama', 'usulanDospemKedua', 'detailpengajuantugasakhir']),
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengajuanTugasAkhir $pengajuan_tum)
    {
        return view('dashboard.pengajuan_tugas_akhir.edit', [
            'detailpengajuanta' => $pengajuan_tum->load(['user', 'usulanDospemPertama', 'usulanDospemKedua', 'detailpengajuantugasakhir']),
            'dospems' => Dosen::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengajuanTugasAkhir $pengajuan_tum)
    {
        // dd($pengajuan_tum->detailpengajuantugasakhir);
        
        $validatedData = $request->validate([
        'foto_kwitansi' => 'image|file|mimes:jpeg,png,jpg|max:2048',
        'foto_ktm' => 'image|file|mimes:jpeg,png,jpg|max:2048',
        'foto_khs' => 'image|file|mimes:jpeg,png,jpg|max:2048',
        'foto_krs' => 'image|file|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        if($pengajuan_tum->detailpengajuantugasakhir->ket_kwitansi){
            $validatedData['foto_kwitansi'] = $pengajuan_tum->foto_kwitansi;
        }else {
            $validatedData['foto_kwitansi'] = $request->file('foto_kwitansi')->store('pengajuan-ta-images');
        }

        if($pengajuan_tum->detailpengajuantugasakhir->ket_ktm){
            $validatedData['foto_ktm'] = $pengajuan_tum->foto_ktm;
        }else {
            $validatedData['foto_ktm'] = $request->file('foto_ktm')->store('pengajuan-ta-images');
        }

        if($pengajuan_tum->detailpengajuantugasakhir->ket_khs){
            $validatedData['foto_khs'] = $pengajuan_tum->foto_khs;
        }else {
            $validatedData['foto_khs'] = $request->file('foto_khs')->store('pengajuan-ta-images');
        }

        if($pengajuan_tum->detailpengajuantugasakhir->ket_krs){
            $validatedData['foto_krs'] = $pengajuan_tum->foto_krs;
        }else {
            $validatedData['foto_krs'] = $request->file('foto_krs')->store('pengajuan-ta-images');
        }

        if ($pengajuan_tum->suratketeranganta !== null) {
            // if($pengajuan_tum->usulan_pembimbing_mhs1_id){
            //     $validatedData['usulan_pembimbing_mhs1_id'] = $pengajuan_tum->usulan_pembimbing_mhs1_id;
            // }else {
            //     $validatedData['usulan_pembimbing_mhs1_id'] = $request->input('usulan_pembimbing_mhs1_id');
            // }

            // if($pengajuan_tum->usulan_pembimbing_mhs2_id){
            //     $validatedData['usulan_pembimbing_mhs2_id'] = $pengajuan_tum->usulan_pembimbing_mhs2_id;
            // }else {
            //     $validatedData['usulan_pembimbing_mhs2_id'] = $request->input('usulan_pembimbing_mhs2_id');
            // }

            $validatedData['usulan_pembimbing_mhs1_id'] = $request->input('usulan_pembimbing_mhs1_id');
            $validatedData['usulan_pembimbing_mhs2_id'] = $request->input('usulan_pembimbing_mhs2_id');

            $validatedData['status_pengajuan'] = 5;

            $pengajuan_tum->update($validatedData);

            return redirect('dashboard/pengajuan-ta')->with('success', 'New revisi has been added!');

        }
        
        $validatedData['status_pengajuan'] = 1;

        $pengajuan_tum->update($validatedData);

        return redirect('dashboard/pengajuan-ta')->with('success', 'New revisi has been added!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengajuanTugasAkhir $pengajuan_tum)
    {
        //
    }
}
