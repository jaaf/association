<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompleteUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::table('users', function (Blueprint $table) {

                $table->enum('role',  ['user', 'writer','photoprovider','manager', 'admin'])->default('user');
                $table->string('familyname')->nullable();
                $table->string('firstname')->nullable();
                $table->string('city')->nullable();
                $table->string('phone')->nullable();
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
