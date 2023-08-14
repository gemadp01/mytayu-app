<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.mahasiswa.index', [
            'mahasiswas' => Mahasiswa::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'npm' => 'required|max:8|unique:mahasiswas',
            'nama' => 'required',
            'email' => 'nullable',
            'kelas' => 'nullable',
            'prodi' => 'nullable',
        ]);

        $user = new User();

        $fullName = $validatedData['nama'];
        $nameParts = explode(" ", $fullName); // Pisahkan nama depan dan nama belakang menjadi array

        $firstName = $nameParts[0]; // Nama depan
        $firstTwoLetters = substr($firstName, 0, 2); // Ambil dua huruf pertama dari nama depan

        $user->level_user = 'mahasiswa';
        $user->status_user = false;
        $user->name = $validatedData['nama'];
        $user->username = $request->npm . Str::lower($firstTwoLetters);
        $user->password = Hash::make($validatedData['npm']);
        $user->save();

        $mahasiswa = Mahasiswa::create([
            'user_id' => $user->id,
            'level_user' => 'mahasiswa',
            'npm' => $validatedData['npm'],
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'kelas' => $validatedData['kelas'],
            'prodi' => $validatedData['prodi'],
        ]);

        return redirect('dashboard/mahasiswa')->with('success', 'New Mahasiswa has been added!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('dashboard.mahasiswa.edit', [
            'mahasiswa' => $mahasiswa,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validatedData = $request->validate([
            'npm' => 'required|max:8',
            'nama' => 'required',
            'email' => 'nullable',
            'kelas' => 'nullable',
            'prodi' => 'nullable',
        ]);


        // Dosen::where('id', $dosen->id)->update($validatedData);
        $mahasiswa->update($validatedData);

        $fullName = $validatedData['nama'];
        $nameParts = explode(" ", $fullName); // Pisahkan nama depan dan nama belakang menjadi array

        $firstName = $nameParts[0]; // Nama depan
        $firstTwoLetters = substr($firstName, 0, 2); // Ambil dua huruf pertama dari nama depan

        $user = $mahasiswa->user;
        if ($user) {
            $user->name = $validatedData['nama'];
            $user->username = $validatedData['npm'] . Str::lower($firstTwoLetters);
            $user->password = Hash::make($validatedData['npm']);
            $user->save();
        }

        return redirect('dashboard/mahasiswa')->with('success', 'Mahasiswa has been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $user = $mahasiswa->user; 
        if ($user) {
            $user->delete();
        }
        $mahasiswa->delete();

        return redirect('dashboard/mahasiswa')->with('success', 'Mahasiswa and associated User have been deleted!');
    }

    public function toggleStatus(Mahasiswa $mahasiswa)
    {
        $mahasiswa->toggleStatus();

        return redirect('dashboard/mahasiswa')->with('success', 'Status user berhasil diubah.');
    }
}
