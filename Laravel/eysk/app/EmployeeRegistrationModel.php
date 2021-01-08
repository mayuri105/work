<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeRegistrationModel extends Model
{
    protected $primaryKey = 'employee_registration_id';

    protected $fillable = ['joining_date', 'employee_number', 'employee_password', 'employee_name', 'employee_email', 'employee_first_phone_number', 'employee_second_phone_number', 'employee_address', 'timing_am', 'timing_pm', 'employee_details', 'fk_role_id', 'completion_date', 'status', 'created_by', 'updated_by'];

    protected $table = 'employee_registrations';
}
