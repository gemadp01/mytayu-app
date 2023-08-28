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
        Schema::create('penjadwalan_seminar_tugas_akhirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_seminarta_id');
            $table->string('pembimbing_1');
            $table->string('pembimbing_2');
            $table->string('tanggal_approve_seminarta')->nullable();
            $table->string('tanggal_penjadwalan')->nullable();
            $table->string('waktu_seminar')->nullable();
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
        Schema::dropIfExists('penjadwalan_seminar_tugas_akhirs');
    }
};
