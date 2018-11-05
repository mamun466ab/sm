<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsrregTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usrreg', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('usrnme', 100);
            $table->string('usreml', 100)->unique();
            $table->string('usrgnr', 7);
            $table->string('usrtyp', 7);
            $table->string('usrid', 30)->unique();
            $table->string('usrpsd', 32);
            $table->string('sclcd', 11);
            $table->string('usrrnk', 30);
            $table->boolean('usrpwr');
            $table->tinyInteger('usrsts');
            $table->string('jondte', 10);
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
        Schema::dropIfExists('users');
    }
}
