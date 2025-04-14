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
        Schema::create('tb_ppdb', function (Blueprint $table) {
            $table->id();
            $table->string('id_pendaftaran')->unique();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->unsignedInteger('nisn')->unique();
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->enum('agama', ['islam', 'kristen_protestan', 'kristen_katolik', 'hindu', 'buddha', 'konghucu']);
            $table->text('alamat');
            $table->foreignId('provinsi_id')->constrained(env('INDONESIA_AREA_TABLE_PREFIX', 'indonesia_') . 'provinces', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('kabupaten_id')->constrained(env('INDONESIA_AREA_TABLE_PREFIX', 'indonesia_') . 'regencies', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('kecamatan_id')->constrained(env('INDONESIA_AREA_TABLE_PREFIX', 'indonesia_') . 'districts', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('desa_kelurahan_id')->constrained(env('INDONESIA_AREA_TABLE_PREFIX', 'indonesia_') . 'villages', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->unsignedInteger('kode_pos');
            $table->string('nhp_siswa');
            $table->string('email')->unique();
            $table->string('asal_sekolah');
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
            $table->string('filesc_akte');
            $table->string('filesc_kk');
            $table->string('filesc_skhu');
            $table->string('filesc_skm');
            $table->string('fileft_siswa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_ppdb');
    }
};
