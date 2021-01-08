<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AchModel extends Model
{
    protected $primaryKey = 'ach_id';

    protected $fillable = ['fk_ysk_id', 'umrn_number','ach_reject_date','umrn_number_reject', 'fk_region_id', 'fk_yuva_mandal', 'city_name', 'email', 'name_as_per_yuva_sangh_org', 'phone_number', 'apply_date', 'fk_bank_id', 'bank_account_number', 'ifsc_code', 'micr_code', 'ach_limit', 'ach_status', 'status', 'created_by_user', 'created_by','updated_by'];

    protected $table = 'achs';
}
