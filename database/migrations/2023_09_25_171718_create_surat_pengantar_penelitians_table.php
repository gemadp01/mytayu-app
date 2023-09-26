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
        Schema::create('surat_pengantar_penelitians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nomor_pengajuan')->unique();
            $table->string('tanggal_pengajuan');
            $table->string('npm')->unique();
            $table->string('nama');
            $table->string('program_studi');
            $table->string('surat_dituju');
            $table->string('nama_instansi');
            $table->string('alamat_instansi');
            $table->string('waktu_penelitian');
            $table->string('judul_penelitian');
            $table->string('lembar_sk');
            $table->string('sk_pengantar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_pengantar_penelitians');
    }
};