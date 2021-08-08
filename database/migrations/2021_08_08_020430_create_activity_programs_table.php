<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_programs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('activity_program_name', 100)->unique();
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
        Schema::dropIfExists('activity_programs');
    }
}
