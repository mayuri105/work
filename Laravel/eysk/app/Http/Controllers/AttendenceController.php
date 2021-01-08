<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendenceController extends Controller
{
    public function employeeAttendence()
    {
    	return view('admin.attendence');
    }
}
