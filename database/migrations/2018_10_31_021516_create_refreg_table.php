<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefregTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refreg', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ref_nme', 100);
            $table->string('ref_usrname', 100);
            $table->string('ref_eml', 150);
            $table->string('ref_adr', 255);
            $table->unsignedInteger('cntid');
            $table->unsignedInteger('dvnid');
            $table->unsignedInteger('dstid');
            $table->unsignedInteger('thnid');
            $table->string('refgnr', 15);
            $table->string('refmbl', 15);
            $table->string('refpsd', 150);
            $table->string('joindt', 10);
            $table->string('pic', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refreg');
    }
}
