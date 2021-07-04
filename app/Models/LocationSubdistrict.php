<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationSubdistrict extends Model
{
    use HasFactory;

    protected $fillable = ['subdistrict_name','description','created_by','created_datetime','last_modified_by','last_modified_datetime'];
}
