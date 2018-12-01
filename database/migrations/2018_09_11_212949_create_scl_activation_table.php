<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSclActivationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scl_activation', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('adminid');
            $table->tinyInteger('sclid');
            $table->unsignedInteger('activation'); //1 active. 0 deactive
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scl_activation');
    }
}
