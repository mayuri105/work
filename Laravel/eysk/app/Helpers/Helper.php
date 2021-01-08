<?php 
namespace App\Helpers;
use Auth;
use Illuminate\Support\Facades\URL;
use File;
use App\RegistrationUploadDocumentModel;
use App\AllBankEntryDetailsModel;
use App\NomineeDetailsModel;
use App\SahyognidhiUploadDocument;
use DB;
class Helper {
		
	public static function GetName($table, $fieldfetch, $colum, $id)
	{
		$name = '';
		$get_detail = $table::select($fieldfetch)->where($colum,'=',$id)->first();
		if($get_detail != ""){
			$name = $get_detail->$fieldfetch;
		}
		return $name;
	}
	
	public static function GetDocumentUpload($id)
	{
	    $test = RegistrationUploadDocumentModel::select(DB::raw('group_concat(DISTINCT upload_registration_documnet_status) as status_doc '))->where('fk_registration_id',$id)->whereIn('upload_registration_documnet_status',['3','1'])->get();
        if(count($test)>0){
            $upload = $test[0]['status_doc'];
        }else{
            $upload = '0';
        }
        
        return $test;
	}
	
	public static function GetAllBankEntry($id)
	{
	    $allBankEntery = AllBankEntryDetailsModel::select('amount')->where('fk_registration_id',$id)->get();
        if(count($allBankEntery)>0){
            $amount = $allBankEntery[0]['amount'];
            //$upload = ;
        }else{
            $amount = '0';
            //$upload = '';
        }
        
        return $amount;
	}
	
	
	public static function GetNomineeDetail($id)
	{
	    $nomineedetails = '';
	    $nomineeDetails = NomineeDetailsModel::select('first_nominee_name','second_nominee_name')->where('fk_registration_id',$id)->get();
        if(count($nomineeDetails)>0){
            $first = $nomineeDetails[0]['first_nominee_name'];
            $second = $nomineeDetails[0]['second_nominee_name'];
            
            if($first == "" || $second == "")
            {
                $nomineedetails = '1';
            }
        }else{
           $nomineedetails = '1';
        }
        
         return $nomineedetails; 
	}
	
	public static function GetDocumentUploadSahyognidhi($id,$upload_document_status)
	{
	    $test = SahyognidhiUploadDocument::where('fk_sahyognidhi_id',$id)->where('upload_document_status','=',$upload_document_status)->get();
        if(count($test)>0){
            $upload_status = '1';
        }else{
            $upload_status = '0';
        }
        
        return $upload_status;
	}
	
	
	
	
	
	
	
	
	
}
