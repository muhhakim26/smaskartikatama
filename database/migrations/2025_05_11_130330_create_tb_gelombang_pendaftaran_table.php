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
        Schema::create('tb_gelombang_pendaftaran', function (Blueprint $table) {
            $table->id()->comment('Nomor batch, contoh: 1, 2, 3');
            $table->string('tahun_ajaran')->nullable();
            $table->unsignedInteger('kuota_pendaftaran')->default(0);
            $table->date('tanggal_dibuka')->nullable();
            $table->date('tanggal_ditutup')->nullable();
            $table->date('tanggal_diumumkan')->nullable();
            $table->text('catatan')->nullable();
            $table->string('link_grup')->nullable();
            $table->boolean('status_pendaftaran')->default(false)->comment('Apakah batch ini aktif');
            $table->boolean('status_pengumuman')->default(false)->comment('Apakah batch ini diumumkan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_gelombang_pendaftaran');
    }
};