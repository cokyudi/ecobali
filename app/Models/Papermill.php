<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Papermill extends Model
{
    use HasFactory;

    protected $fillable = ['papermill_name','id_papermill_category','contact_name_1','contact_position_1','contact_phone_1','contact_email_1','address','latitude','langitude','id_area','id_district','id_regency','id_purchase_price','id_payment_method','id_bank','bank_branch','bank_account_number','bank_account_holder_name','created_by','created_datetime','last_modified_by','last_modified_datetime'];

}
