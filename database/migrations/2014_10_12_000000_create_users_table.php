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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('dosen_id')->nullable();
            $table->boolean('is_koordinator')->default(false);
            // $table->boolean('status_user')->default(false);
            $table->string('nomor_induk')->unique();
            $table->string('name');
            $table->string('username')->unique();
            // $table->string('email')->unique(); //ori
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
