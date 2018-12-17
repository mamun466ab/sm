<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClsrolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clsrol', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('stdid');
            $table->string('sclcd', 11);
            $table->unsignedInteger('stdcls');
            $table->unsignedInteger('stdrol');
            $table->foreign('sclcd')->references('sclcd')->on('sclreg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clsrol');
    }
}
