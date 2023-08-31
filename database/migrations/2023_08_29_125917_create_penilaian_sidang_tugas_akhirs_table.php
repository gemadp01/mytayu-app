<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penilaian_sidang_tugas_akhirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_sidangta_id')->nullable();
            $table->foreignId('penjadwalan_sidangta_id')->nullable();
            $table->foreignId('penguji_utama_id')->nullable();
            $table->foreignId('penguji1_id')->nullable();
            $table->foreignId('penguji2_id')->nullable();
            $table->foreignId('penguji3_id')->nullable();
            $table->string('nilai_penguji_utama')->nullable();
            $table->string('nilai_penguji1')->nullable();
            $table->string('nilai_penguji2')->nullable();
            $table->string('nilai_penguji3')->nullable();
            $table->string('tanggal_berita_acara')->nullable();
            $table->string('catatan_perbaikan_penguji_utama')->nullable();
            $table->string('catatan_perbaikan_penguji1')->nullable();
            $table->string('catatan_perbaikan_penguji2')->nullable();
            $table->string('catatan_perbaikan_penguji3')->nullable();
            $table->string('keterangan_berita_acara')->nullable();
            $table->string('keterangan_perbaikan')->nullable();
            $table->string('approve_penguji_utama')->nullable();
            $table->string('approve_penguji1')->nullable();
            $table->string('approve_penguji2')->nullable();
            $table->string('approve_penguji3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_sidang_tugas_akhirs');
    }
};
