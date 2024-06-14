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
            $table->string('id_pendaftaran');
            $table->string('nama');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->unsignedInteger('nisn');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('agama');
            $table->string('brkthn_khusus_siswa');
            $table->string('alamat');
            $table->string('desa_kelurahan');
            $table->string('kecamatan');
            $table->string('kode_pos');
            $table->string('nhp_ortu');
            $table->string('nhp_siswa');
            $table->string('email');
            $table->string('asal_sekolah');
            $table->string('nama_ayah');
            $table->string('pend_terakhir_ayah');
            $table->string('pekerjaan_ayah');
            $table->unsignedInteger('penghasilan_ayah');
            $table->string('brkthn_khusus_ayah');
            $table->string('nama_ibu');
            $table->string('pend_terakhir_ibu');
            $table->string('pekerjaan_ibu');
            $table->unsignedInteger('penghasilan_ibu');
            $table->string('brkthn_khusus_ibu');
            $table->string('nama_wali');
            $table->enum('jenis_kelamin_wali', ['laki-laki', 'perempuan']);
            $table->string('pend_terakhir_wali');
            $table->string('pekerjaan_wali');
            $table->unsignedInteger('penghasilan_wali');
            $table->string('brkthn_khusus_wali');
            $table->string('filefc_akte');
            $table->string('filefc_kk');
            $table->string('filefc_skhu');
            $table->string('filefc_skm');
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
