<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Alat;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function index()
    {
        // Hanya ambil pesanan yang berstatus disetujui/sedang dipinjam (Belum Selesai)
        // Ubah dari detail_pesanans menjadi details
    $pesanans = Pesanan::with(['user', 'details.alat'])
                ->whereIn('status', ['tervalidasi', 'sedang_dipinjam'])
                ->latest()
                ->get();

        return view('admin.pengembalian.index', compact('pesanans'));
    }

    public function prosesKembali(Request $request, $id)
    {
        // Ubah juga di sini
        $pesanan = Pesanan::with('details.alat')->findOrFail($id);

        $hari_ini = Carbon::now()->startOfDay();
        $tgl_kembali_seharusnya = Carbon::parse($pesanan->tgl_kembali_seharusnya)->startOfDay();
        
        $keterlambatan = 0;
        $total_denda = 0;

        // 1. Logika Hitung Denda (Jika Terlewat)
        if ($hari_ini->greaterThan($tgl_kembali_seharusnya)) {
            $keterlambatan = $hari_ini->diffInDays($tgl_kembali_seharusnya);
            
            // Hitung denda berdasarkan tarif denda masing-masing alat dikali hari telat
            foreach ($pesanan->detail_pesanans as $detail) {
                if ($detail->alat) {
                    $total_denda += ($keterlambatan * $detail->alat->denda_per_hari * $detail->kuantitas);
                }
            }
        }

        // 2. Logika Pemulihan Stok (Increment)
        foreach ($pesanan->detail_pesanans as $detail) {
            $alat = Alat::find($detail->alat_id);
            if ($alat) {
                $alat->increment('stok_tersedia', $detail->kuantitas);
            }
        }

        // 3. Update Status Transaksi Menjadi Selesai
        $pesanan->update([
            'status' => 'selesai',
            'tgl_kembali_aktual' => Carbon::now()->toDateString(),
            'denda' => $total_denda
        ]);

        return redirect()->back()->with('success', 'Alat berhasil dikembalikan! Stok telah dipulihkan dan pesanan diselesaikan.');
    }
}