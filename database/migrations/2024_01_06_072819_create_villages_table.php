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
        Schema::create(env('INDONESIA_AREA_TABLE_PREFIX', '') . 'villages', function (Blueprint $table) {
            $table->id();
            $table->char('code', 13)->unique();
            $table->char('district_code', 8);
            $table->string('name', 255);
            $table->timestamps();

            $table->foreign('district_code')
                ->references('code')
                ->on(env('INDONESIA_AREA_TABLE_PREFIX', '') . 'districts')
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
        Schema::drop(env('INDONESIA_AREA_TABLE_PREFIX', '') . 'villages');
    }
}
