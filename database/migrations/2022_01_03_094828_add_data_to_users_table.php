<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataToUsersTable extends Migration
{
   
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('mastername')->nullable();
            $table->string('surname')->nullable();
            $table->string('sex')->nullable();
            $table->integer('age')->nullable();
            $table->string('phone')->nullable();
        });
    }

   
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}