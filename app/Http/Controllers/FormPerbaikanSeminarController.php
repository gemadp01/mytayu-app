<?php

namespace App\Http\Controllers;

use App\Models\PenilaianSeminarTugasAkhir;
use Illuminate\Http\Request;

class FormPerbaikanSeminarController extends Controller
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
    public function show(PenilaianSeminarTugasAkhir $form_perbaikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenilaianSeminarTugasAkhir $form_perbaikan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenilaianSeminarTugasAkhir $form_perbaikan)
    {
        if(auth()->user()->dosen->id === $form_perbaikan->pembimbing1_id) {
            $form_perbaikan->catatan_perbaikan_pembimbing1 = $request->input('formPerbaikan');
            $form_perbaikan->save();

            return redirect('berita-acara-seminar/' . $form_perbaikan->penjadwalansta->id);
        }elseif (auth()->user()->dosen->id === $form_perbaikan->pembimbing2_id) {
            $form_perbaikan->catatan_perbaikan_pembimbing2 = $request->input('formPerbaikan');
            $form_perbaikan->save();

            return redirect('form-perbaikan-seminar/' . $form_perbaikan->penjadwalansta->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenilaianSeminarTugasAkhir $form_perbaikan)
    {
        //
    }
}
