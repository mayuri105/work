<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SahyognidhiRequestModel extends Model
{
    protected $primaryKey = 'sahyognidhi_id';

    protected $fillable = ['sahyognidhi_request', 'sahyognidhiError1', 'sahyognidhi_date', 'fk_ysk_id',  'family_id', 'name_as_per_yuvasangh_org', 'region_name', 'council_name', 'samaj_zone_name', 'yuva_mandal_name', 'city_name', 'email', 'aadhar_card_number', 'date_of_birth', 'gender', 'pincode', 'first_phone_number', 'second_phone_number', 'existing_disease', 'other_document_number', 'age', 'cause_of_death', 'death_description', 'disability_date', 'disability_date', 'inform_date', 'informer_name', 'informer_mobile', 'designation', 'description', 'status','for_devangat','courier_id','created_by','updated_by'];

    protected $table = 'sahyognidhi_requests';
}
