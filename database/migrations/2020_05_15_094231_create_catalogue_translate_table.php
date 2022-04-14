<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogueTranslateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogue_translate', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('catalogue_id')->unsigned()->index();
            $table->foreign('catalogue_id')->references('id')->on('catalogue')->onDelete('cascade');
            $table->integer('language_id')->unsigned()->index();
            $table->foreign('language_id')->references('id')->on('language')->onDelete('cascade');
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
        Schema::dropIfExists('catalogue_translate');
    }
}
