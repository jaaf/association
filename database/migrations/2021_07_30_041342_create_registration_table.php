<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('firstname',50);
            $table->string('familyname',50);
            $table->string('city',50);
            $table->string('optional1',50)->nullable();
            $table->string('optional2',50)->nullable();
            $table->string('remark',255)->nullable();
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('agent_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registration');
    }
}
