<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Appointment;
use Illuminate\Http\Request;

class BimbinganTugasAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jam_awal' => 'required',
            'jam_akhir' => 'required',
            'materi_pembahasan' => 'required',
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['pembimbing_id'] = $request->pembimbing_id;
        $validatedData['appointment_id'] = $request->appointment_id;
        $validatedData['tanggal_bimbingan'] = $request->tanggal_bimbingan;
        $validatedData['npm'] = auth()->user()->mahasiswa->npm;
        $validatedData['nama'] = auth()->user()->mahasiswa->nama;
        $validatedData['judul'] = auth()->user()->pengajuantugasakhir[0]->topik_penelitian;
        $validatedData['status_bimbingan'] = 1;

        Bimbingan::create($validatedData);

        return redirect('dashboard/agenda-bimbingan/' . $request->appointment_id . '/edit')->with('success', 'New Pengajuan Bimbingan Tugas Akhir has been added!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Bimbingan $bimbingan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bimbingan $bimbingan)
    {
        return view('dashboard.bimbingan.edit', [
            'bimbingan_mahasiswa' => $bimbingan->load(['appointment', 'user']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bimbingan $bimbingan)
    {
        $validatedData = $request->validate([
            'hasil_saran_tugas' => 'nullable',
        ]);

        $validatedData['status_bimbingan'] = 2;

        $bimbingan->update($validatedData);

        return redirect('dashboard/agenda-bimbingan/' . $bimbingan->appointment_id . '/edit')->with('success', 'Bimbingan Mahasiswa has been approved!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bimbingan $bimbingan)
    {
        //
    }

    // public function infoPembimbing() {
    //     $mahasiswa = auth()->user()->pengajuantugasakhir[0]->detailpengajuantugasakhir;
    //     return view('dashboard.bimbingan.index',[
    //         'dospemsatu' => Appointment::where('pembimbing_id', $mahasiswa->usulan_pembimbing_kaprodi1_id)->get()[0],
    //         'dospemdua' => Dosen::where('id', $mahasiswa->usulan_pembimbing_kaprodi2_id)->get()[0],
    //     ]);
    // }

    public function declinedBimbingan(Bimbingan $bimbingan) {
        $bimbingan->status_bimbingan = 0;
        $bimbingan->save();

        return redirect('dashboard/agenda-bimbingan/' . $bimbingan->appointment_id . '/edit')->with('success', 'Bimbingan Mahasiswa has been declined!');
    }
}
