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
        Schema::create('detail_pengajuan_tugas_akhirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuanta_id');
            $table->string('ket_kwitansi')->nullable();
            $table->string('ket_ktm')->nullable();
            $table->string('ket_khs')->nullable();
            $table->string('ket_krs')->nullable();
            $table->string('tanggapan')->nullable();
            $table->string('tanggal_penerimaan')->nullable();
            $table->foreignId('usulan_pembimbing_kaprodi1_id')->nullable();
            $table->foreignId('usulan_pembimbing_kaprodi2_id')->nullable();
            $table->string('tanggal_input_pembimbing')->nullable();
            $table->unsignedInteger('status_approve')->length(1)->default(0);
            $table->string('tanggal_approve')->nullable();
            // $table->string('judul');
            // $table->unsignedInteger('approve_seminar')->length(1)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pengajuan_tugas_akhirs');
    }
};
