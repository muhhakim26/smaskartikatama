<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(env('INDONESIA_AREA_TABLE_PREFIX', 'indonesia_') . 'regencies', function (Blueprint $table) {
            $table->id();
            $table->char('code', 5)->unique();
            $table->char('province_code', 2);
            $table->string('name', 255);
            $table->timestamps();

            $table->foreign('province_code')
                ->references('code')
                ->on(env('INDONESIA_AREA_TABLE_PREFIX', 'indonesia_') . 'provinces')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(env('INDONESIA_AREA_TABLE_PREFIX', 'indonesia_') . 'regencies');
    }
}
