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
        Schema::create('penjadwalan_sidang_tugas_akhirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_sidang_tugas_akhir_id');
            $table->string('tanggal_input_penguji')->nullable();
            $table->string('pembimbing1_id')->nullable();
            $table->string('pembimbing2_id')->nullable();
            $table->string('penguji1_id')->nullable();
            $table->string('penguji2_id')->nullable();
            $table->foreignId('penguji_utama_id')->nullable();
            $table->foreignId('uji1_id')->nullable();
            $table->foreignId('uji2_id')->nullable();
            $table->foreignId('uji3_id')->nullable();
            $table->string('tanggal_penjadwalan')->nullable();
            $table->string('waktu_sidang')->nullable();
            $table->string('ruangan')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjadwalan_sidang_tugas_akhirs');
    }
};
