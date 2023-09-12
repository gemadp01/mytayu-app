<?php

namespace App\Http\Controllers;

use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class TahunAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.tahun_akademik.index', [
            'tahunAkademik' => TahunAkademik::get()->first(),
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
    public function show(TahunAkademik $tahun_akademik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TahunAkademik $tahun_akademik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TahunAkademik $tahun_akademik)
    {
        $input = $request->all();

        $tahun_akademik->update($input);

        return redirect('dashboard/tahun-akademik')->with('success', 'Tahun Akademik sudah diperbaharui!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TahunAkademik $tahun_akademik)
    {
        //
    }
}
