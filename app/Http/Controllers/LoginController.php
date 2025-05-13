<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Konstruktor untuk menentukan middleware
    public function __construct()
    {
        // Menambahkan middleware guest untuk halaman login, kecuali untuk logout
        $this->middleware('guest')->except('logout');
        // Menambahkan middleware auth hanya untuk logout
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi email dan password
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek kredensial menggunakan Auth::attempt()
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();  // Regenerasi session setelah login
            return redirect()->intended('/admin/dashboard');  // Redirect ke dashboard admin
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password tidak valid.',
        ])->withInput($request->only('email'));  // Kembalikan input email yang dimasukkan
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();  // Logout pengguna
        $request->session()->invalidate();  // Hapus session
        $request->session()->regenerateToken();  // Regenerasi CSRF token
        return redirect('/');  // Redirect ke halaman utama setelah logout
    }
}

