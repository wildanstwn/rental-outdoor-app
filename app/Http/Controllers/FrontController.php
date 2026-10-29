<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // WAJIB ADA
use Carbon\Carbon;
use Midtrans\Config; // WAJIB ADA
use Midtrans\Snap;   // WAJIB ADA

class FrontController extends Controller
{
    public function katalog(Request $request)
    {
        $query = Alat::with('kategori');
        if ($request->has('cari') && $request->cari != '') {
            $query->where('nama_alat', 'like', '%' . $request->cari . '%');
        }
        $alats = $query->latest()->paginate(9);
        return view('katalog', compact('alats'));
    }

    public function checkoutAll()
    {
        $keranjangs = Keranjang::where('user_id', Auth::id())->with('alat')->get();
        if($keranjangs->isEmpty()) return redirect('/keranjang');
        
        $total_per_hari = 0;
        foreach($keranjangs as $item) {
            $total_per_hari += ($item->alat->harga_per_hari * $item->kuantitas);
        }
        
        return view('checkout-all', compact('keranjangs', 'total_per_hari'));
    }
public function prosesCheckoutAll(Request $request)
    {
        $request->validate([
            'tgl_sewa' => 'required|date',
            'tgl_kembali' => 'required|date|after:tgl_sewa',
        ]);

        $keranjangs = Keranjang::where('user_id', Auth::id())->with('alat')->get();
        
        if($keranjangs->isEmpty()) return back()->with('error', 'Keranjang Anda kosong!');

        $tgl_sewa = Carbon::parse($request->tgl_sewa);
        $tgl_kembali = Carbon::parse($request->tgl_kembali);
        $durasi = $tgl_sewa->diffInDays($tgl_kembali);
        if($durasi < 1) $durasi = 1;

        $total_per_hari = 0;
        foreach($keranjangs as $item) {
            if(!$item->alat || $item->alat->harga_per_hari <= 0) {
                 return back()->with('error', 'Harga alat tidak valid. Periksa database.');
            }
            $total_per_hari += ($item->alat->harga_per_hari * $item->kuantitas);
        }
        $total_bayar = $total_per_hari * $durasi;

        if ($total_bayar < 1000) {
            return back()->with('error', 'Total pembayaran minimal Rp 1.000');
        }

        $pesanan = null; 

        DB::transaction(function () use ($request, $keranjangs, $total_bayar, &$pesanan) {
            $pesanan = Pesanan::create([
                'user_id' => Auth::id(),
                'tgl_sewa' => $request->tgl_sewa,
                'tgl_kembali_seharusnya' => $request->tgl_kembali,
                'total_bayar' => $total_bayar,
                'status' => 'menunggu_pembayaran'
            ]);

            foreach($keranjangs as $item) {
                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'alat_id' => $item->alat_id,
                    'kuantitas' => $item->kuantitas,
                    'harga_sewa_saat_itu' => $item->alat->harga_per_hari
                ]);
            }
            Keranjang::where('user_id', Auth::id())->delete();
        });

        // INTEGRASI MIDTRANS
        Config::$serverKey = env('MIDTRANS_SERVER_KEY'); 
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        try {
            $params = [
                'transaction_details' => [
                    'order_id' => 'SLK-' . $pesanan->id,
                    'gross_amount' => (int) $total_bayar,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ],
            ];

            $snapToken = Snap::getSnapToken($params);
            
            // SEMUA VARIABEL DI SINI
            return view('checkout-all', compact('pesanan', 'snapToken', 'total_bayar', 'durasi', 'total_per_hari'));

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    public function riwayat()
{
    $pesanans = \App\Models\Pesanan::where('user_id', \Illuminate\Support\Facades\Auth::id())
                        ->with(['details.alat']) // WAJIB ADA 'details.alat' agar nama alat muncul
                        ->latest()
                        ->get();

    return view('riwayat', compact('pesanans'));
}
public function detailRiwayat($id)
{
    // Mengambil pesanan berdasarkan ID dan memastikan milik user yang login
    $pesanan = Pesanan::with(['details.alat'])
                      ->where('id', $id)
                      ->where('user_id', Auth::id())
                      ->firstOrFail();

    return view('detail-riwayat', compact('pesanan'));
}

public function callback(Request $request)
{
    $serverKey = env('MIDTRANS_SERVER_KEY');
    $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

    if ($hashed == $request->signature_key) {
        // Hapus prefix 'SLK-' agar bisa dicari di database
        $orderId = str_replace('SLK-', '', $request->order_id);
        
        $pesanan = Pesanan::find($orderId); // Sekarang mencari ID '42'
        
        if ($pesanan) {
            if ($request->transaction_status == 'settlement' || $request->transaction_status == 'capture') {
                $pesanan->update(['status' => 'menunggu_validasi']);
            }
        }
    }
}
}