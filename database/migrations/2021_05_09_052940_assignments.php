<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Assignments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("detail");
            $table->string("tid");
            $table->string('year');
            $table->string("major");
            $table->string("date");
            $table->string("token");
         
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
