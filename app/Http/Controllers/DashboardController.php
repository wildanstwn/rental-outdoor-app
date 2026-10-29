<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Alat;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. DATA KARTU RINGKASAN ATAS
        $booking_baru = Pesanan::where('status', 'menunggu_validasi')->count();
        $tervalidasi  = Pesanan::where('status', 'tervalidasi')->count();
        $sewa_aktif   = Pesanan::where('status', 'sedang_dipinjam')->count();
        
        // Hitung yang telat (status belum selesai & tanggal kembali sudah lewat)
        $telat_kembali = Pesanan::whereIn('status', ['tervalidasi', 'sedang_dipinjam'])
                                ->whereDate('tgl_kembali_seharusnya', '<', Carbon::today())
                                ->count();

        // 2. DATA ALAT TERLARIS (Top 3)
        $alat_terlaris = Alat::withCount('detail_pesanans')
                             ->orderByDesc('detail_pesanans_count')
                             ->take(3)
                             ->get();

        // 3. DATA GRAFIK TREN (7 Hari Terakhir)
        $chart_labels = [];
        $chart_data = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $tanggal = Carbon::today()->subDays($i);
            $chart_labels[] = $tanggal->translatedFormat('d M'); // Contoh: "15 Mei"
            
            // Hitung jumlah pesanan pada tanggal tersebut
            $jumlah_pesanan = Pesanan::whereDate('tgl_sewa', $tanggal)->count();
            $chart_data[] = $jumlah_pesanan;
        }

        return view('admin.dashboard', compact(
            'booking_baru', 'tervalidasi', 'sewa_aktif', 'telat_kembali', 
            'alat_terlaris', 'chart_labels', 'chart_data'
        ));
    }
}