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
        Schema::create('tb_detail_siswa', function (Blueprint $table) {
            $table->foreignId('siswa_id')->constrained('siswa', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary('siswa_id');
            $table->foreignId('provinsi_id')->constrained('indonesia_provinces', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->foreignId('kabupaten_id')->constrained('indonesia_regencies', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('kecamatan_id')->constrained('indonesia_districts', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('tempat_lahir');
            $table->foreignId('desa_kelurahan_id')->constrained('indonesia_villages', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->date('tgl_lahir');
            $table->unsignedInteger('kode_pos');
            $table->enum('agama', ['islam', 'kristen_protestan', 'kristen_katolik', 'konghucu', 'buddha', 'hindu']);
            $table->string('asal_sekolah');
            $table->text('alamat');
            $table->string('nama_ayah');
            $table->string('pend_terakhir_ayah');
            $table->string('pekerjaan_ayah');
            $table->unsignedInteger('penghasilan_ayah');
            $table->string('nhp_ayah');
            $table->string('nama_ibu');
            $table->string('pend_terakhir_ibu');
            $table->string('pekerjaan_ibu');
            $table->unsignedInteger('penghasilan_ibu');
            $table->string('nhp_ibu');
            $table->set('info_pendaftaran', ['masyarakat', 'media_cetak', 'facebook', 'instagram', 'tiktok', 'website', 'youtube', 'twitter']);
            $table->string('fileft_siswa')->nullable();
            $table->enum('status_fileft_siswa', ['diproses', 'diterima', 'ditolak'])->default('diproses');
            $table->text('catatan_fileft_siswa')->nullable();
            $table->string('filefc_akte')->nullable();
            $table->enum('status_filefc_akte', ['diproses', 'diterima', 'ditolak'])->default('diproses');
            $table->text('catatan_filefc_akte')->nullable();
            $table->string('filefc_kk')->nullable();
            $table->enum('status_filefc_kk', ['diproses', 'diterima', 'ditolak'])->default('diproses');
            $table->text('catatan_filefc_kk')->nullable();
            $table->string('filefc_skhu')->nullable();
            $table->enum('status_filefc_skhu', ['diproses', 'diterima', 'ditolak'])->default('diproses');
            $table->text('catatan_filefc_skhu')->nullable();
            $table->string('filefc_skm')->nullable();
            $table->enum('status_filefc_skm', ['diproses', 'diterima', 'ditolak'])->default('diproses');
            $table->text('catatan_filefc_skm')->nullable();
            $table->enum('status_berkas', ['diproses', 'diterima', 'ditolak'])->default('diproses');
            $table->enum('status_siswa', ['diverifikasi', 'diterima', 'ditolak'])->default('diverifikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_detail_siswa');
    }
};