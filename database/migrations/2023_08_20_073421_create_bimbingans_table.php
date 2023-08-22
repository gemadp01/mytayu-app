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
        Schema::create('bimbingans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('pembimbing_id');
            $table->foreignId('appointment_id');
            $table->string('tanggal_bimbingan');
            $table->string('npm');
            $table->string('nama');
            $table->string('jam_awal');
            $table->string('jam_akhir');
            $table->string('judul')->nullable();
            $table->string('materi_pembahasan')->nullable();
            $table->string('hasil_saran_tugas')->nullable();
            $table->unsignedInteger('status_bimbingan')->length(1)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bimbingans');
    }
};
