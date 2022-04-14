<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTranslateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_translate', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('sub_name');
            $table->longText('summary');
            $table->integer('services_id')->unsigned()->index();
            $table->integer('language_id')->unsigned()->index();
            $table->foreign('services_id')->references('id')->on('services')->onDelete('cascade');
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
        Schema::dropIfExists('services_translate');
    }
}
