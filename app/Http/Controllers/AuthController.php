<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman login manual
    public function showLogin() { 
        return view('auth.login'); 
    }

    // Logic login untuk session web
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek kredensial dan fitur remember me
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Login Berhasil, Mission Start!'); 
        }

        return back()->withErrors(['email' => 'Email atau password salah, Cok.'])->onlyInput('email');
    }

    // Menampilkan halaman register manual
    public function showRegister() { 
        return view('auth.register'); 
    }

    // Logic registrasi user baru via Web
    public function register(Request $request) {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // Simpan ke DB dengan password ter-hash
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Otomatis login setelah daftar
        Auth::login($user);
        return redirect('/')->with('success', 'Akun Berhasil Dibuat, Welcome Operative!'); 
    }

    // Keluar dari sesi
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Logged out. Mission end.');
    }
}