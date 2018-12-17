<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassRoutineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clsrtn', function (Blueprint $table) {
            $table->string('sclcd', 11);
            $table->string('cls', 30);
            $table->string('clstme', 20);
            $table->string('sat', 150);
            $table->string('sun', 150);
            $table->string('mon', 150);
            $table->string('tue', 150);
            $table->string('wed', 150);
            $table->string('thu', 150);
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
        Schema::dropIfExists('clsrtn');
    }
}
