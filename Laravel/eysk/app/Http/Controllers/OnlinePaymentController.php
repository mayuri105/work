<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class OnlinePaymentController extends Controller
{
    //
    public function onlinepayment(){

        return view('admin.onlinepayment.onlinepayment');
    }
    public function ccavRequestHandler(Request $request){
        $input = $request->all();
        //$name=$request->merchant_id;
      // print_r($input) ;die;
        return view('admin.onlinepayment.ccavRequestHandler',compact('input'));
    }
    public function ccavResponseHandler(){

        return view('admin.onlinepayment.ccavResponseHandler');
    }
}
