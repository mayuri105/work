<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourierCompanyModel extends Model
{
    protected $primaryKey = 'courier_company_id';

    protected $fillable = ['courier_company_name', 'company_address', 'contact_person_name', 'contact_no', 'default_status', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    protected $table = 'courier_companys';
}
