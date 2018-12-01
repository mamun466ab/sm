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
            $table->string('sat', 30);
            $table->string('sun', 30);
            $table->string('mon', 30);
            $table->string('tue', 30);
            $table->string('wed', 30);
            $table->string('thu', 30);
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
