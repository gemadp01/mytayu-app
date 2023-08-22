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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_accid');
            $table->foreignId('pembimbing_id');
            $table->string('hari');
            $table->string('tanggal');
            $table->string('waktu_awal');
            $table->string('waktu_akhir');
            $table->string('jenis_pertemuan');
            $table->unsignedInteger('kuota_bimbingan')->length(2)->default(0);
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
