<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Alat;
use Carbon\Carbon; // Untuk memformat tanggal

class PesananController extends Controller
{
    public function index()
    {
        // Ambil data pesanan, urutkan dari yang terbaru, dan sertakan data usernya
        $pesanans = Pesanan::with('user')->latest()->get();
        return view('admin.pesanan.index', compact('pesanans'));
    }

    // Fungsi Krusial: Validasi Pesanan dan Kurangi Stok
    public function validasi($id)
    {
        $pesanan = Pesanan::with('detail_pesanans')->findOrFail($id);

        if ($pesanan->status == 'menunggu_validasi') {
            // Ubah status
            $pesanan->update(['status' => 'tervalidasi']);

            // Kurangi stok alat secara otomatis
            foreach ($pesanan->detail_pesanans as $detail) {
                $alat = Alat::find($detail->alat_id);
                if ($alat) {
                    // Fitur decrement bawaan Laravel untuk mengurangi angka
                    $alat->decrement('stok_tersedia', $detail->kuantitas); 
                }
            }

            return redirect()->back()->with('success', 'Pesanan berhasil divalidasi! Stok alat telah otomatis dikurangi.');
        }

        return redirect()->back()->with('error', 'Pesanan sudah divalidasi sebelumnya.');
    }
}