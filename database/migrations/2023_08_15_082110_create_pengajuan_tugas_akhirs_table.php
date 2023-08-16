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
        Schema::create('pengajuan_tugas_akhirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('mahasiswa_id');
            $table->string('nomor_pengajuan')->unique();
            $table->date('tanggal_pengajuan');
            $table->string('npm');
            $table->string('nama');
            $table->string('program_studi');
            $table->string('kelas');
            $table->string('nomor_telepon');
            $table->string('foto_kwitansi');
            $table->string('foto_ktm');
            $table->string('foto_khs');
            $table->string('foto_krs');
            $table->string('topik_penelitian');
            $table->string('proposal_ta');
            $table->string('usulan_pembimbing_mhs1_id');
            $table->string('usulan_pembimbing_mhs2_id');
            $table->string('status_pengajuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_tugas_akhirs');
    }
};
