<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('name_id')->unsigned()->nullable();//foreing
            $table->integer('type_id')->unsigned()->nullable();//foreing
            $table->string('brand');
            $table->string('model');
            $table->string('sn');
            $table->string('description');
            $table->string('state');
            $table->string('parameter')->nullable();
            $table->string('check_observation',600)->nullable();
            $table->integer('station_id')->unsigned()->nullable(); //foreing
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
        Schema::dropIfExists('elements');
    }
}
