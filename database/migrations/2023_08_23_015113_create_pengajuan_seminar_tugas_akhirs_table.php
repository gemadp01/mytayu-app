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
        Schema::create('pengajuan_seminar_tugas_akhirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('no_pengajuan_seminar');
            $table->string('tanggal_pengajuan');
            $table->string('npm');
            $table->string('nama');
            $table->string('program_studi');
            $table->string('kelas');
            $table->string('nomor_telepon');
            $table->string('email');
            $table->string('foto_kwitansi');
            $table->string('foto_khs');
            $table->string('foto_krs');
            $table->string('sk_ta');
            $table->string('lembar_persetujuan_seminarta');
            $table->string('lembar_bimbingan1');
            $table->string('lembar_bimbingan2');
            $table->string('judul_smta');
            $table->string('draft_laporan');
            $table->text('sertifikat_kegiatan');
            $table->unsignedInteger('status_pengajuan_seminar')->length(1)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_seminar_tugas_akhirs');
    }
};
