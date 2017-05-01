<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresskitDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presskit_data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('section');
            $table->string('icon')->nullable();
            $table->string('label');
            $table->string('value');
            $table->integer('presskit_id');
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
        Schema::dropIfExists('presskit_data');
    }
}
