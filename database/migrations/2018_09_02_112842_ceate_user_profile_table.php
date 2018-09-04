<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CeateUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usrpro', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('usrid');
            $table->string('sclcd', 8);
            $table->string('abt', 255);
            $table->string('fthr', 30);
            $table->string('mthr', 30);
            $table->unsignedInteger('cntid');
            $table->unsignedInteger('dvnid');
            $table->unsignedInteger('dstid');
            $table->unsignedInteger('thnid');
            $table->string('adr', 255);
            $table->string('rlgn', 20);
            $table->string('dob', 10);
            $table->string('mbl', 20)->nullable();
            $table->string('skl', 255)->nullable();
            $table->string('pic', 30)->nullable();
            $table->foreign('usrid')->references('id')->on('usrreg');
            $table->foreign('sclcd')->references('sclcde')->on('sclreg');
            $table->foreign('cntid')->references('id')->on('usrcnt');
            $table->foreign('dvnid')->references('id')->on('usrdvn');
            $table->foreign('dstid')->references('id')->on('usrdst');
            $table->foreign('thnid')->references('id')->on('usrthn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usrpro');
    }
}
