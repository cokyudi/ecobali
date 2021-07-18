<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryDetail extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','year','target','semester','created_by','created_datetime','last_modified_by','last_modified_datetime'];
}
