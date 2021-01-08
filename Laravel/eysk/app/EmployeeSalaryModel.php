<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalaryModel extends Model
{
    protected $primaryKey = 'employee_salary_id';

    protected $fillable = ['fk_employee_id', 'start_date', 'end_date', 'today_date', 'employee_name', 'intime', 'outtime', 'total_time', 'over_time', 'total_hours_monthly', 'employee_total_hours_monthly', 'actual_salary', 'current_salary', 'bonus_occasion', 'bonus_amount', 'total_amount', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    protected $table = 'employee_salaries';
}
