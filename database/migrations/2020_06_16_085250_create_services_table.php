<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('sub_name');

            $table->integer('home_1')->default(0);
            $table->integer('home_2')->default(0);

            $table->string('avatar')->default('upload/services/no.png');

            $table->longText('summary');
            $table->longText('images')->nullable();

            $table->string('address')->nullable();
            $table->string('verified')->nullable();
            $table->text('iframe')->nullable();

            $table->integer('language_id')->unsigned()->index();
            $table->foreign('language_id')->references('id')->on('language')->onDelete('cascade');

            $table->integer('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');

            $table->integer('catalogue_id')->unsigned()->index();
            $table->foreign('catalogue_id')->references('id')->on('catalogue')->onDelete('cascade');

            $table->integer('city_id')->unsigned()->index();
            $table->foreign('city_id')->references('id')->on('city')->onDelete('cascade');

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
        Schema::dropIfExists('services');
    }
}
