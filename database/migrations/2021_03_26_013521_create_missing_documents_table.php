<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissingDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missing_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('station_id')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->integer('code')->unsigned()->nullable();
            
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missing_documents');
    }
}
