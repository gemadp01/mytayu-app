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
        Schema::create('detail_pengajuan_seminar_tugas_akhirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_seminar_tugas_akhir_id');
            $table->string('ket_kwitansi')->nullable();
            $table->string('ket_khs')->nullable();
            $table->string('ket_krs')->nullable();
            $table->string('ket_draft_laporan')->nullable();
            $table->string('ket_sk_ta')->nullable();
            $table->string('ket_persetujuan_seminarta')->nullable();
            $table->string('ket_lembar_bimbingan1')->nullable();
            $table->string('ket_lembar_bimbingan2')->nullable();
            $table->string('ket_sertifikat_kegiatan')->nullable();
            $table->string('tanggapan')->nullable();
            $table->string('tanggal_penerimaan')->nullable();
            $table->unsignedInteger('status_approve')->length(1)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pengajuan_seminar_tugas_akhirs');
    }
};
