<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegistrationModel;
use App\AllBankEntryDetailsModel;
class UserLedgerAccountController extends Controller
{
    public function userLedgerAccount(Request $request)
    {
    	$id = $request->id;
    	$registrationData = RegistrationModel::where('registration_id',$id)
    				->select('registrations.*',
    					'regions.region_name',
    					'regions.region_code',
    				)
    				->leftJoin('regions','regions.region_id','=','registrations.fk_region_id')
    				->first();

    	$bankEntry = AllBankEntryDetailsModel::where('status','1')->where('fk_registration_id',$id)->where('payment_type','Credit')->groupBy('fk_all_bank_entry_id')->get()->toArray();
    	//dd($bankEntry);
    	foreach ($bankEntry as $key => $value) {
    		$totalAmount[] = $value['amount'];
    	}
    	$getAllBankEntryDetails = AllBankEntryDetailsModel::where('all_bank_entry_details.status','1')->where('all_bank_entry_details.fk_registration_id',$id)
    		->select('all_bank_entry_details.*',
    			'all_bank_entry.payment_date',
    			'all_bank_entry.payment_mode',
    		)
    		->leftJoin('all_bank_entry','all_bank_entry.all_bank_entry_id','=','all_bank_entry_details.fk_all_bank_entry_id')
    		->get()->toArray();
    	return view('admin.user_ledger_account')->with('id',$id)->with('registrationData',$registrationData)->with('getAllBankEntryDetails',$getAllBankEntryDetails)->with('totalAmount',$totalAmount);
    }
}
