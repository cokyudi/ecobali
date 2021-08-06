<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PapermillCategory extends Model
{
    use HasFactory;

    protected $fillable = ['papermill_category_name','description','created_by','created_datetime','last_modified_by','last_modified_datetime'];
}
