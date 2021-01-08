<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SahyognidhiRequestModel;
class UserDashboardController extends Controller
{
    public function userDashboard(Request $request)
    {
    	$id = $request->id;
    	$devangatMember  = SahyognidhiRequestModel::where('status','!=','3')->where('sahyognidhi_request','Devantage')->get()->toArray();
		//dd($devangatMember);
		if ($devangatMember == []) {
			$totalDevangatMember = '0';
		}
		else{
			$totalDevangatMember = count($devangatMember);
		}
    	return view('admin.user_dashboard')->with('id',$id)->with('totalDevangatMember',$totalDevangatMember);
    }
}
