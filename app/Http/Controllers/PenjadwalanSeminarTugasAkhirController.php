<?php

namespace App\Http\Controllers;

use App\Models\PenjadwalanSeminarTugasAkhir;
use App\Models\PenilaianSeminarTugasAkhir;
use App\Models\PengajuanTugasAkhir;
use App\Models\PengajuanSeminarTugasAkhir;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class PenjadwalanSeminarTugasAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('IsMahasiswa')) {
            $pengajuanSeminarTa = PengajuanSeminarTugasAkhir::where('user_id', auth()->user()->id)->get()->first();
            if ($pengajuanSeminarTa !== null) {
                # code...
                return view('dashboard.penjadwalan_seminar.index', [
                    'jadwal_seminarta' => PenjadwalanSeminarTugasAkhir::where('pengajuan_seminarta_id', $pengajuanSeminarTa->id)->get()->first(),
                ]);
            }else{
                return view('dashboard.penjadwalan_seminar.index');
            }
        }elseif (Gate::allows('IsDospem')) {
            $dosen = auth()->user()->dosen;
            return view('dashboard.penjadwalan_seminar.index', [
                'jadwal_seminarta1' => PenjadwalanSeminarTugasAkhir::where('pembimbing_1', $dosen->singkatan)
                        ->orWhere('pembimbing_1', $dosen->singkatan)
                        ->paginate(5),
                'jadwal_seminarta2' => PenjadwalanSeminarTugasAkhir::where('pembimbing_2', $dosen->singkatan)
                        ->orWhere('pembimbing_2', $dosen->singkatan)
                        ->paginate(5),
            ]);
        }
        
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
    public function show(PenjadwalanSeminarTugasAkhir $penjadwalan_seminar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenjadwalanSeminarTugasAkhir $penjadwalan_seminar)
    {
        // dd($penjadwalan_seminar);
        $ruangan = ['LAB A', 'LAB B', 'LAB C', 'LAB D', 'B209', 'B210', 'B211'];
        return view('dashboard.penjadwalan_seminar.edit', [
            'inputJadwal' => $penjadwalan_seminar->load('pengajuansta'),
            'ruangan' => $ruangan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenjadwalanSeminarTugasAkhir $penjadwalan_seminar)
    {
        // dd($penjadwalan_seminar);
        $validatedData = $request->validate([
            'nama' => 'required',
            'tanggal_penjadwalan' => 'required',
            'ruangan' => 'required',
            'keterangan' => 'required',
        ]);

        $validatedData['waktu_seminar'] = $request->input('tanggal_penjadwalan');

        $penjadwalan_seminar->update($validatedData);

        $datetimeRange = $request->input('tanggal_penjadwalan');
        $dates = explode(' ', $datetimeRange);

        $userIdSeminar = $penjadwalan_seminar->pengajuansta->user_id;
        $detailPengajuanTa = PengajuanTugasAkhir::where('user_id', $userIdSeminar)->get()->first();

        PenilaianSeminarTugasAkhir::create([
            'pengajuan_seminarta_id' => $penjadwalan_seminar->pengajuan_seminarta_id,
            'penjadwalan_seminarta_id' => $penjadwalan_seminar->id,
            'pembimbing1_id' => $detailPengajuanTa->detailpengajuantugasakhir->usulan_pembimbing_kaprodi1_id,
            'pembimbing2_id' => $detailPengajuanTa->detailpengajuantugasakhir->usulan_pembimbing_kaprodi2_id,
            'catatan_perbaikan_pembimbing1' => "",
            'catatan_perbaikan_pembimbing2' => "",
            'keterangan_perbaikan' => "",
            'tanggal_berita_acara' => $dates[0],
            'approve_pembimbing1' => 0,
            'approve_pembimbing2' => 0,
        ]);

        

        return redirect('dashboard/penjadwalan-seminar-sidang')->with('success', 'New Penjadwalan has been added!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenjadwalanSeminarTugasAkhir $penjadwalan_seminar)
    {
        //
    }
}
