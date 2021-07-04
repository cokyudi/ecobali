<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationArea extends Model
{
    use HasFactory;

    protected $fillable = ['area_name','description','created_by','created_datetime','last_modified_by','last_modified_datetime'];
}
