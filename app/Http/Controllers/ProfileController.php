<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Dosen;


class ProfileController extends Controller
{

    protected $keilmuanDosen = [
        'Pemrograman', 
        'Sistem Operasi', 
        'Jaringan Komputer', 
        'Pengembangan Web',
        'Pengembangan Aplikasi Mobile',
        'Kecerdasan Buatan (AI)',
        'Pengolahan Citra dan Grafika Komputer',
        'Keamanan Informasi',
        'Rekayasa Perangkat Lunak',
        'Komputasi Awan',
        'IOT'
    ];

    public function edit(Request $request)
    {
        return view('dashboard.profile.edit', [
            'user' => $request->user(),
            'keilmuanDosen' => $this->keilmuanDosen,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'nidn' => 'required|max:10',
            'nama' => 'required',
            'email' => 'email:dns',
            'singkatan' => 'nullable|max:3',
            'nomor_telepon' => 'nullable|min:10|max:13',
            'kuota_pembimbing' => 'nullable|min:1',
        ]);

        $selectedKeilmuan = $request->input('keilmuan', []);

        // $selectedKeilmuanString = implode(', ', $selectedKeilmuan);
        // $validatedData['keilmuan'] = $selectedKeilmuanString;
        $validatedData['keilmuan'] = $selectedKeilmuan;

        Dosen::where('id', $request->id)->update($validatedData);

        return redirect('dashboard/profile')->with('status', 'profile-updated')->withInput();
    }
    
    /**
     * Delete the user's account.
     */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/');
    // }
}
