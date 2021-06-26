<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('participant_name', 150);
            $table->string('person_in_charge', 150)->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('email_address', 100)->nullable();
            $table->string('category_id', 10)->nullable();
            $table->string('status_id', 100)->nullable();
            $table->string('intensity', 100)->nullable();
            $table->date('joined_at')->nullable();
            $table->string('notes', 200)->nullable();
            $table->string('address', 200)->nullable();
            $table->string('area', 200)->nullable();
            $table->string('sub_district', 200)->nullable();
            $table->string('district_id', 200)->nullable();
            $table->string('latitude', 200)->nullable();
            $table->string('longitude', 200)->nullable();
            $table->string('source_description', 200)->nullable();
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
        Schema::dropIfExists('participants');
    }
}
