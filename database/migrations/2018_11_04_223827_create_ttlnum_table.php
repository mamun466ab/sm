<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTtlnumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ttlnum', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sclcd', 11);
            $table->unsignedBigInteger('stdid');
            $table->tinyInteger('stdcls');
            $table->unsignedInteger('ttlnum');
            $table->unsignedInteger('ssn');
            $table->string('exmtyp', 30);
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
        Schema::dropIfExists('ttlnum');
    }
}
