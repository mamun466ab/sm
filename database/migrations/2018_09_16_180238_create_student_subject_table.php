<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stdsub', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('stdid');
            $table->string('sclcd', 8);
            $table->string('sub', 255);
            $table->string('frthsub', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stdsub');
    }
}
