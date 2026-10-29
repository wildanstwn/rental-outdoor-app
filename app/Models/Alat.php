<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    // Izinkan input data ke kolom-kolom ini
    protected $fillable = [
        'kategori_id', 'nama_alat', 'deskripsi', 'harga_per_hari', 
        'denda_per_hari', 'stok_total', 'stok_tersedia', 'gambar'
    ];

    // Relasi ke tabel Kategori (Satu Alat punya Satu Kategori)
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function detail_pesanans()
    {
        return $this->hasMany(DetailPesanan::class, 'alat_id');
    }
}