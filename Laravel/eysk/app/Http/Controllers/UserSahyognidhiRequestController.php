<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SahyognidhiRequestModel;

class UserSahyognidhiRequestController extends Controller
{
    public function userSahyognidhiRequest(Request $request)
    {
    	$id = $request->id;
    	$sahyognidhiRequest = SahyognidhiRequestModel::where('sahyognidhi_requests.status','!=','3')
							->select('sahyognidhi_requests.*',
								'registrations.ysk_id',
							)
							->leftJoin('registrations', 'registrations.ysk_id', '=', 'sahyognidhi_requests.fk_ysk_id')
							->groupBy('sahyognidhi_requests.sahyognidhi_id')
							->orderBy('sahyognidhi_requests.sahyognidhi_id','DESC')
							->get();
    	return view('admin.user_sahyognidhi_request')->with('sahyognidhiRequest',$sahyognidhiRequest)->with('id',$id);
    }
}
