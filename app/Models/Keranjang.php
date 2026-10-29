<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'alat_id', 'kuantitas'];

    // Relasi ke User (Pemilik Keranjang)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Alat (Barang yang dimasukkan)
    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }
}