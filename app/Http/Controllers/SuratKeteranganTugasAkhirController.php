<?php

namespace App\Http\Controllers;

use App\Models\SuratKeteranganTugasAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class SuratKeteranganTugasAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.sk_ta.index', [
            'data_sk_ta' => SuratKeteranganTugasAkhir::latest()->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.sk_ta.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'npm' => 'required',
            'nama' => 'required',
            'tanggal_berlaku' => 'required',
            'tanggal_berakhir' => 'required',
            'sk_ta' => 'mimes:pdf|max:2048',
        ]);

        $validatedData['sk_ta'] = $request->file('sk_ta')->store('sk-ta-files');

        SuratKeteranganTugasAkhir::create($validatedData);

        return redirect('dashboard/sk-ta')->with('success', 'New SK TA has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratKeteranganTugasAkhir $sk_tum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratKeteranganTugasAkhir $sk_tum)
    {
        return view('dashboard.sk_ta.edit', [
            'detail_sk_ta' => $sk_tum,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratKeteranganTugasAkhir $sk_tum)
    {
        $validatedData = $request->validate([
            'npm' => 'required',
            'nama' => 'required',
            'tanggal_berlaku' => 'required',
            'tanggal_berakhir' => 'required',
            'sk_ta' => 'mimes:pdf|max:2048',
        ]);

        if ($request->file('sk_ta')) {
            if ($request->oldskta) {
                Storage::delete($request->oldskta);
            }
            $validatedData['sk_ta'] = $request->file('sk_ta')->store('sk-ta-files');
        }

        SuratKeteranganTugasAkhir::updated($validatedData);

        return redirect('dashboard/sk-ta')->with('success', 'SK TA has been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratKeteranganTugasAkhir $sk_tum)
    {
        //
    }
}
