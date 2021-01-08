<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegistrationModel;
class UserTransferController extends Controller
{
    public function userTransfer(Request $request)
    {
    	$id = $request->id;
    	$myRegistrationData = RegistrationModel::where('registration_id',$id)->first();
    	$transferRegistrationData = RegistrationModel::where('transfer_form',$id)->first();
    	return view('admin.user_transfer')->with('id',$id)->with('myRegistrationData',$myRegistrationData)->with('transferRegistrationData',$transferRegistrationData);
    }
}
