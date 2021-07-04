<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportIntensitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transport_intensities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('intensity', 200);
            $table->string('description', 200)->nullable();
            $table->string('created_by', 100)->nullable();
            $table->dateTime('created_datetime')->nullable();
            $table->string('last_modified_by', 100)->nullable();
            $table->dateTime('last_modified_datetime')->nullable();
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
        Schema::dropIfExists('transport_intensities');
    }
}
