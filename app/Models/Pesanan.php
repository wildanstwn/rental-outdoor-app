<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $guarded = ['id']; 

    // Relasi ke Pemesan (User)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Detail Pesanan (Cukup satu ini saja)
    public function details() 
    {
        return $this->hasMany(DetailPesanan::class, 'pesanan_id');
    }

    // Menghitung total unit barang dalam 1 pesanan
    public function getTotalAlatAttribute()
    {
        return $this->details->sum('kuantitas');
    }
}