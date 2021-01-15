<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Rollcall extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('rollcalls', function (Blueprint $table) {
            $table->id();
            $table->string('tid');
            $table->string('year');
            $table->string('subject');
            $table->string('major');
            $table->string('time');
            $table->string('lifetime');
            $table->string('token');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
