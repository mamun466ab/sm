<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThanaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usrthn', function (Blueprint $table) {
            $table->increments('id');
            $table->string('thn', 40);
            $table->unsignedInteger('dstid');
            $table->foreign('dstid')->references('id')->on('usrdst');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usrthn');
    }
}
