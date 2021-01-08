<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AchModel;
use App\RegistrationModel;
use App\RegionsModel;
use App\CityModel;
use App\BankNameModel;
use App\YuvaMandalNumberModel;
use App\LedgerAccountModel;
use App\CouncilModel;
use App\DivisionModel;
use App\SamajZoneModel;
use App\RegistrationFeesModel;
use Input;
use Session;
use Auth;
use Mail;
use Excel;
use PHPExcel;
use App\Exports\ExportUsers;
use App\Imports\ImportUsers;
use DB;
class AchController extends Controller
{
    public function __construct(){
        $this->middleware('checkLogin');
    }
    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function ACHexcelid($id,$region=0 , $council=0,$startDate =0,$endDate=0,$division=0,$samajzone=0,$yuvamandal=0,$agegroup=0,$gender=0,$status1=0){
                if($startDate == 0){
                    $allSearch[] = '-'; 
                }else{
                    $allSearch[] = $startDate; 
                }
                    /////////////////////////////////////////////////////
                if($endDate == 0){
                    $allSearch[] = '-'; 
                }else{
                    $allSearch[] = $endDate; 
                }
                ///////////////////////////////////////////////////////////
                if($council == 0){
                    $allSearch[] = '-'; 
                }else{
                    $councilData     = CouncilModel::where('council_id',$council)->get();
                    $allSearch[] = $councilData[0]['name']; 
                }
                //////////////////////////////////////////////////////////
                if($samajzone == 0){
                    $allSearch[] = '-'; 
                }else{
                    $samajZonedb       = SamajZoneModel::where('samaj_zone_id',$samajzone)->get();
                    $allSearch[] = $samajZonedb[0]['samaj_zone_name']; 
                }        
                //////////////////////////////////////////////////////////
                if($region == 0){
                    $allSearch[] = '-'; 
                }else{
                    $regionData        = RegionsModel::where('region_id',$region)->get();
                    $allSearch[] = $regionData[0]['region_name']; 
                }
                //////////////////////////////////////////////////////////
                if($division == 0){
                    $allSearch[] = '-'; 
                }else{
                    $divisionData    = DivisionModel::where('division_id',$division)->get();
                    $allSearch[] = $divisionData[0]['division_name']; 
                }
                //////////////////////////////////////////////////////////
                if($yuvamandal == 0){
                    $allSearch[] = '-'; 
                }else{
                    $yuvaMandaldb      = YuvaMandalNumberModel::where('yuva_mandal_number_id',$yuvamandal)->get();
                    $allSearch[] = $yuvaMandaldb[0]['yuva_mandal_number']; 
                }
                /////////////////////////////////////////////////////////// 
                if($agegroup == 0){
                        $allSearch[] = '-'; 
                    }else{
                        $allSearch[] = $agegroup; 
                }      
                ////////////////////////////////////////////////////////////   
                if($gender == 0){
                        $allSearch[] = '-'; 
                    }else{
                        if($gender == 1)
                        {
                            $gendername = 'Male';
                        }else{
                            $gendername =  'Female';
                        }
                        $allSearch[] = $gendername; 
                } 
                //////////////////////////////////////////////////////////

                if($status1 > 0){
                    if($status1 == 1){
                        $ststus1Name = 'User To YSK Office';
                        $allSearch[] = 'User To YSK Office';
                    }
                    if($status1 == 2){
                        $ststus1Name = 'ACH Form Received';
                        $allSearch[] = 'ACH Form Received';
                    }
                    if($status1 == 3){
                        $ststus1Name = 'Sent To Bank/Mail';
                        $allSearch[] = 'Sent To Bank/Mail';
                    }
                    if($status1 == 4){
                        $ststus1Name = 'Confirm UMRN';
                        $allSearch[] = 'Confirm UMRN';
                    }
                    if($status1 == 5){
                        $ststus1Name = 'Reject UMRN';
                        $allSearch[] = 'Reject UMRN';
                    }
                }else{
                    $allSearch[] = '-';
                }
            
                
                /////////////////////////////////////////////////////////                 
                if($agegroup > 0){
                    //dd($agegroup);
                    $agegroup1  = $agegroup;
                    $pieces = explode("-", $agegroup1);
                    //dd ($pieces[0]); 
                    $startAge = $pieces[0];
                    $endAge = $pieces[1];
                }
               // dd($id);
               // $a = date('d-m-Y');
                //dd($a);
                return Excel::download(new ExportUsers($id,'5',$allSearch), 'ACH-'.date('d-m-Y').'.xlsx');
    }
    public function ACHexcelidAll($region=0 , $council=0,$startDate =0,$endDate=0,$division=0,$samajzone=0,$yuvamandal=0,$agegroup=0,$gender=0,$status1=0){

            if($startDate == 0){
                    $allSearch[] = '-'; 
                }else{
                    $allSearch[] = $startDate; 
                }
                    /////////////////////////////////////////////////////
                if($endDate == 0){
                    $allSearch[] = '-'; 
                }else{
                    $allSearch[] = $endDate; 
                }
                ///////////////////////////////////////////////////////////
                if($council == 0){
                    $allSearch[] = '-'; 
                }else{
                    $councilData     = CouncilModel::where('council_id',$council)->get();
                    $allSearch[] = $councilData[0]['name']; 
                }
                //////////////////////////////////////////////////////////
                if($samajzone == 0){
                    $allSearch[] = '-'; 
                }else{
                    $samajZonedb       = SamajZoneModel::where('samaj_zone_id',$samajzone)->get();
                    $allSearch[] = $samajZonedb[0]['samaj_zone_name']; 
                }        
                //////////////////////////////////////////////////////////
                if($region == 0){
                    $allSearch[] = '-'; 
                }else{
                    $regionData        = RegionsModel::where('region_id',$region)->get();
                    $allSearch[] = $regionData[0]['region_name']; 
                }
                //////////////////////////////////////////////////////////
                if($division == 0){
                    $allSearch[] = '-'; 
                }else{
                    $divisionData    = DivisionModel::where('division_id',$division)->get();
                    $allSearch[] = $divisionData[0]['division_name']; 
                }
                //////////////////////////////////////////////////////////
                if($yuvamandal == 0){
                    $allSearch[] = '-'; 
                }else{
                    $yuvaMandaldb      = YuvaMandalNumberModel::where('yuva_mandal_number_id',$yuvamandal)->get();
                    $allSearch[] = $yuvaMandaldb[0]['yuva_mandal_number']; 
                }
                /////////////////////////////////////////////////////////// 
                if($agegroup == 0){
                        $allSearch[] = '-'; 
                    }else{
                        $allSearch[] = $agegroup; 
                }      
                ////////////////////////////////////////////////////////////   
                if($gender == 0){
                        $allSearch[] = '-'; 
                    }else{
                        if($gender == 1)
                        {
                            $gendername = 'Male';
                        }else{
                            $gendername =  'Female';
                        }
                        $allSearch[] = $gendername; 
                } 
                //////////////////////////////////////////////////////////
                 if($status1 > 0){
                    if($status1 == 1){
                        $ststus1Name = 'User To YSK Office';
                        $allSearch[] = 'User To YSK Office';
                    }
                    if($status1 == 2){
                        $ststus1Name = 'ACH Form Received';
                        $allSearch[] = 'ACH Form Received';
                    }
                    if($status1 == 3){
                        $ststus1Name = 'Sent To Bank/Mail';
                        $allSearch[] = 'Sent To Bank/Mail';
                    }
                    if($status1 == 4){
                        $ststus1Name = 'Confirm UMRN';
                        $allSearch[] = 'Confirm UMRN';
                    }
                    if($status1 == 5){
                        $ststus1Name = 'Reject UMRN';
                        $allSearch[] = 'Reject UMRN';
                    }
                }else{
                    $allSearch[] = '-';
                }
                /////////////////////////////////////////////////////////                 
                if($agegroup > 0){
                    //dd($agegroup);
                    $agegroup1  = $agegroup;
                    $pieces = explode("-", $agegroup1);
                    //dd ($pieces[0]); 
                    $startAge = $pieces[0];
                    $endAge = $pieces[1];
                }

                $ach = AchModel::where('achs.status','!=','3')
                ->leftJoin('registrations','registrations.ysk_id','=','achs.fk_ysk_id')
                ->leftJoin('regions','regions.region_id','=','achs.fk_region_id')
                ->leftJoin('yuva_mandal_numbers','yuva_mandal_numbers.yuva_mandal_number_id','=','achs.fk_yuva_mandal')
                ->orderBy('achs.ach_id','DESC')
                ->groupBy('achs.ach_id');
                    if($region>0){
                        $ach->where('registrations.fk_region_id',$region);
                    }
                    if($council>0){
                        $ach->where('registrations.fk_council_id',$council);
                    }
                    if($startDate>0){
                        $startDate1       = date('Y-m-d',strtotime($startDate));
                        $ach->where('apply_date','>=',$startDate1);
                    }
                    if($endDate>0){
                        $endDate1       = date('Y-m-d',strtotime($endDate));
                        $ach->where('apply_date','<=',$endDate1);
                    }
                   if($division>0){
                         $ach->where('registrations.fk_division_id',$division);
                    }
                    if($samajzone>0){
                         $ach->where('registrations.fk_samaj_zone_id',$samajzone) ;
                    }
                    if($yuvamandal>0){
                         $ach->where('registrations.fk_yuva_mandal_id',$yuvamandal);
                    }
                    if($agegroup > 0){
                         $ach->where('registrations.age','>=',$startAge)->where('registrations.age','<=',$endAge);
                    }
                    if($gender > 0){
                        if($gender == 1)
                        {
                            $gendername = 'Male';
                        }else{
                            $gendername =  'Female';
                        }
                        $ach->where('registrations.gender',$gendername);
                        
                    }
                   if($status1 > 0){
                        $ach->where('achs.ach_status',$ststus1Name);
                    }
                    $test = $ach->pluck('achs.ach_id')->toArray();
                   //$ach = $ach->get();
                     $users = implode( ',', $test);
                        // dd($user);
                        //dd($users);
                        $id = $users;
                        //dd($id);
                return Excel::download(new ExportUsers($id,'5',$allSearch), 'ACH-'.date('d-m-Y').'.xlsx');

    }
    public function ach($region=0 , $council=0,$startDate =0,$endDate=0,$division=0,$samajzone=0,$yuvamandal=0,$agegroup=0,$gender=0,$status1=0)
    {   //dd(1);
        Session::forget('region_name');
        Session::forget('division_name');
        Session::forget('samaj_zone_name');
        Session::forget('a');
        $accessData = $this->getArray('ach',Auth::user()->fk_role_id);
        if($agegroup > 0){
            //dd($agegroup);
            $agegroup1  = $agegroup;
            $pieces = explode("-", $agegroup1);
            //dd ($pieces[0]); 
            $startAge = $pieces[0];
            $endAge = $pieces[1];
        }
                if($status1 > 0){
                    if($status1 == 1){
                        $ststus1Name = 'User To YSK Office';
                        $allSearch[] = 'User To YSK Office';
                    }
                    if($status1 == 2){
                        $ststus1Name = 'ACH Form Received';
                        $allSearch[] = 'ACH Form Received';
                    }
                    if($status1 == 3){
                        $ststus1Name = 'Sent To Bank/Mail';
                        $allSearch[] = 'Sent To Bank/Mail';
                    }
                    if($status1 == 4){
                        $ststus1Name = 'Confirm UMRN';
                        $allSearch[] = 'Confirm UMRN';
                    }
                    if($status1 == 5){
                        $ststus1Name = 'Reject UMRN';
                        $allSearch[] = 'Reject UMRN';
                    }
                }else{
                    $allSearch[] = '-';
                }
    	$ach = AchModel::where('achs.status','!=','3')
    			->select('achs.*',
    				//'registrations.name_as_per_yuva_sangh_org',
    				'registrations.family_id',
    				'registrations.ysk_id',
    				'regions.region_name',
    				'regions.region_code',
                    'yuva_mandal_numbers.yuva_mandal_number'
    			)
    			->leftJoin('registrations','registrations.ysk_id','=','achs.fk_ysk_id')
    			->leftJoin('regions','regions.region_id','=','achs.fk_region_id')
                ->leftJoin('yuva_mandal_numbers','yuva_mandal_numbers.yuva_mandal_number_id','=','achs.fk_yuva_mandal')
    			->orderBy('achs.ach_id','DESC')
    			->groupBy('achs.ach_id');
                    if($region>0){
                        $ach->where('registrations.fk_region_id',$region);
                    }
                    if($council>0){
                        $ach->where('registrations.fk_council_id',$council);
                    }
                    if($startDate>0){
                        $startDate1       = date('Y-m-d',strtotime($startDate));
                        $ach->where('apply_date','>=',$startDate1);
                    }
                    if($endDate>0){
                        $endDate1       = date('Y-m-d',strtotime($endDate));
                        $ach->where('apply_date','<=',$endDate1);
                    }
                   if($division>0){
                         $ach->where('registrations.fk_division_id',$division);
                    }
                    if($samajzone>0){
                         $ach->where('registrations.fk_samaj_zone_id',$samajzone) ;
                    }
                    if($yuvamandal>0){
                         $ach->where('registrations.fk_yuva_mandal_id',$yuvamandal);
                    }
                    if($agegroup > 0){
                         $ach->where('registrations.age','>=',$startAge)->where('registrations.age','<=',$endAge);
                    }
                    if($gender > 0){
                        if($gender == 1)
                        {
                            $gendername = 'Male';
                        }else{
                            $gendername =  'Female';
                        }
                        $ach->where('registrations.gender',$gendername);
                        
                    }
                   if($status1 > 0){
                        $ach->where('achs.ach_status',$ststus1Name);
                    }
                   $ach = $ach->get();
    			//->get();
    	$pendingAch = AchModel::where('status','!=','3')->where('umrn_number','')->get()->toArray();
        //	dd($pendingAch);
    	if ($pendingAch == []) {
            $totalPendingAch = '0';
        }
        else{
            $totalPendingAch = count($pendingAch);
        }
        $achDone = AchModel::where('status','1')->where('umrn_number','!=','')->get()->toArray();
        if ($achDone == []) {
            $totalAchDone = '0';
        }
        else{
            $totalAchDone = count($achDone);
        }
        $userToYSKOffice = AchModel::where('status','1')->where('ach_status','User To YSK Office')->get()->toArray();
        if ($userToYSKOffice == []) {
            $totalUserToYSKOffice = '0';
        }
        else{
            $totalUserToYSKOffice = count($userToYSKOffice);
        }
        $sentToBank = AchModel::where('status','1')->where('ach_status','Sent To Bank')->get()->toArray();
        if ($sentToBank == []) {
            $totalSentToBank = '0';
        }
        else{
            $totalSentToBank = count($sentToBank);
        }
        $regionData        = RegionsModel::where('status','1')->get();
            $councilData     = CouncilModel::where('status','1')->get();
            $divisionData    = DivisionModel::where('status','1')->get();
            $samajZone       = SamajZoneModel::where('status','1')->get();
            $yuvaMandal      = YuvaMandalNumberModel::where('status','1')->get();
            $RegistrationFee =  RegistrationFeesModel::orderBy('registration_fees_id','DESC')->take(1)->get();
        if($startDate == 0){
             $startDate = '';
        }
        if($endDate == 0){
             $endDate = '';
        }
    	return view('admin.ach')->with('ach',$ach)->with('totalPendingAch',$totalPendingAch)->with('totalAchDone',$totalAchDone)->with('totalUserToYSKOffice',$totalUserToYSKOffice)->with('totalSentToBank',$totalSentToBank)->with('accessData',$accessData)->with('regionData',$regionData)->with('councilData',$councilData)->with('divisionData',$divisionData)->with('samajZone',$samajZone)->with('yuvaMandal',$yuvaMandal)->with('RegistrationFee',$RegistrationFee)->with(['region' => $region , 'council'=> $council ,'startDate' => $startDate,'endDate' => $endDate ,'division'=> $division,'samajzone' => $samajzone,'yuvamandal'=> $yuvamandal,'agegroup'=> $agegroup,'gender' => $gender,'status1'=> $status1]);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function addAch()
    {
        $accessData = $this->getArray('ach',Auth::user()->fk_role_id);
    	$addAch = AchModel::where('achs.status','1')
    				->select('achs.*',
    					'registrations.ysk_id'
    				)
    				->leftJoin('registrations', 'registrations.ysk_id', '=', 'achs.fk_ysk_id')
    				->groupBy('achs.fk_ysk_id')
    				->get();
    	$yskMemberId = array();
    	foreach ($addAch as $row) {
    		$yskMemberId[] = $row->ysk_id;
    	}
    	$yskMember  = RegistrationModel::where('registrations.status','1')->get();
        $yuvaMandal = YuvaMandalNumberModel::where('status','1')->get();
    	$regionName = RegionsModel::where('status','1')->get();
    	$bankName   = LedgerAccountModel::where('fk_group_id','14')->get();
    	return view('admin.ach_add')->with('yskMember',$yskMember)->with('regionName',$regionName)->with('bankName',$bankName)->with('yuvaMandal',$yuvaMandal)->with('accessData',$accessData);
    }

    /**
     * @author Reshmi Das
     * Date: 
     */
    public function getDataByYskId(Request $request)
    {
        $dataByYskId = RegistrationModel::where('ysk_id',$request->fk_ysk_id)->orWhere('pre_ysk_id',$request->fk_ysk_id)
                        ->select('registrations.*',
                            'regions.region_name',
                            'regions.region_id',
                            'yuva_mandal_numbers.yuva_mandal_number',
                            'yuva_mandal_numbers.yuva_mandal_number_id'
                        )
                        ->leftJoin('regions','regions.region_id','=','registrations.fk_region_id')
                        ->leftJoin('yuva_mandal_numbers','yuva_mandal_numbers.yuva_mandal_number_id','=','registrations.fk_yuva_mandal_id')
                        ->first();
        $response = array("success" => 1,"message" => "","region" => $dataByYskId['region_name'],"regionId" => $dataByYskId['region_id'],"yuva_mandal" => $dataByYskId['yuva_mandal_number'],"yuva_mandal_id" => $dataByYskId['yuva_mandal_number_id'],"city" => $dataByYskId['fk_city_id'],"nameAsPerYskOrg" => $dataByYskId['name_as_per_yuva_sangh_org'],"phone_number" => $dataByYskId['phone_number_first']);
        return json_encode($response);
        exit;
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function saveAch(Request $request)
    {
        //dd(Input::all());
    	$this->validate($request,[
			'fk_ysk_id'                   => 'required',
            'fk_region_id'                => 'required',
            'yuva_mandal_number_id'       => 'required',
            'city_name'                   => 'required',
			'name_as_per_yuva_sangh_org'  => 'required',
            'phone_number'                => 'required',
            'apply_date'                  => 'required',
			'fk_bank_id'                  => 'required',
			'bank_account_number'         => 'required',
			'ifsc_code'                   => 'required',
			'ach_limit'                   => 'required',
		]);
		AchModel::create([
			'fk_ysk_id'           => Input::get('fk_ysk_id'),
            'fk_region_id'        => Input::get('fk_region_id'),
            'fk_yuva_mandal'      => Input::get('yuva_mandal_number_id'),
            'city_name'           => Input::get('city_name'),
            'email'               => Input::filled('email') ? Input::get('email'):'',
			'name_as_per_yuva_sangh_org' => Input::get('name_as_per_yuva_sangh_org'),
            'phone_number'        => Input::get('phone_number'),
            'apply_date'          => date('Y-m-d',strtotime(Input::get('apply_date'))),
			'fk_bank_id'		  => Input::get('fk_bank_id'),
			'bank_account_number' => Input::get('bank_account_number'),
			'ifsc_code'			  => Input::get('ifsc_code'),
			'micr_code'			  => Input::filled('micr_code') ? Input::get('micr_code') : '',
			'ach_limit'		      => Input::get('ach_limit'),
			'created_by'          => Auth::user()->user_id,
		]);
		/*$this->sendSMS(Input::get('phone_number'),Input::get('name_as_per_yuva_sangh_org'),'Team YSK have received your ACH application, Please send your signed form at YSK Office within 5 days.');
	    
	    if(Input::get('email') != ''){
	        $user = Input::get('email');
            $NameAsPerYuvaSangh = strtoupper(Input::get('name_as_per_yuva_sangh_org'));
            Mail::send('emails.welcome3', ['user' => $user, 'NameAsPerYuvaSangh' => $NameAsPerYuvaSangh], function ($m) use ($user,$NameAsPerYuvaSangh) {
                                    //dd($NameAsPerYuvaSangh);
                $m->from('support@eysk.org', 'ACH Registration Successfully');
                $m->to($user, Input::get('name_as_per_yuva_sangh_org'))->subject('ACH Registration Successfully');
            });
	    }*/
	    
	
	
		return redirect()->route('ach')->with('success','Ach Details has been added successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function urmnNumber(Request $request)
    {
        $getPhoneNumber = AchModel::where('ach_id',$request->ach_id)->first();
        if (Input::get('umrn_number') != '') {
            AchModel::where('ach_id',$request->ach_id)->update(array(
                'umrn_number' => Input::get('umrn_number'),
                'ach_status'  => 'Confirm UMRN',
                'status'      => '1',
                'updated_by'  => Auth::user()->user_id,
            ));
            /*$this->sendSMS($getPhoneNumber['phone_number'],'Hello '.$getPhoneNumber['name_as_per_yuva_sangh_org'],'Your YSK ACH Account has been generated successfully.');
            
            if($getPhoneNumber['email'] != ''){
                $user = $getPhoneNumber['email'];
                $NameAsPerYuvaSangh = strtoupper($getPhoneNumber['name_as_per_yuva_sangh_org']);
                Mail::send('emails.welcome4', ['user' => $user, 'NameAsPerYuvaSangh' => $NameAsPerYuvaSangh], function ($m) use ($user,$NameAsPerYuvaSangh) {
                                        //dd($NameAsPerYuvaSangh);
                    $m->from('support@eysk.org', 'UMRN Number Succesfully');
                    $m->to($user, Input::get('name_as_per_yuva_sangh_org'))->subject('UMRN Number Succesfully');
                });
            }*/
            
            return redirect()->route('ach')->with('success','URMN Number has been added successfully');
        }
        else{
            $getData = AchModel::where('ach_id',$request->ach_id)->first();
            if($getData == ''){
                AchModel::where('ach_id',$request->ach_id)->update(array(
                    'umrn_number_reject' => Input::get('umrn_number_reject'),
                    'ach_status'  => 'Reject UMRN',
                    'status'      => '1',
                    'ach_reject_date' => date('Y-m-d'),
                    'updated_by'  => Auth::user()->user_id,
                ));
            }
            else{
                $rejectReason = $getData['umrn_number_reject'];
                $subject = $rejectReason.",".Input::get('umrn_number_reject');
                $multipleRejectDate = $getData['ach_reject_date'].",".date('Y-m-d');
                //dd($multipleRejectDate);
                AchModel::where('ach_id',$request->ach_id)->update(array(
                    'umrn_number_reject' => $subject,
                    'ach_status'  => 'Reject UMRN',
                    'status'      => '1',
                    'ach_reject_date' => $multipleRejectDate,
                    'updated_by'  => Auth::user()->user_id,
                ));
            }
            //$this->sendSMS($getPhoneNumber['phone_number'],$getPhoneNumber['name_as_per_yuva_sangh_org'],'Your YSK ACH Account has been Rejected by Bank. Pls reapply for ACH. If any query contact on 7575898989.');
            
            /*$this->sendSMS($getPhoneNumber['phone_number'],$getPhoneNumber['name_as_per_yuva_sangh_org'],'Your YSK ACH Account has been Rejected by Bank. Pls reapply for ACH. If any query contact on 7575898989.');
            
            if($getPhoneNumber['email'] != ''){
                $user = $getPhoneNumber['email'];
                $NameAsPerYuvaSangh = strtoupper($getPhoneNumber['name_as_per_yuva_sangh_org']);
                Mail::send('emails.welcome5', ['user' => $user, 'NameAsPerYuvaSangh' => $NameAsPerYuvaSangh], function ($m) use ($user,$NameAsPerYuvaSangh) {
                                        //dd($NameAsPerYuvaSangh);
                    $m->from('support@eysk.org', 'UMRN Number Rejected');
                    $m->to($user, Input::get('name_as_per_yuva_sangh_org'))->subject('UMRN Number Rejected');
                });
            }*/
            
            return redirect()->route('ach')->with('success','URMN Number has been rejected successfully');
            
            
        }

    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function editAch(Request $request)
    {
        $accessData = $this->getArray('ach',Auth::user()->fk_role_id);
    	$editAch    = AchModel::where('ach_id',$request->ach_id)->first();
    	$explodeReason = explode(',',$editAch['umrn_number_reject']);
        $explodeDate   = explode(',',$editAch['ach_reject_date']);
    	$yskId      = RegistrationModel::where('ysk_id',$editAch['fk_ysk_id'])->get();
    	$regionName = RegionsModel::where('status','1')->get();
        $yuvaMandalName = YuvaMandalNumberModel::where('status','1')->get();
    	$bankName   = LedgerAccountModel::where('fk_group_id','14')->get();
    	return view('admin.ach_edit')->with('editAch',$editAch)->with('yskId',$yskId)->with('bankName',$bankName)->with('regionName',$regionName)->with('yuvaMandalName',$yuvaMandalName)->with('accessData',$accessData)->with('explodeReason',$explodeReason)->with('explodeDate',$explodeDate);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function updateAch(Request $request)
    {
    	$this->validate($request,[
            'fk_ysk_id'                   => 'required',
            'fk_region_id'                => 'required',
            'yuva_mandal_number_id'       => 'required',
            'city_name'                   => 'required',
            'name_as_per_yuva_sangh_org'  => 'required',
            'phone_number'                => 'required',
            'apply_date'                  => 'required',
            'fk_bank_id'                  => 'required',
            'bank_account_number'         => 'required',
            'ifsc_code'                   => 'required',
            'ach_limit'                   => 'required',
        ]);
		AchModel::where('ach_id',$request->editId)->update(array(
			'fk_ysk_id'           => Input::get('fk_ysk_id'),
            'fk_region_id'        => Input::get('fk_region_id'),
            'fk_yuva_mandal'      => Input::get('yuva_mandal_number_id'),
            'city_name'           => Input::get('city_name'),
            'name_as_per_yuva_sangh_org' => Input::get('name_as_per_yuva_sangh_org'),
            'phone_number'        => Input::get('phone_number'),
            'apply_date'          => date('Y-m-d',strtotime(Input::get('apply_date'))),
            'fk_bank_id'          => Input::get('fk_bank_id'),
            'bank_account_number' => Input::get('bank_account_number'),
            'ifsc_code'           => Input::get('ifsc_code'),
            'micr_code'           => Input::filled('micr_code') ? Input::get('micr_code') : '',
            'ach_limit'           => Input::get('ach_limit'),
            'umrn_number'         => Input::get('umrn_number'),
            'updated_by'          => Auth::user()->user_id,
		));
		return redirect()->route('ach')->with('success','Ach Details has been updated successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function viewAch(Request $request)
    {
        $accessData = $this->getArray('ach',Auth::user()->fk_role_id);
    	$viewAch = AchModel::where('ach_id',$request->ach_id)
    			->select('achs.*',
    				'registrations.name_as_per_yuva_sangh_org',
    				'registrations.ysk_id',
    				'regions.region_name',
    				'regions.region_code',
    				'bank_names.bank_name'
    			)
    			->leftJoin('registrations','registrations.ysk_id','=','achs.fk_ysk_id')
    			->leftJoin('regions','regions.region_id','=','achs.fk_region_id')
    			->leftJoin('bank_names','bank_names.bank_name_id','=','achs.fk_bank_id')
    			->first();
    	return view('admin.ach_view')->with('viewAch',$viewAch)->with('accessData',$accessData);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function deleteAch(Request $request)
    {
    	AchModel::where('ach_id',$request->ach_id)->update(array('status' => '3'));
		return redirect()->route('ach')->with('success','Ach Deatils has been deleted successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function multipleDeleteAch(Request $request)
    {
    	AchModel::whereIn('ach_id',explode(",",$request->ids))->update(array('status' => '3'));
		Session::flash('success', 'Ach deatils has been deleted successfully.');
		return response()->json(['status'=>true,'message'=>"Ach deatils has been deleted successfully."]);
    }

    /**
     * @author Reshmi Das
     * Date: 
     */
    public function changeAchStatus(Request $request)
    {
        AchModel::where('ach_id',$request->ach_id)->update(array('ach_status' => Input::get('ach_status')));
        return redirect()->route('ach')->with('success','Ach Status has been changed successfully');
    }

    /**
     * @author Reshmi Das
     * Date: 
     */
    public function changeMultipleStatus(Request $request)
    {
        AchModel::whereIn('ach_id',explode(",",$request->ids))->update(array('ach_status' => Input::get('same_status')));
        Session::flash('success', 'Ach status has been changed successfully.');
        return response()->json(['status'=>true,'message'=>"Ach status has been changed successfully."]);
    }

}
