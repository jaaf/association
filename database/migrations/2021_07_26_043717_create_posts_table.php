<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
         Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title',255);
            $table->mediumText('abstract');
            $table->longText('body');
            $table->string('category',50)->nullable();
            $table->string('diaporama_dir',255)->nullable();
            $table->dateTime('end_date')->nullable();
            $table->dateTime('beg_date')->nullable();
            $table->unsignedInteger('receive_registration')->nullable();
            $table->unsignedInteger('sticky')->nullable();
            $table->unsignedInteger('author_id');
            $table->mediumText('inscription_directive')->nullable();
            $table->dateTime('close_date')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
