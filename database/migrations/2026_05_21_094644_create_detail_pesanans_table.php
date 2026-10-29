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
    Schema::create('detail_pesanans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pesanan_id')->constrained('pesanans')->onDelete('cascade');
        $table->foreignId('alat_id')->constrained('alats')->onDelete('cascade');
        $table->integer('kuantitas'); // Jumlah alat yang disewa
        $table->integer('harga_sewa_saat_itu'); // Merekam harga saat transaksi terjadi
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pesanans');
    }
};
