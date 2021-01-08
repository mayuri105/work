<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeePaymentModel extends Model
{
    protected $primaryKey = 'employee_registration_salary_details_id';

    protected $fillable = ['fk_employee_id', 'salary', 'start_date', 'end_date', 'status', 'created_by', 'updated_by'];

    protected $table = 'employee_registration_salary_details';
}
