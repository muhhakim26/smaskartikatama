<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indonesia_districts', function (Blueprint $table) {
            $table->id();
            $table->char('code', 8)->unique();
            $table->char('regency_code', 5);
            $table->string('name', 255);
            $table->timestamps();

            $table->foreign('regency_code')->references('code')->on(env('INDONESIA_AREA_TABLE_PREFIX', 'indonesia_') . 'regencies')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('indonesia_districts');
    }
}
