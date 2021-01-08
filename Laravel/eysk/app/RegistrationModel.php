<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationModel extends Model
{
    protected $primaryKey = 'registration_id';

    protected $fillable = ['processing_id', 'today_date', 'ysk_id', 'pre_ysk_id', 'ysk_date', 'ysk_confirmation_date', 'family_id', 'member', 'name_as_per_yuva_sangh_org', 'hidden_name_as_per_yuva_sangh_org', 'aadhar_card_number', 'aadhar_card_photo', 'other_document_number', 'other_document_photo', 'date_of_birth', 'age', 'gender', 'fk_state_id', 'fk_district_id', 'fk_city_id', 'overseas_state', 'overseas_city','pincode', 'home_address', 'fk_existing_disease', 'ysk_registration_image', 'registration_amount', 'email', 'phone_number_first', 'phone_number_second', 'fk_region_id', 'fk_division_id', 'fk_council_id', 'fk_samaj_zone_id', 'fk_yuva_mandal_id', 'profile_photo', 'ip_address', 'first_time_login', 'account_create_date', 'account_close_date', 'status', 'password', 'transfer_form', 'courier_id', 'courier_for', 'created_by','updated_by'];

    protected $table = 'registrations';
}
