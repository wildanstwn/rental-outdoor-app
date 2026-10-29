<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\Kategori; // Panggil model Kategori untuk pilihan Dropdown
use Illuminate\Support\Facades\File;

class AlatController extends Controller
{
    public function index()
    {
        // Ambil semua data alat beserta relasi kategorinya
        $alats = Alat::with('kategori')->latest()->get();
        // Ambil data kategori untuk form tambah/edit alat
        $kategoris = Kategori::orderBy('nama_kategori', 'asc')->get();
        
        return view('admin.alat.index', compact('alats', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required',
            'nama_alat' => 'required|string|max:255',
            'harga_per_hari' => 'required|integer',
            'denda_per_hari' => 'required|integer',
            'stok_total' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $nama_gambar = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_gambar = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('images/alat'), $nama_gambar); // Simpan ke folder public/images/alat
        }

        Alat::create([
            'kategori_id' => $request->kategori_id,
            'nama_alat' => $request->nama_alat,
            'deskripsi' => $request->deskripsi,
            'harga_per_hari' => $request->harga_per_hari,
            'denda_per_hari' => $request->denda_per_hari,
            'stok_total' => $request->stok_total,
            'stok_tersedia' => $request->stok_total, // Saat awal dibuat, stok tersedia = stok total
            'gambar' => $nama_gambar,
        ]);

        return redirect()->back()->with('success', 'Data alat baru berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);
        
        // Hapus file gambar dari folder public jika ada
        if ($alat->gambar && File::exists(public_path('images/alat/' . $alat->gambar))) {
            File::delete(public_path('images/alat/' . $alat->gambar));
        }

        $alat->delete();
        return redirect()->back()->with('success', 'Data alat berhasil dihapus!');
    }
}