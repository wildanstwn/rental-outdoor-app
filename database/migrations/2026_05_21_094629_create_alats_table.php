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
    Schema::create('alats', function (Blueprint $table) {
        $table->id();
        $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
        $table->string('nama_alat');
        $table->text('deskripsi')->nullable();
        $table->integer('harga_per_hari');
        $table->integer('denda_per_hari')->default(0); // Denda jika telat
        $table->integer('stok_total');
        $table->integer('stok_tersedia'); // Ini yang akan naik-turun saat disewa/kembali
        $table->string('gambar')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alats');
    }
};
