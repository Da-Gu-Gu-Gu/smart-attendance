<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Student extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('rollno')->unique();
            $table->string('name');
            $table->string('major');
            $table->string('year');
            $table->string('email');
            $table->string('password');
            $table->longtext('img');
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
