<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeaningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meanings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('word_id')->nullable();
            $table->integer('author_id')->nullable();
            $table->text('meaning_meaning')->nullable();
            $table->integer('meaning_like');
            $table->integer('meaning_dislike');
            $table->boolean('meaning_status')->default(1);
            $table->boolean('meaning_sex')->default(1);
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
        Schema::dropIfExists('meanings');
    }
}
