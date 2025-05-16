<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVillagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indonesia_villages', function (Blueprint $table) {
            $table->id();
            $table->char('code', 13)->unique();
            $table->char('district_code', 8);
            $table->string('name', 255);
            $table->timestamps();

            $table->foreign('district_code')->references('code')->on(env('INDONESIA_AREA_TABLE_PREFIX', 'indonesia_') . 'districts')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('indonesia_villages');
    }
}