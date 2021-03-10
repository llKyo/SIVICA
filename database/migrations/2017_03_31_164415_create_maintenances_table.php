<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->increments('id');
            $table->date('execution_date')->nullable(); //execution
            $table->integer('year_date')->unsigned()->nullable();//execution
            $table->integer('month_date')->unsigned()->nullable();//execution
            $table->integer('day_date')->unsigned()->nullable();//execution

            $table->string('state')->nullable();
            $table->string('check_observation',600)->nullable();
            $table->string('mma_comment',600)->nullable();
            $table->string('company_comment',600)->nullable();
            $table->integer('element_id')->unsigned()->nullable(); //foreing
            $table->integer('station_id')->unsigned()->nullable(); //foreing
            $table->integer('activity_id')->unsigned()->nullable(); //foreing
            $table->integer('user_id')->unsigned()->nullable(); //foreing
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
        Schema::dropIfExists('maintenances');
    }
}
