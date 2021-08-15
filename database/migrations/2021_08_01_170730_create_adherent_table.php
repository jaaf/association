<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdherentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('adherents', function (Blueprint $table) {
            $table->id();
            $table->string('firstname',50);
            $table->string('familyname',50);
            $table->string('city',50);
            $table->string('cotisation',25);
            $table->string('registered',25);
            $table->string('email',50)->nullable();
            $table->string('phone',25)->nullable();
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
        Schema::dropIfExists('adherent');
    }
}
