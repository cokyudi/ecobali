<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = ['id_program_activity','activity','activity_date','location','id_category','id_district','id_regency','participant_number','created_by','created_datetime','last_modified_by','last_modified_datetime'];

}
