<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_rating', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->integer("star");
            $table->text("text");
            $table->integer('services_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('services_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('services_rating');
    }
}
