<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOwnerToElementsTable extends Migration
{

    public function up()
    {
        Schema::table('elements', function (Blueprint $table) {
            $table->string('owner',60)->nullable();
        });
    }

    public function down()
    {
        Schema::table('elements', function (Blueprint $table) {

        });
    }
}
