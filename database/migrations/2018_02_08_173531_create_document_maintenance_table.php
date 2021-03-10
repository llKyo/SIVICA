<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentMaintenanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_maintenance', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('maintenance_id');
            $table->integer('document_id');
            $table->date('execution_date')->nullable(); //execution
            $table->string('check_observation',600)->nullable();
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
        Schema::dropIfExists('document_maintenance');
    }
}
