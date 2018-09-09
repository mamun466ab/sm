<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSclregTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sclreg', function (Blueprint $table) {
            $table->increments('id', 25);
            $table->string('sclnme', 150);
            $table->string('scleml', 100)->unique();
            $table->string('sclcde', 8)->unique();
            $table->string('scladr', 255);
            $table->unsignedInteger('cntid');
            $table->unsignedInteger('dvnid');
            $table->unsignedInteger('dstid');
            $table->unsignedInteger('thnid');
            $table->string('sclrfr', 30)->nullable();
            $table->string('jondt', 10);
            $table->string('expdte', 10);
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
