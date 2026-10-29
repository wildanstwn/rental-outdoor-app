<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        // Mengambil kategori sekalian menghitung jumlah alat yang terikat di dalamnya
        $kategoris = Kategori::withCount('alats')->latest()->get(); 
        
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate(['nama_kategori' => 'required|string|max:255']);
        Kategori::create(['nama_kategori' => $request->nama_kategori]);
        return redirect()->back()->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    // Fungsi baru untuk memproses Update / Edit
    public function update(Request $request, $id)
    {
        $request->validate(['nama_kategori' => 'required|string|max:255']);
        $kategori = Kategori::findOrFail($id);
        $kategori->update(['nama_kategori' => $request->nama_kategori]);
        return redirect()->back()->with('success', 'Nama kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
    }
}