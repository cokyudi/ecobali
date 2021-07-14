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
            $table->string('participant_name', 250);
            $table->string('id_category', 50)->nullable();
            $table->string('contact_name_1', 250)->nullable();
            $table->string('contact_position_1', 200)->nullable();
            $table->string('contact_phone_1', 50)->nullable();
            $table->string('contact_email_1', 200)->nullable();
            $table->string('contact_name_2', 250)->nullable();
            $table->string('contact_position_2', 200)->nullable();
            $table->string('contact_phone_2', 50)->nullable();
            $table->string('contact_email_2', 200)->nullable();
            $table->date('joined_date')->nullable();
            $table->string('id_transport_intensity', 50)->nullable();

            $table->string('address', 400)->nullable();
            $table->string('latitude', 100)->nullable();
            $table->string('langitude', 100)->nullable();
            $table->string('service_area', 400)->nullable();
            $table->string('id_area', 50)->nullable();
            $table->string('id_district', 50)->nullable();
            $table->string('id_regency', 50)->nullable();

            $table->string('id_box_resource', 50)->nullable();
            $table->string('resource_description', 400)->nullable();
            $table->string('id_purchase_price', 50)->nullable();

            $table->string('id_payment_method', 50)->nullable();
            $table->string('id_bank', 50)->nullable();
            $table->string('bank_branch', 200)->nullable();
            $table->string('bank_account_number', 200)->nullable();
            $table->string('bank_account_holder_name', 200)->nullable();

            $table->string('notes', 400)->nullable();
            $table->string('url_photo_1', 400)->nullable();
            $table->string('url_photo_2', 400)->nullable();

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
