<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Dosen;
use App\Models\Bimbingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AppointmentBimbinganController extends Controller
{
    
    // protected $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at"];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if(Gate::allows('IsDospem')) {
            return view('dashboard.appointment.index', [
                'appointments' => Appointment::where('user_accid', auth()->user()->id)->latest()->paginate(5),
                // 'hari' => $this->hari,
            ]);
        // }elseif (Gate::allows('IsMahasiswa')) {
        //     $mahasiswa = auth()->user()->pengajuantugasakhir[0]->detailpengajuantugasakhir;
        //     return view('dashboard.bimbingan.index', [
        //         'dospemsatu' => Appointment::where('pembimbing_id', $mahasiswa->usulan_pembimbing_kaprodi1_id)->get()->first(),
        //         'dospemdua' => Appointment::where('pembimbing_id', $mahasiswa->usulan_pembimbing_kaprodi2_id)->get()->first(),
        //     ]);
        // }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $mahasiswa = auth()->user()->pengajuantugasakhir[0]->detailpengajuantugasakhir;
        // return view('dashboard.bimbingan.create', [
        //     'appointments' => Appointment::where('pembimbing_id', $mahasiswa->usulan_pembimbing_kaprodi1_id)->paginate(5),
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // $now = Carbon::now();
        // $validatedData = $request->validate([
        //     'hari' => 'required',
        //     'tanggal' => 'required|date|after_or_equal:today',
        //     'waktu_awal' => 'required',
        //     'waktu_akhir' => 'required',
        //     'jenis_pertemuan' => 'required',
        //     'kuota_bimbingan' => 'required',
        //     'keterangan' => 'nullable',
        // ]);

        $validatedData = $request->validate([
            'tanggal' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
            'waktu_awal' => 'required',
            'waktu_akhir' => 'required',
            'jenis_pertemuan' => 'required',
            'kuota_bimbingan' => 'required',
            'keterangan' => 'nullable',
        ]);

        $validatedData['user_accid'] = auth()->user()->id;
        $validatedData['pembimbing_id'] = auth()->user()->dosen->id;

        // Menghitung hari dari tanggal yang dimasukkan
        $tanggal = Carbon::parse($validatedData['tanggal']);
        
        // Mendapatkan hari dalam bahasa Indonesia
        $hari = $tanggal->translatedFormat('l'); // 'l' mengambil format hari dalam bentuk string

        // Menambahkan nilai hari ke dalam data yang divalidasi
        $validatedData['hari'] = $hari;

        Appointment::create($validatedData);

        $bimbingan = new Bimbingan;
        
        return redirect('dashboard/agenda-bimbingan')->with('success', 'New Agenda Bimbingan Tugas Akhir has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $agenda_bimbingan)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $agenda_bimbingan)
    {
        if(Gate::allows('IsDospem')) {
            return view('dashboard.appointment.edit', [
                'databimbingan' => $agenda_bimbingan->load('bimbingan'),
            ]);
        }elseif (Gate::allows('IsMahasiswa')) {
            // dd($agenda_bimbingan->dosen);
            // dd(auth()->user()->bimbingan());
            // $mahasiswa_id = auth()->user()->id;
            // $dataappointment = Auth::user()->bimbingan()->where('id', $agenda_bimbingan->id)->with(['appointment', 'user'])->get();

            $dataappointment = Bimbingan::where('user_id', auth()->user()->id)->where('appointment_id', $agenda_bimbingan->id)->get();

            // dd($dataappointment);

            return view('dashboard.appointment.edit', [
                'appointment' => $agenda_bimbingan,
                'dataappointment' => $dataappointment,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $agenda_bimbingan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $agenda_bimbingan)
    {
        //
    }

    public function infopembimbing() {
        // dd(auth()->user()->pengajuantugasakhir[0]->status_pengajuan);
        // dd(isset(auth()->user()->pengajuantugasakhir[0]->detailpengajuantugasakhir));
        if(isset(auth()->user()->pengajuantugasakhir[0]->detailpengajuantugasakhir)) {
            $mahasiswa = auth()->user()->pengajuantugasakhir[0]->detailpengajuantugasakhir;
            return view('dashboard.bimbingan.index',[
                'dospemsatu' => Dosen::where('id', $mahasiswa->usulan_pembimbing_kaprodi1_id)->get()[0],
                'dospemdua' => Dosen::where('id', $mahasiswa->usulan_pembimbing_kaprodi2_id)->get()[0],
            ]);
        }else{
            return view('dashboard.bimbingan.index');
        }
        
    }

    public function dospemsatuAppointment() {
        $mahasiswa = auth()->user()->pengajuantugasakhir[0]->detailpengajuantugasakhir;
        return view('dashboard.appointment.index',[
            'appointments' => Appointment::where('pembimbing_id', $mahasiswa->usulan_pembimbing_kaprodi1_id)->latest()->paginate(5),
        ]);
    }

    public function dospemduaAppointment() {
        $mahasiswa = auth()->user()->pengajuantugasakhir[0]->detailpengajuantugasakhir;
        return view('dashboard.appointment.index',[
            'appointments' => Appointment::where('pembimbing_id', $mahasiswa->usulan_pembimbing_kaprodi2_id)->latest()->paginate(5),
        ]);
    }
}
