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
        Schema::create('tb_progres_siswa', function (Blueprint $table) {
            $table->foreignId('siswa_id')->constrained('siswa', 'id')->cascadeOnDelete();
            $table->primary('siswa_id');
            $table->boolean('step_1')->default(false);
            $table->boolean('step_2')->default(false);
            $table->boolean('step_3')->default(false);
            $table->boolean('step_4')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_progres_siswa');
    }
};