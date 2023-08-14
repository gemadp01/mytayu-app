<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\User;
use App\Models\Access;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.dosen.index', [
            'dosens' => Dosen::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nidn' => 'required|max:10|unique:dosens',
            'nama' => 'required',
            'email' => 'nullable',
            'singkatan' => 'nullable|max:3',
            'nomor_telepon' => 'nullable|min:10|max:13',
            'kuota_pembimbing' => 'nullable|min:1',
            'keilmuan' => 'nullable',
        ]);

        

        // $dosen = new Dosen($validatedData);
        // $singkatan = Str::lower($request->singkatan);
        
        $user = new User();
        $user->level_user = 'Dospem';
        $user->status_user = false;
        $user->name = $validatedData['nama'];
        // $user->username = $request->nidn;
        $user->username = $request->nidn . Str::lower($validated['singkatan']);
        $user->password = Hash::make($request->nidn);
        // $user->password = Hash::make($request->nidn . Str::lower($request->singkatan));


        $user->save();
        $dosen = Dosen::create([
            'user_id' => $user->id, // Assign user_id with the newly created user's id
            'level_user' => 'Dospem',
            'nidn' => $validatedData['nidn'],
            'nama' => $validatedData['nama'],
            'singkatan' => $validatedData['singkatan'],
            'nomor_telepon' => $validatedData['nomor_telepon'],
            'kuota_pembimbing' => $validatedData['kuota_pembimbing'],
            'keilmuan' => $validatedData['keilmuan'],
        ]);

        // Dosen::create($validatedData);
        // $dosen->user()->save($user);
        

        return redirect('dashboard/dosen')->with('success', 'New Dosen has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        return view('dashboard.dosen.edit', [
            'dosen' => $dosen,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'nidn' => 'required|max:10',
            'nama' => 'required',
            'singkatan' => 'nullable|max:3',
            'nomor_telepon' => 'numeric|nullable|min:10|max:13',
            'kuota_pembimbing' => 'nullable|min:1',
            'keilmuan' => 'nullable',
        ]);


        Dosen::where('id', $dosen->id)->update($validatedData);

        return redirect('dashboard/dosen')->with('success', 'Dosen has been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {
        Dosen::destroy($dosen->id);

        return redirect('dashboard/dosen')->with('success', 'Dosen has been deleted!');
    }

    // public function changeStatus(Dosen $dosen) {
    //     if($dosen->status_user === 1) {
    //         $dosen->update(['status_user' => false]);
    //     }else {
    //         $dosen->update(['status_user' => true]);
    //     }
    //     return redirect('dashboard/dosen')->with('success', 'Status user berhasil diubah.');
    // }

    public function toggleStatus(Dosen $dosen)
    {
        $dosen->toggleStatus();

        return redirect('dashboard/dosen')->with('success', 'Status user berhasil diubah.');
    }
}
