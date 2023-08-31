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
        Schema::create('detail_pengajuan_sidang_tugas_akhirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_sidang_tugas_akhir_id');
            $table->string('ket_lampiran_kwitansi_wisuda')->nullable();
            $table->string('ket_lampiran_draft')->nullable();
            $table->string('ket_lampiran_kwitansi_ta')->nullable();
            $table->string('ket_persetujuan_sidang')->nullable();
            $table->string('ket_lampiran_bimbingan1')->nullable();
            $table->string('ket_lampiran_bimbingan2')->nullable();
            $table->string('ket_lampiran_khs')->nullable();
            $table->string('ket_lampiran_krs')->nullable();
            $table->string('ket_lampiran_ktm')->nullable();
            $table->string('ket_lampiran_sk_pembimbing')->nullable();
            $table->string('ket_sbb_pendidikan')->nullable();
            $table->string('ket_sbb_perpustakaan')->nullable();
            $table->string('ket_lampiran_ijazah')->nullable();
            $table->string('ket_lampiran_sertifikat_kegiatan')->nullable();
            $table->string('ket_lampiran_sertifikat_pkkmb')->nullable();
            $table->string('ket_lampiran_sertifikat_toefl')->nullable();
            $table->string('tanggapan')->nullable();
            $table->string('tanggal_penerimaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pengajuan_sidang_tugas_akhirs');
    }
};
