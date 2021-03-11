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
            $table->string('first_visit');
            $table->string('Parameter');
            $table->string('ns');
            $table->string('communication');
            $table->string('cause_failure');
            $table->string('another_cause');
            $table->string('solve_on_visit'); 
            $table->string('manage_action');

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
