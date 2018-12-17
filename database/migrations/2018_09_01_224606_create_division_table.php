<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDivisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usrdvn', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dvn', 40);
            $table->unsignedInteger('cntid');
            $table->foreign('cntid')->references('id')->on('usrcnt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usrdvn');
    }
}
