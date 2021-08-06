<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['sale_date','collected_d_min_1','delivered_to_papermill','weighing_scale_gap_eco','weighing_scale_gap_eco_percent','id_papermill','received_at_papermill','weighing_scale_gap_papermill','weighing_scale_gap_papermill_percent','moisture_content_and_contaminant','moisture_content_and_contaminant_percent','deduction','deduction_percent','total_weight_accepted','created_by','created_datetime','last_modified_by','last_modified_datetime'];

}
