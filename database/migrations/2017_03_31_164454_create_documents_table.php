<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path',250);
            $table->string('label',200);
            $table->integer('code')->unsigned()->nullable();
            $table->string('description',400)->nullable();
            $table->string('mma_comment',600)->nullable();
            $table->string('company_comment',600)->nullable();
            $table->integer('maintenance_id')->unsigned()->nullable(); //foreing
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
        Schema::dropIfExists('documents');
    }
}
