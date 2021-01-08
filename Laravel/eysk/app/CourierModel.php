<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourierModel extends Model
{
    protected $primaryKey = 'courier_id';

    protected $fillable = ['courier_status', 'courier_date', 'fk_registration_id', 'name_as_per_yuva_sangh_org', 'phone_number', 'company_name', 'courier_static_id', 'courier_narration', 'status', 'courier_for', 'created_by', 'updated_by'];

    protected $table = 'couriers';
}
