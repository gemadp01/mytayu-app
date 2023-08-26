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
        Schema::create('penilaian_seminar_tugas_akhirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_seminarta_id');
            $table->foreignId('penjadwalan_seminarta_id');
            $table->foreignId('pembimbing1_id');
            $table->foreignId('pembimbing2_id');
            $table->text('catatan_perbaikan_pembimbing1');
            $table->text('catatan_perbaikan_pembimbing2');
            $table->text('keterangan_perbaikan');
            $table->string('tanggal_berita_acara');
            $table->unsignedInteger('approve_pembimbing1')->length(1)->default(0);
            $table->unsignedInteger('approve_pembimbing2')->length(1)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_seminar_tugas_akhirs');
    }
};
