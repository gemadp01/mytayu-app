<?php

namespace App\Http\Controllers;

use App\Models\PenjadwalanSidangTugasAkhir;
use App\Models\Dosen;
use Illuminate\Http\Request;

class YudisiumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.yudisium.index', [
            'data_sidangta' => PenjadwalanSidangTugasAkhir::latest()->paginate(5),
            'infoDosen' => Dosen::all(),
        ]);
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
    public function show(PenjadwalanSidangTugasAkhir $yudisium)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenjadwalanSidangTugasAkhir $yudisium)
    {
        return view('dashboard.yudisium.edit', [
            'data_pengajuan' => $yudisium->load('pengajuansidangta'),
            'infoDosen' => Dosen::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenjadwalanSidangTugasAkhir $yudisium)
    {
        $validatedData = $request->validate([
            'yudisium' => 'mimes:pdf|max:2048',
        ]);

        if ($request->file('yudisium')) {
            if ($request->oldyudisium) {
                Storage::delete($request->oldyudisium);
            }
            $validatedData['yudisium'] = $request->file('yudisium')->store('yudisium-files');
        }

        $yudisium->pengajuansidangta->update($validatedData);

        return redirect('yudisium/' . $yudisium->id .'/edit')->with('success', 'Yudisium Berhasil di upload!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenjadwalanSidangTugasAkhir $yudisium)
    {
        //
    }
}
