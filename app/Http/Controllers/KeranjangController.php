<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    // Menampilkan isi keranjang
    public function index()
    {
        $keranjangs = Keranjang::where('user_id', Auth::id())->with('alat')->get();
        return view('keranjang', compact('keranjangs'));
    }

    // Menambah alat ke keranjang
    public function store(Request $request)
    {
        $request->validate(['alat_id' => 'required', 'kuantitas' => 'required|min:1']);

        // Cek apakah alat sudah ada di keranjang, jika ya tinggal tambah kuantitasnya
        $item = Keranjang::where('user_id', Auth::id())->where('alat_id', $request->alat_id)->first();

        if ($item) {
            $item->increment('kuantitas', $request->kuantitas);
        } else {
            Keranjang::create([
                'user_id' => Auth::id(),
                'alat_id' => $request->alat_id,
                'kuantitas' => $request->kuantitas
            ]);
        }

        return redirect('/keranjang')->with('success', 'Alat berhasil ditambahkan ke keranjang!');
    }

    // Menghapus item
    public function destroy($id)
    {
        Keranjang::where('user_id', Auth::id())->findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Alat dihapus dari keranjang.');
    }
}