<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContingenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contingencies', function (Blueprint $table) {
            $table->increments('id');
            $table->date('anomaly_date');
            $table->date('visit_date');
            $table->string('tracing');
            $table->string('parameter');
            $table->string('ns');
            $table->string('causes_power_outage');
            $table->string('cause_failure');
            $table->string('another_cause');
            $table->string('solve_on_visit'); 
            $table->string('manage_action');

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
        Schema::dropIfExists('contingencies');
    }
}
