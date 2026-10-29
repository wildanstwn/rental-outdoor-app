<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('pesanans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke penyewa
        $table->date('tgl_sewa');
        $table->date('tgl_kembali_seharusnya');
        $table->date('tgl_kembali_aktual')->nullable(); // Diisi saat barang benar-benar dikembalikan
        $table->integer('total_bayar');
        $table->integer('denda')->default(0);
        $table->enum('status', ['menunggu_validasi', 'tervalidasi', 'sedang_dipinjam', 'selesai', 'dibatalkan'])->default('menunggu_validasi');
        $table->string('bukti_pembayaran')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
