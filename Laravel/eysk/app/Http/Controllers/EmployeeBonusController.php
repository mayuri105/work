<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeBonusController extends Controller
{
    public function employeeBonus()
    {
    	return view('admin.employee_bonus');
    }
}
