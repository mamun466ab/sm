<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSttngTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sttng', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sclcd', 11);
            $table->string('sttngnm', 4);
            $table->boolean('sttng');
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
        Schema::dropIfExists('sttng');
    }
}
