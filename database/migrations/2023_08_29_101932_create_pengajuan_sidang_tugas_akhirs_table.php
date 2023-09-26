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
        Schema::create('pengajuan_sidang_tugas_akhirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('no_pengajuan_sidang');
            $table->string('tanggal_pengajuan');
            $table->string('tahun_akademik');
            $table->string('npm');
            $table->string('nama');
            $table->string('program_studi');
            $table->string('kelas');
            $table->string('nomor_telepon');
            $table->string('email');
            $table->string('judul_sdta');
            $table->string('foto_kwitansi_wisuda');
            $table->string('foto_kwitansi_ta');
            $table->string('draft_laporan');
            $table->string('lembar_persetujuan_sidang');
            $table->string('khs');
            $table->string('krs');
            $table->string('ktm');
            $table->string('sk_pembimbing');
            $table->string('sbb')->nullable();
            $table->string('sbb_perpustakaan')->nullable();
            $table->string('foto_ijazah_sma');
            $table->string('sertifikat_pkkmb');
            $table->string('sertifikat_toefl');
            $table->text('sertifikat_kegiatan');
            $table->unsignedInteger('status_pengajuan_sidang')->length(1)->default(0);
            $table->string('yudisium')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_sidang_tugas_akhirs');
    }
};
