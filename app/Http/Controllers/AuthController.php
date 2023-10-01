<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //index
    public function login()
    {
        return view('login');
    }

    //login
    public function authenthicate(Request $request)
    {
        // validasi
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return redirect()->back()->with(['failed' => 'Login Gagal!']);

    }

    // logout
    public function logout(Request $request)
    {
        // validasi
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with(['success' => 'Anda telah logout!']);

    }
}
