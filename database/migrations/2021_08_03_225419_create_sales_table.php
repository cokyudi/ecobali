<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->date('sale_date')->nullable();
            $table->float('collected_d_min_1', 8, 2)->nullable();
            $table->float('delivered_to_papermill', 8, 2)->nullable();
            $table->float('weighing_scale_gap_eco', 8, 2)->nullable();
            $table->float('weighing_scale_gap_eco_percent', 8, 2)->nullable();
            $table->string('id_papermill', 50)->nullable();
            $table->float('received_at_papermill', 8, 2)->nullable();
            $table->float('weighing_scale_gap_papermill', 8, 2)->nullable();
            $table->float('weighing_scale_gap_papermill_percent', 8, 2)->nullable();
            $table->float('moisture_content_and_contaminant', 8, 2)->nullable();
            $table->float('moisture_content_and_contaminant_percent', 8, 2)->nullable();
            $table->float('deduction', 8, 2)->nullable();
            $table->float('deduction_percent', 8, 2)->nullable();
            $table->float('total_weight_accepted', 8, 2)->nullable();

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
        Schema::dropIfExists('sales');
    }
}
