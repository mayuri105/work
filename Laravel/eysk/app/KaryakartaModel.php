<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KaryakartaModel extends Model
{
    protected $primaryKey = 'karyakarta_id';

    protected $fillable = ['fk_role_id', 'start_date', 'ysk_id', 'fk_registration_id', 'name_as_per_yuva_sangh_org', 'phone_number_first', 'phone_number_second', 'email', 'city', 'region_name', 'yuva_mandal_name', 'council_name', 'samaj_zone_name', 'division_name', 'karyakarta_email_id', 'password', 'ysk_details', 'end_date', 'deactive_reason', 'status', 'created_by','updated_by'];

    protected $table = 'karyakartas';
}
