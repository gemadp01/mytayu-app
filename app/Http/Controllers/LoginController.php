<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    protected $levels = ['mahasiswa', 'koordinator', 'kaprodi', 'dekan', 'admin', 'dospem'];

    public function index() {
        if (Auth::check()) {
            return redirect('/dashboard'); 
        }
        return view('login.index');
    }
    
    public function authenticate(Request $request) {

        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials)) {

            $user = Auth::user();

            if (!$user->status_user && in_array($user->level_user, $this->levels)) {
                Auth::logout();
                return back()->with('error', 'Tolong hubungi admin.');
            }

            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login Failed!');


    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // public function username()
    // {
    //     return 'username';
    // }
}
