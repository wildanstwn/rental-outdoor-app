<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PelangganController extends Controller
{
    public function index()
    {
        // Ambil data user yang role-nya HANYA 'penyewa'
        // dan hitung otomatis berapa kali mereka melakukan transaksi (pesanans_count)
        $pelanggans = User::where('role', 'penyewa')
                          ->withCount('pesanans')
                          ->latest()
                          ->get();

        return view('admin.pelanggan.index', compact('pelanggans'));
    }
}