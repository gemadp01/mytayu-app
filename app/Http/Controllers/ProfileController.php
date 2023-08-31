<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

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
    public function update(Request $request, User $idUser)
    {
        if (Gate::allows('IsDospem')) {
            $validatedData = $request->validate([
            'email' => 'nullable|email:dns',
            'nomor_telepon' => 'nullable|min:10|max:13',
            'kuota_pembimbing' => 'nullable|min:1',
        ]);

        $selectedKeilmuan = $request->input('keilmuan', []);

        // $selectedKeilmuanString = implode(', ', $selectedKeilmuan);
        // $validatedData['keilmuan'] = $selectedKeilmuanString;
        $validatedData['keilmuan'] = $selectedKeilmuan;
        if (!empty($request->input('current_password')) && !empty($request->input('new_password'))) {
            $user = Auth::user();
            $currentPassword = $user->password;

            if (!Hash::check($request->input('current_password'), $currentPassword)) {
                return redirect()->back()->with('error', 'Current password salah.');
            }

            $user->update([
                'password' => Hash::make($request->input('new_password')),
            ]);
            
        }

        Dosen::where('user_id', $idUser->id)->update($validatedData);
        

        return redirect('dashboard/profile')->with('status', 'profile-updated')->withInput();

        }elseif (Gate::allows('IsMahasiswa') || Gate::allows('KoordinatorKaprodiDekan') || Gate::allows('IsAdmin')) {
            $user = Auth::user();
            $currentPassword = $user->password;

            if (!Hash::check($request->input('current_password'), $currentPassword)) {
                return redirect()->back()->with('error', 'Current password salah.');
            }

            $user->update([
                'password' => Hash::make($request->input('new_password')),
            ]);

            return redirect('dashboard/profile')->with('status', 'profile-updated')->withInput();
        }
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
