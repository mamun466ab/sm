<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExmrtnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exmrtn', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sclcd', 11);
            $table->string('cls', 30);
            $table->string('exmdte', 10);
            $table->string('fstsub', 150);
            $table->string('sndsub', 150);
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
        Schema::dropIfExists('exmrtn');
    }
}
