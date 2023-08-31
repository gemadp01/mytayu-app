<?php

namespace App\Http\Controllers;

use App\Models\PenilaianSidangTugasAkhir;
use Illuminate\Http\Request;

class FormPerbaikanSidangController extends Controller
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
    public function show(PenilaianSidangTugasAkhir $form_perbaikan_sidang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenilaianSidangTugasAkhir $form_perbaikan_sidang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenilaianSidangTugasAkhir $form_perbaikan_sidang)
    {
        // dd($form_perbaikan_sidang);
        if(auth()->user()->dosen->id === $form_perbaikan_sidang->penguji_utama_id) {
            $form_perbaikan_sidang->catatan_perbaikan_penguji_utama = $request->input('formPerbaikan');
            $form_perbaikan_sidang->save();

            return redirect('form-perbaikan-sidang/' . $form_perbaikan_sidang->penjadwalansidangta->id);
        }elseif (auth()->user()->dosen->id === $form_perbaikan_sidang->penguji1_id) {
            $form_perbaikan_sidang->catatan_perbaikan_penguji1 = $request->input('formPerbaikan');
            $form_perbaikan_sidang->save();

            return redirect('form-perbaikan-sidang/' . $form_perbaikan_sidang->penjadwalansidangta->id);
        }elseif (auth()->user()->dosen->id === $form_perbaikan_sidang->penguji2_id) {
            $form_perbaikan_sidang->catatan_perbaikan_penguji2 = $request->input('formPerbaikan');
            $form_perbaikan_sidang->save();

            return redirect('form-perbaikan-sidang/' . $form_perbaikan_sidang->penjadwalansidangta->id);
        }elseif (auth()->user()->dosen->id === $form_perbaikan_sidang->penguji3_id) {
            $form_perbaikan_sidang->catatan_perbaikan_penguji3 = $request->input('formPerbaikan');
            $form_perbaikan_sidang->save();

            return redirect('form-perbaikan-sidang/' . $form_perbaikan_sidang->penjadwalansidangta->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenilaianSidangTugasAkhir $form_perbaikan_sidang)
    {
        //
    }
}
