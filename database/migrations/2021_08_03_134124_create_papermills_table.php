<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePapermillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('papermills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('papermill_name', 250);
            $table->string('id_papermill_category', 50)->nullable();
            $table->string('contact_name_1', 250)->nullable();
            $table->string('contact_position_1', 200)->nullable();
            $table->string('contact_phone_1', 50)->nullable();
            $table->string('contact_email_1', 200)->nullable();

            $table->string('address', 400)->nullable();
            $table->string('latitude', 100)->nullable();
            $table->string('langitude', 100)->nullable();
            $table->string('id_area', 50)->nullable();
            $table->string('id_district', 50)->nullable();
            $table->string('id_regency', 50)->nullable();

            $table->string('id_purchase_price', 50)->nullable();

            $table->string('id_payment_method', 50)->nullable();
            $table->string('id_bank', 50)->nullable();
            $table->string('bank_branch', 200)->nullable();
            $table->string('bank_account_number', 200)->nullable();
            $table->string('bank_account_holder_name', 200)->nullable();

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
        Schema::dropIfExists('papermills');
    }
}
