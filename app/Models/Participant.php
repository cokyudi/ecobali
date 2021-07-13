<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = ['participant_name','id_category','contact_name_1','contact_position_1','contact_phone_1','contact_email_1','contact_name_2','contact_position_2','contact_phone_2','contact_email_2','joined_date','id_transport_intensity','address','latitude','langitude','service_area','id_area','id_subdistrict','id_district','id_box_resource','resource_description','id_purchase_price','id_payment_method','id_bank','bank_branch','bank_account_number','bank_account_holder_name','notes','url_photo_1','url_photo_2','created_by','created_datetime','last_modified_by','last_modified_datetime'];

}
