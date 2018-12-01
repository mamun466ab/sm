<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtsubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extsub', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sclcd', 11);
            $table->string('exsub', 30);
            $table->unsignedInteger('exsubcd')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extsub');
    }
}
