<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf; // Tambahkan baris ini

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pesanan::with('detail_pesanans')->where('status', 'selesai');

        if ($request->filled('dari_tanggal') && $request->filled('sampai_tanggal')) {
            $query->whereBetween('tgl_kembali_aktual', [$request->dari_tanggal, $request->sampai_tanggal]);
        }

        $pesanans = $query->get();

        $laporan = $pesanans->groupBy(function($date) {
            return Carbon::parse($date->tgl_kembali_aktual)->translatedFormat('F Y');
        })->map(function ($row) {
            return [
                'total_transaksi' => $row->count(),
                'unit_keluar' => $row->sum(function ($pesanan) {
                    return $pesanan->detail_pesanans->sum('kuantitas');
                }),
                'total_denda' => $row->sum('denda'),
                'total_pendapatan' => $row->sum('total_bayar') + $row->sum('denda'),
            ];
        });

        return view('admin.laporan.index', compact('laporan'));
    }

    // --- FUNGSI BARU UNTUK CETAK PDF ---
    public function cetakPdf(Request $request)
    {
        // Logika pengumpulan datanya sama persis dengan fungsi index
        $query = Pesanan::with('detail_pesanans')->where('status', 'selesai');

        if ($request->filled('dari_tanggal') && $request->filled('sampai_tanggal')) {
            $query->whereBetween('tgl_kembali_aktual', [$request->dari_tanggal, $request->sampai_tanggal]);
        }

        $pesanans = $query->get();

        $laporan = $pesanans->groupBy(function($date) {
            return Carbon::parse($date->tgl_kembali_aktual)->translatedFormat('F Y');
        })->map(function ($row) {
            return [
                'total_transaksi' => $row->count(),
                'unit_keluar' => $row->sum(function ($pesanan) {
                    return $pesanan->detail_pesanans->sum('kuantitas');
                }),
                'total_denda' => $row->sum('denda'),
                'total_pendapatan' => $row->sum('total_bayar') + $row->sum('denda'),
            ];
        });

        // Lempar data ke view khusus PDF lalu download
        $pdf = Pdf::loadView('admin.laporan.pdf', compact('laporan'));
        
        // Atur ukuran kertas (A4, Potrait)
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Laporan_Operasional_Selekta_Adventure.pdf');
    }
}