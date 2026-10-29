<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // 2. Memproses data dari form registrasi
    public function register(Request $request)
    {
        // Validasi inputan form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', // Email tidak boleh dobel
            'no_wa' => 'required|string|max:20',
            'alamat' => 'required|string',
            'password' => 'required|string|min:8|confirmed', // Harus cocok dengan password_confirmation
        ]);

        // Simpan data ke tabel users
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password dienkripsi
            'role' => 'penyewa', // Otomatis diset sebagai penyewa, bukan admin
            'no_wa' => $request->no_wa,
            'alamat' => $request->alamat,
        ]);

        // Langsung login-kan user setelah berhasil mendaftar
        Auth::login($user);

        // Arahkan ke halaman depan (Beranda)
        return redirect('/')->with('success', 'Registrasi berhasil! Selamat datang di Selekta Adventure.');
    }

    // Memproses data yang dikirim dari form login
    public function login(Request $request)
    {
        // 1. Validasi inputan form
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Cek kecocokan email dan password di database
        if (Auth::attempt($credentials)) {
            
            // Generate ulang session untuk keamanan
            $request->session()->regenerate();

            // 3. Cek Role (Admin / Penyewa) untuk menentukan arah redirect
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            // Jika role-nya penyewa, arahkan ke halaman utama (Katalog/Beranda)
            return redirect()->intended('/');
        }

        // Jika email atau password salah, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Memproses logout
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}