<?php

namespace App\Http\Controllers;

use App\Models\PengajuanTugasAkhir;
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
        return view('dashboard.pengajuan_tugas_akhir.index', [
            'pengajuanta' => PengajuanTugasAkhir::with(['user', 'usulanDospemPertama', 'usulanDospemKedua'])->latest()->where('user_id', auth()->user()->id)->get(),
            'pengajuantas' => PengajuanTugasAkhir::with(['user', 'usulanDospemPertama', 'usulanDospemKedua'])->latest()->paginate(10),
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
            'foto_kwitansi' => 'image|file|max:2048',
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

        // dd($validatedData);

        PengajuanTugasAkhir::create($validatedData);

        return redirect('dashboard/pengajuan-ta')->with('success', 'New Pengajuan Tugas Akhir has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PengajuanTugasAkhir $pengajuan_tum)
    {
        return view('dashboard.pengajuan_tugas_akhir.show', [
            'pengajuanta' => $pengajuan_tum->load(['user', 'usulanDospemPertama', 'usulanDospemKedua']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengajuanTugasAkhir $pengajuan_tum)
    {
        return view('dashboard.pengajuan_tugas_akhir.edit', [
            'pengajuanta' => $pengajuan_tum,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengajuanTugasAkhir $pengajuan_tum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengajuanTugasAkhir $pengajuan_tum)
    {
        //
    }
}
