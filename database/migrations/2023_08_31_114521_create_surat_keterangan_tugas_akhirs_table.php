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
        Schema::create('surat_keterangan_tugas_akhirs', function (Blueprint $table) {
            $table->id();
            $table->string('npm')->nullable();
            $table->string('nama')->nullable();
            $table->date('tanggal_berlaku')->nullable();
            $table->string('tanggal_berakhir')->nullable();
            $table->string('sk_ta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keterangan_tugas_akhirs');
    }
};
