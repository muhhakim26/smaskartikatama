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
        Schema::create('ppdb', function (Blueprint $table) {
            $table->id();
            $table->string('id_pendaftaran')->unique();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->unsignedInteger('nisn')->unique();
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->enum('agama', ['islam', 'kristen_protestan', 'kristen_katolik', 'hindu', 'buddha', 'konghucu']);
            $table->boolean('brkthn_khusus_siswa')->default('0'); // masih ragu
            $table->text('alamat');
            $table->foreignId('provinsi_id')->constrained(env('INDONESIA_AREA_TABLE_PREFIX', '') . 'provinces', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('kabupaten_id')->constrained(env('INDONESIA_AREA_TABLE_PREFIX', '') . 'regencies', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('kecamatan_id')->constrained(env('INDONESIA_AREA_TABLE_PREFIX', '') . 'districts', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('desa_kelurahan_id')->constrained(env('INDONESIA_AREA_TABLE_PREFIX', '') . 'villages', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->unsignedInteger('kode_pos');
            $table->string('nhp_ortu');
            $table->string('nhp_siswa');
            $table->string('email')->unique();
            $table->string('asal_sekolah');
            $table->string('nama_ayah');
            $table->string('pend_terakhir_ayah');
            $table->string('pekerjaan_ayah');
            $table->unsignedInteger('penghasilan_ayah');
            $table->boolean('brkthn_khusus_ayah')->default('0');
            $table->string('nama_ibu');
            $table->string('pend_terakhir_ibu');
            $table->string('pekerjaan_ibu');
            $table->unsignedInteger('penghasilan_ibu');
            $table->boolean('brkthn_khusus_ibu')->default('0');
            $table->string('nama_wali')->nullable();
            $table->enum('jenis_kelamin_wali', ['laki-laki', 'perempuan'])->nullable();
            $table->string('pend_terakhir_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->unsignedInteger('penghasilan_wali')->nullable();
            $table->boolean('brkthn_khusus_wali')->nullable();
            $table->set('info_pendaftaran', ['masyarakat', 'media_cetak', 'facebook', 'instagram', 'tiktok', 'website']);
            $table->string('filefc_akte');
            $table->string('filefc_kk');
            $table->string('filefc_skhu');
            $table->string('filefc_skm');
            $table->string('token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb');
    }
};