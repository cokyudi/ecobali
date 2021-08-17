<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Potential extends Model
{
    use HasFactory;

    protected $fillable = ['id_category','potential_low','potential_medium','potential_high','created_by','created_datetime','last_modified_by','last_modified_datetime'];
}
