<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_program_activity', 50)->nullable();
            $table->string('activity', 300)->nullable();
            $table->date('activity_date')->nullable();
            $table->string('location', 100)->nullable();
            $table->string('id_category', 50)->nullable();
            $table->string('id_district', 50)->nullable();
            $table->string('id_regency', 50)->nullable();
            $table->integer('participant_number')->nullable();
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
        Schema::dropIfExists('activities');
    }
}
