<?php

namespace App\Http\Controllers;

use App\Models\SuratPengantarPenelitian;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class SuratPengantarPenelitianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::allows('IsMahasiswa')) {
            return view('dashboard.surat_pengantar_penelitian.index', [
                'pengajuan_pengantar' => SuratPengantarPenelitian::where('user_id', auth()->user()->id)->latest()->paginate(5),
            ]);
        }elseif (Gate::allows('IsAdmin')) {
            return view('dashboard.surat_pengantar_penelitian.index', [
                'pengajuan_pengantar' => SuratPengantarPenelitian::latest()->paginate(5),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.surat_pengantar_penelitian.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'npm' => 'required',
            'nama' => 'required',
            'program_studi' => 'required',
            'surat_dituju' => 'required',
            'nama_instansi' => 'required',
            'alamat_instansi' => 'required',
            'waktu_penelitian' => 'required',
            'judul_penelitian' => 'required',
            'lembar_sk' => 'mimes:pdf|max:2048'
        ]);

        $validatedData['lembar_sk'] = $request->file('lembar_sk')->store('pengajuan-surat-pengantar');

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['nomor_pengajuan'] = 'SPPTA' . rand(100000, 999999);
        $validatedData['tanggal_pengajuan'] = Carbon::now('Asia/Jakarta')->format('d-m-Y');

        SuratPengantarPenelitian::create($validatedData);

        return redirect('dashboard/pengantar-penelitian')->with('success', 'New Pengajuan Surat Pengantar has been added!');

    }

    /**
     * Display the specified resource.
     */
    public function show(SuratPengantarPenelitian $pengantar_penelitian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratPengantarPenelitian $pengantar_penelitian)
    {
        return view('dashboard.surat_pengantar_penelitian.edit', [
            'data_pengajuan' => $pengantar_penelitian,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratPengantarPenelitian $pengantar_penelitian)
    {
        $validatedData = $request->validate([
            'sk_pengantar' => 'mimes:pdf|max:2048',
        ]);

        $validatedData['sk_pengantar'] = $request->file('sk_pengantar')->store('pengajuan-surat-pengantar');

        $pengantar_penelitian->update($validatedData);

        return redirect('/dashboard/pengantar-penelitian')->with('success', 'Surat Pengantar Berhasil di upload!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratPengantarPenelitian $pengantar_penelitian)
    {
        //
    }
}
