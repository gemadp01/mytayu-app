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
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->boolean('status_user')->default(false);
            $table->string('nidn')->unique();
            $table->string('nama')->unique();
            $table->char('singkatan', 3)->unique()->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->integer('kuota_pembimbing')->default(1)->nullable();
            $table->string('keilmuan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};
