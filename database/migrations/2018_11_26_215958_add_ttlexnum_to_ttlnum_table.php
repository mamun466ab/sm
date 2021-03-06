<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTtlexnumToTtlnumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ttlnum', function (Blueprint $table) {
            $table->unsignedInteger('ttlexnum')->after('ttlnum');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ttlnum', function (Blueprint $table) {
            //
        });
    }
}
