<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Assignmentanswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
          //
          Schema::create('assignmentanswers', function (Blueprint $table) {
            $table->id();
            $table->string('to'); 
            $table->string('sender'); 
            $table->string('subject'); 
            $table->string('detail'); 
            $table->string('attachment');
            $table->string('date');
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
