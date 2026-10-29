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
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('alat_id');
            $table->integer('kuantitas')->default(1);
            $table->timestamps();

            // Relasi ke tabel users dan alats
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('alat_id')->references('id')->on('alats')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjangs');
    }
};
