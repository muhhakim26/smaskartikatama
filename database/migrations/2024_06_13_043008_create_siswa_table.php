<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gelombang_pendaftaran');
            $table->string('tahun_ajaran');
            $table->string('id_pendaftaran')->unique();
            $table->string('nisn', 12)->unique();
            $table->string('nama');
            $table->string('nhp_siswa');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('level', ['siswa'])->default('siswa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};