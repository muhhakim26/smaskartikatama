<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(env('INDONESIA_AREA_TABLE_PREFIX', '') . 'provinces', function (Blueprint $table) {
            $table->id();
            $table->char('code', 2)->unique();
            $table->string('name', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(env('INDONESIA_AREA_TABLE_PREFIX', '') . 'provinces');
    }
}
