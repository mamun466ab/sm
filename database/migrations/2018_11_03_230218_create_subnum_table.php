<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubnumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subnum', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sclcd', 11);
            $table->unsignedBigInteger('stdid');
            $table->tinyInteger('stdcls');
            $table->string('sub', 30);
            $table->tinyInteger('num');
            $table->unsignedInteger('ssn');
            $table->string('exmtyp', 30);
            $table->tinyInteger('sts')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subnum');
    }
}
