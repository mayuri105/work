<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegistrationModel;
use DB;
use App\User;
use Input;
use App\DiseaseModel;
use App\RegionsModel;
use App\SamajZoneModel;
use App\YuvaMandalNumberModel;
use Session;
use Validator;
use App\SahyognidhiRequestModel;
use DateTime;
use App\RegistrationFeesModel;
use App\CityModel;
use App\NomineeDetailsModel;
use App\CouncilModel;
use App\LedgerAccountModel;
use App\RegistrationPaymentModel;
use App\LockingPeriodModel;
use App\AllBankEntryDetailsModel;
use App\AllBankEntryModel;
use App\RegistrationUploadDocumentModel;
use App\DivisionModel;
use App\AchModel;
use App\RegistrationDonationModel;
use App\RegistrationDevelopmentFundAmount;
use Mail;
use yajra\Datatables\Datatables;
use Excel;
use PHPExcel;
use App\Exports\ExportUsers;
use App\Imports\ImportUsers;
use Auth;
class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkLogin');
    }

    /**
     * @author Reshmi Das
     * Date:
     */

    public function exceltestALLFiledsAdmin($region = 0, $council = 0, $startDate = 0, $endDate = 0, $division = 0, $samajzone = 0, $yuvamandal = 0, $agegroup = 0, $gender = 0, $status1 = 10, $processinid = 0, $yskname = 0, $yskidnew = 0, $yskidnewpre = 0)
    {

        if ($startDate == 0) {
            $allSearch[] = '-';
        } else {
            $allSearch[] = $startDate;
        }
        /////////////////////////////////////////////////////
        if ($endDate == 0) {
            $allSearch[] = '-';
        } else {
            $allSearch[] = $endDate;
        }
        ///////////////////////////////////////////////////////////
        if ($council == 0) {
            $allSearch[] = '-';
        } else {
            $councilData = CouncilModel::where('council_id', $council)->get();
            $allSearch[] = $councilData[0]['name'];
        }
        //////////////////////////////////////////////////////////
        if ($samajzone == 0) {
            $allSearch[] = '-';
        } else {
            $samajZonedb = SamajZoneModel::where('samaj_zone_id', $samajzone)->get();
            $allSearch[] = $samajZonedb[0]['samaj_zone_name'];
        }
        //////////////////////////////////////////////////////////
        if ($region == 0) {
            $allSearch[] = '-';
        } else {
            $regionData = RegionsModel::where('region_id', $region)->get();
            $allSearch[] = $regionData[0]['region_name'];
        }
        //////////////////////////////////////////////////////////
        if ($division == 0) {
            $allSearch[] = '-';
        } else {
            $divisionData = DivisionModel::where('division_id', $division)->get();
            $allSearch[] = $divisionData[0]['division_name'];
        }
        //////////////////////////////////////////////////////////
        if ($yuvamandal == 0) {
            $allSearch[] = '-';
        } else {
            $yuvaMandaldb = YuvaMandalNumberModel::where('yuva_mandal_number_id', $yuvamandal)->get();
            $allSearch[] = $yuvaMandaldb[0]['yuva_mandal_number'];
        }
        ///////////////////////////////////////////////////////////
        if ($agegroup == 0) {
            $allSearch[] = '-';
        } else {
            $allSearch[] = $agegroup;
        }
        ////////////////////////////////////////////////////////////
        if ($gender == 0) {
            $allSearch[] = '-';
        } else {
            if ($gender == 1) {
                $gendername = 'Male';
            } else {
                $gendername = 'Female';
            }
            $allSearch[] = $gendername;
        }
        if ($status1 == 10) {
            $allSearch[] = '-';
        } else {
            if ($status1 == 1) {
                $allSearch[] = 'Active';
            }
            if ($status1 == 0) {
                $allSearch[] = 'Pending';
            }
            if ($status1 == 8) {
                $allSearch[] = 'Transfer';
            }
            if ($status1 == 7) {
                $allSearch[] = 'YSK Mitra';
            }
            if ($status1 == 2) {
                $allSearch[] = 'Deactive';
            }
        }
        /////////////////////////////////////////////////////////
        if ($agegroup > 0) {
            //dd($agegroup);
            $agegroup1 = $agegroup;
            $pieces = explode("-", $agegroup1);
            //dd ($pieces[0]);
            $startAge = $pieces[0];
            $endAge = $pieces[1];
        }
        //  ->select(DB::raw('group_concat(DISTINCT registrations.registration_id) as status_doc '))
        $registration = RegistrationModel::whereNotIn('registrations.status', ['3', '6']);
        if ($region > 0) {

            $registration->where('fk_region_id', $region);
        }
        if ($council > 0) {

            $registration->where('fk_council_id', $council);
        }
        if ($startDate > 0) {
            $startDate1 = date('Y-m-d', strtotime($startDate));
            $registration->where('registrations.today_date', '>=', $startDate1);
        }
        if ($endDate > 0) {
            $endDate1 = date('Y-m-d', strtotime($endDate));
            $registration->where('registrations.today_date', '<=', $endDate1);
        }
        if ($division > 0) {
            $registration->where('registrations.fk_division_id', $division);
        }
        if ($samajzone > 0) {
            $registration->where('registrations.fk_samaj_zone_id', $samajzone);
        }
        if ($yuvamandal > 0) {
            $registration->where('registrations.fk_yuva_mandal_id', $yuvamandal);
        }
        if ($agegroup > 0) {
            $registration->where('registrations.age', '>=', $startAge)->where('registrations.age', '<=', $endAge);
        }
        if ($gender > 0) {
            if ($gender == 1) {
                $gendername = 'Male';
            } else {
                $gendername = 'Female';
            }
            $registration->where('registrations.gender', $gendername);

        }
        if ($status1 != 10) {
            $registration->where('registrations.status', $status1);
        }
        //dd($processinid);
        if (strlen($processinid) > 1) {
            $processinid1 = strval($processinid);

            $registration->where('registrations.processing_id', $processinid1);
        }
        if (strlen($yskname) > 1) {
            $yskname1 = strval($yskname);
            $registration->where('registrations.name_as_per_yuva_sangh_org', $yskname1);
        }
        if ($yskidnew > 0) {
            $registration->where('registrations.ysk_id', $yskidnew);
        }
        if ($yskidnewpre > 0) {
            $registration->where('registrations.pre_ysk_id', $yskidnewpre);
        }
        $test = $registration->pluck('registrations.registration_id')->toArray();
        /*$users = RegistrationModel::select(DB::raw('group_concat(DISTINCT registrations.registration_id) as status_doc '))->whereIn('registration_id', $test)->get();*/
        //dd($test);
        $users = implode(',', $test);
        // dd($user);

        $id = $users;
        return Excel::download(new ExportUsers($id, '6', $allSearch), 'Registeration-' . date('d-m-Y') . '.xlsx');
    }

    public function exceltestFiledsAdmin($id, $region = 0, $council = 0, $startDate = 0, $endDate = 0, $division = 0, $samajzone = 0, $yuvamandal = 0, $agegroup = 0, $gender = 0, $status1 = 10, $processinid = 0, $yskname = 0, $yskidnew = 0, $yskidnewpre = 0)
    {
        //dd('region');
        if ($startDate == 0) {
            $allSearch[] = '-';
        } else {
            $allSearch[] = $startDate;
        }
        /////////////////////////////////////////////////////
        if ($endDate == 0) {
            $allSearch[] = '-';
        } else {
            $allSearch[] = $endDate;
        }
        ///////////////////////////////////////////////////////////
        if ($council == 0) {
            $allSearch[] = '-';
        } else {
            $councilData = CouncilModel::where('council_id', $council)->get();
            $allSearch[] = $councilData[0]['name'];
        }
        //////////////////////////////////////////////////////////
        if ($samajzone == 0) {
            $allSearch[] = '-';
        } else {
            $samajZonedb = SamajZoneModel::where('samaj_zone_id', $samajzone)->get();
            $allSearch[] = $samajZonedb[0]['samaj_zone_name'];
        }
        //////////////////////////////////////////////////////////
        if ($region == 0) {
            $allSearch[] = '-';
        } else {
            $regionData = RegionsModel::where('region_id', $region)->get();
            $allSearch[] = $regionData[0]['region_name'];
        }
        //////////////////////////////////////////////////////////
        if ($division == 0) {
            $allSearch[] = '-';
        } else {
            $divisionData = DivisionModel::where('division_id', $division)->get();
            $allSearch[] = $divisionData[0]['division_name'];
        }
        //////////////////////////////////////////////////////////
        if ($yuvamandal == 0) {
            $allSearch[] = '-';
        } else {
            $yuvaMandaldb = YuvaMandalNumberModel::where('yuva_mandal_number_id', $yuvamandal)->get();
            $allSearch[] = $yuvaMandaldb[0]['yuva_mandal_number'];
        }
        ///////////////////////////////////////////////////////////
        if ($agegroup == 0) {
            $allSearch[] = '-';
        } else {
            $allSearch[] = $agegroup;
        }
        ////////////////////////////////////////////////////////////
        if ($gender == 0) {
            $allSearch[] = '-';
        } else {
            if ($gender == 1) {
                $gendername = 'Male';
            } else {
                $gendername = 'Female';
            }
            $allSearch[] = $gendername;
        }
        if ($status1 == 10) {
            $allSearch[] = '-';
        } else {
            if ($status1 == 1) {
                $allSearch[] = 'Active';
            }
            if ($status1 == 0) {
                $allSearch[] = 'Pending';
            }
            if ($status1 == 8) {
                $allSearch[] = 'Transfer';
            }
            if ($status1 == 7) {
                $allSearch[] = 'YSK Mitra';
            }
            if ($status1 == 2) {
                $allSearch[] = 'Deactive';
            }
        }
        /////////////////////////////////////////////////////////
        return Excel::download(new ExportUsers($id, '6', $allSearch), 'Registeration-' . date('d-m-Y') . '.xlsx');
    }

    public function exceltestALL($region = 0, $council = 0, $startDate = 0, $endDate = 0, $division = 0, $samajzone = 0, $yuvamandal = 0, $agegroup = 0, $gender = 0, $status1 = 10, $processinid = 0, $yskname = 0, $yskidnew = 0, $yskidnewpre = 0)
    {

        if ($startDate == 0) {
            $allSearch[] = '-';
        } else {
            $allSearch[] = $startDate;
        }
        /////////////////////////////////////////////////////
        if ($endDate == 0) {
            $allSearch[] = '-';
        } else {
            $allSearch[] = $endDate;
        }
        ///////////////////////////////////////////////////////////
        if ($council == 0) {
            $allSearch[] = '-';
        } else {
            $councilData = CouncilModel::where('council_id', $council)->get();
            $allSearch[] = $councilData[0]['name'];
        }
        //////////////////////////////////////////////////////////
        if ($samajzone == 0) {
            $allSearch[] = '-';
        } else {
            $samajZonedb = SamajZoneModel::where('samaj_zone_id', $samajzone)->get();
            $allSearch[] = $samajZonedb[0]['samaj_zone_name'];
        }
        //////////////////////////////////////////////////////////
        if ($region == 0) {
            $allSearch[] = '-';
        } else {
            $regionData = RegionsModel::where('region_id', $region)->get();
            $allSearch[] = $regionData[0]['region_name'];
        }
        //////////////////////////////////////////////////////////
        if ($division == 0) {
            $allSearch[] = '-';
        } else {
            $divisionData = DivisionModel::where('division_id', $division)->get();
            $allSearch[] = $divisionData[0]['division_name'];
        }
        //////////////////////////////////////////////////////////
        if ($yuvamandal == 0) {
            $allSearch[] = '-';
        } else {
            $yuvaMandaldb = YuvaMandalNumberModel::where('yuva_mandal_number_id', $yuvamandal)->get();
            $allSearch[] = $yuvaMandaldb[0]['yuva_mandal_number'];
        }
        ///////////////////////////////////////////////////////////
        if ($agegroup == 0) {
            $allSearch[] = '-';
        } else {
            $allSearch[] = $agegroup;
        }
        ////////////////////////////////////////////////////////////
        if ($gender == 0) {
            $allSearch[] = '-';
        } else {
            if ($gender == 1) {
                $gendername = 'Male';
            } else {
                $gendername = 'Female';
            }
            $allSearch[] = $gendername;
        }
        if ($status1 == 10) {
            $allSearch[] = '-';
        } else {
            if ($status1 == 1) {
                $allSearch[] = 'Active';
            }
            if ($status1 == 0) {
                $allSearch[] = 'Pending';
            }
            if ($status1 == 8) {
                $allSearch[] = 'Transfer';
            }
            if ($status1 == 7) {
                $allSearch[] = 'YSK Mitra';
            }
            if ($status1 == 2) {
                $allSearch[] = 'Deactive';
            }
        }
        /////////////////////////////////////////////////////////
        if ($agegroup > 0) {
            //dd($agegroup);
            $agegroup1 = $agegroup;
            $pieces = explode("-", $agegroup1);
            //dd ($pieces[0]);
            $startAge = $pieces[0];
            $endAge = $pieces[1];
        }
        //  ->select(DB::raw('group_concat(DISTINCT registrations.registration_id) as status_doc '))
        $registration = RegistrationModel::whereNotIn('registrations.status', ['3', '6']);
        if ($region > 0) {

            $registration->where('fk_region_id', $region);
        }
        if ($council > 0) {

            $registration->where('fk_council_id', $council);
        }
        if ($startDate > 0) {
            $startDate1 = date('Y-m-d', strtotime($startDate));
            $registration->where('registrations.today_date', '>=', $startDate1);
        }
        if ($endDate > 0) {
            $endDate1 = date('Y-m-d', strtotime($endDate));
            $registration->where('registrations.today_date', '<=', $endDate1);
        }
        if ($division > 0) {
            $registration->where('registrations.fk_division_id', $division);
        }
        if ($samajzone > 0) {
            $registration->where('registrations.fk_samaj_zone_id', $samajzone);
        }
        if ($yuvamandal > 0) {
            $registration->where('registrations.fk_yuva_mandal_id', $yuvamandal);
        }
        if ($agegroup > 0) {
            $registration->where('registrations.age', '>=', $startAge)->where('registrations.age', '<=', $endAge);
        }
        if ($gender > 0) {
            if ($gender == 1) {
                $gendername = 'Male';
            } else {
                $gendername = 'Female';
            }
            $registration->where('registrations.gender', $gendername);

        }
        if ($status1 != 10) {
            $registration->where('registrations.status', $status1);
        }
        //dd($processinid);
        if (strlen($processinid) > 1) {
            $processinid1 = strval($processinid);

            $registration->where('registrations.processing_id', $processinid1);
        }
        if (strlen($yskname) > 1) {
            $yskname1 = strval($yskname);
            $registration->where('registrations.name_as_per_yuva_sangh_org', $yskname1);
        }
        if ($yskidnew > 0) {
            $registration->where('registrations.ysk_id', $yskidnew);
        }
        if ($yskidnewpre > 0) {
            $registration->where('registrations.pre_ysk_id', $yskidnewpre);
        }
        $test = $registration->pluck('registrations.registration_id')->toArray();
        /*$users = RegistrationModel::select(DB::raw('group_concat(DISTINCT registrations.registration_id) as status_doc '))->whereIn('registration_id', $test)->get();*/
        //dd($test);
        $users = implode(',', $test);
        // dd($user);

        $id = $users;
        return Excel::download(new ExportUsers($id, '2', $allSearch), 'Registeration-' . date('d-m-Y') . '.xlsx');
    }

    public function exceltest($id, $region = 0, $council = 0, $startDate = 0, $endDate = 0, $division = 0, $samajzone = 0, $yuvamandal = 0, $agegroup = 0, $gender = 0, $status1 = 10, $processinid = 0, $yskname = 0, $yskidnew = 0, $yskidnewpre = 0)
    {
        //dd('region');
        if ($startDate == 0) {
            $allSearch[] = '-';
        } else {
            $allSearch[] = $startDate;
        }
        /////////////////////////////////////////////////////
        if ($endDate == 0) {
            $allSearch[] = '-';
        } else {
            $allSearch[] = $endDate;
        }
        ///////////////////////////////////////////////////////////
        if ($council == 0) {
            $allSearch[] = '-';
        } else {
            $councilData = CouncilModel::where('council_id', $council)->get();
            $allSearch[] = $councilData[0]['name'];
        }
        //////////////////////////////////////////////////////////
        if ($samajzone == 0) {
            $allSearch[] = '-';
        } else {
            $samajZonedb = SamajZoneModel::where('samaj_zone_id', $samajzone)->get();
            $allSearch[] = $samajZonedb[0]['samaj_zone_name'];
        }
        //////////////////////////////////////////////////////////
        if ($region == 0) {
            $allSearch[] = '-';
        } else {
            $regionData = RegionsModel::where('region_id', $region)->get();
            $allSearch[] = $regionData[0]['region_name'];
        }
        //////////////////////////////////////////////////////////
        if ($division == 0) {
            $allSearch[] = '-';
        } else {
            $divisionData = DivisionModel::where('division_id', $division)->get();
            $allSearch[] = $divisionData[0]['division_name'];
        }
        //////////////////////////////////////////////////////////
        if ($yuvamandal == 0) {
            $allSearch[] = '-';
        } else {
            $yuvaMandaldb = YuvaMandalNumberModel::where('yuva_mandal_number_id', $yuvamandal)->get();
            $allSearch[] = $yuvaMandaldb[0]['yuva_mandal_number'];
        }
        ///////////////////////////////////////////////////////////
        if ($agegroup == 0) {
            $allSearch[] = '-';
        } else {
            $allSearch[] = $agegroup;
        }
        ////////////////////////////////////////////////////////////
        if ($gender == 0) {
            $allSearch[] = '-';
        } else {
            if ($gender == 1) {
                $gendername = 'Male';
            } else {
                $gendername = 'Female';
            }
            $allSearch[] = $gendername;
        }
        if ($status1 == 10) {
            $allSearch[] = '-';
        } else {
            if ($status1 == 1) {
                $allSearch[] = 'Active';
            }
            if ($status1 == 0) {
                $allSearch[] = 'Pending';
            }
            if ($status1 == 8) {
                $allSearch[] = 'Transfer';
            }
            if ($status1 == 7) {
                $allSearch[] = 'YSK Mitra';
            }
            if ($status1 == 2) {
                $allSearch[] = 'Deactive';
            }
        }
        /////////////////////////////////////////////////////////
        return Excel::download(new ExportUsers($id, '2', $allSearch), 'Registeration-' . date('d-m-Y') . '.xlsx');
    }

    public function registration()
    {
        $accessData = $this->getArray('registration', Auth::user()->fk_role_id);
        /*return Excel::create('Productions_Report'.'-'.DATE_FORMAT(NOW() ,'Y-m-d'), function($excel) use ($OrdersproductionsReport) {
                $excel->sheet('mySheet', function($sheet) use ($OrdersproductionsReport){
                    $sheet->fromArray($OrdersproductionsReport,NULL);
                });
            })->export('xls');*/
        Session::forget('region_name');
        Session::forget('division_name');
        Session::forget('samaj_zone_name');
        Session::forget('a');
        $reg = RegistrationModel::orderBy('registration_id', 'asc');
        //dd($reg);

        //dd($registration);
        /*$registration = RegistrationModel::where([['registrations.status','!=','3'],['registrations.status','!=','6'],['registrations.status','!=','7'],['registrations.status','!=','8']])
                        ->select('registrations.*',
                            'regions.region_name',
                            'regions.region_code',
                            'cities.city_name',
                            'all_bank_entry_details.amount',
                            'nominee_details.first_nominee_name',
                            'nominee_details.second_nominee_name',
                            )
                        ->leftJoin('regions','regions.region_id','=','registrations.fk_region_id')
                        ->leftJoin('cities','cities.city_id','=','registrations.fk_city_id')
                        ->leftJoin('all_bank_entry_details','all_bank_entry_details.fk_registration_id','=','registrations.registration_id')
                        ->leftJoin('nominee_details','nominee_details.fk_registration_id','=','registrations.registration_id')
                        ->orderByRaw('LENGTH(ysk_id) asc')
                        ->orderBy('ysk_id','ASC')
                        ->orderByRaw('LENGTH(pre_ysk_id) asc')
                        ->orderBy('pre_ysk_id','ASC')
                        ->groupBy('registrations.registration_id')
                        ->get();*/
        //dd($registration);
        $isProfilePhoto = array();
        //dd(count($registration));
        /*foreach ($registration as $key => $value) {
                $documentDetails = RegistrationUploadDocumentModel::where('fk_registration_id',$value['registration_id'])->groupby('fk_registration_id','upload_registration_documnet_status')->where('status','!=','3')->get()->toArray();

                $i = 0;
                if (count($documentDetails) > 0) {
                    foreach ($documentDetails as $key => $value1) {
                        $documentStatus = $value1['upload_registration_documnet_status'];
                        if ($documentStatus == '1') {
                            $i++;
                        }
                        if ($documentStatus == '3') {
                            $i++;

                        }
                    }
                }
                else{
                    $i = 0;
                }
                $isProfilePhoto[] = $i;
            }*/
        //dd($isProfilePhoto);
        $getProcessingId = RegistrationModel::where('status', '!=', '3')->get()->toArray();
        $getYskId = RegistrationModel::where('ysk_id', '!=', '')->where('created_at', '!=', '')->orderBy('created_at', 'ASC')->get()->toArray();
        $getPreYskId = RegistrationModel::where('pre_ysk_id', '!=', '')->where('created_at', '!=', '')->orderBy('created_at', 'ASC')->get()->toArray();

        $activeUser = RegistrationModel::where('status', '1')->get()->toArray();
        $yskMitra = RegistrationModel::where('status', '7')->get()->toArray();
        if ($getProcessingId == []) {
            $processingId = 0;
        } else {
            for ($i = 0; $i < count($getProcessingId) - 1; $i++) {
                $processingid[] = $getProcessingId[$i]['processing_id'];
            }
            $processingId = count($processingid);
        }
        //dd($processingId);
        if (count($getYskId) == '0') {
            $getYskSerialNo = '00000';
        } else {
            foreach ($getYskId as $key => $value) {
                $getYskSerialNo = $value['ysk_id'];
            }
        }

        if (count($getPreYskId) == '0') {
            $getPreYskSerialNo = '00000';
        } else {
            foreach ($getPreYskId as $key => $value) {
                $getPreYskSerialNo = $value['pre_ysk_id'];
            }
        }


        $getHalfDisability = SahyognidhiRequestModel::where('status', '!=', '3')->where('sahyognidhi_request', 'Half Disability')->get()->toArray();
        if ($getHalfDisability != []) {
            $totalHalfDisiability = count($getHalfDisability);
        } else {
            $totalHalfDisiability = 0;
        }
        $getFullDisability = SahyognidhiRequestModel::where('status', '!=', '3')->where('sahyognidhi_request', 'Full Disability')->get()->toArray();
        if ($getFullDisability != []) {
            $totalFullDisiability = count($getFullDisability);
        } else {
            $totalFullDisiability = 0;
        }
        $getDevatage = SahyognidhiRequestModel::where('status', '!=', '3')->where('sahyognidhi_request', 'Devantage')->get()->toArray();
        if ($getDevatage != []) {
            $totalDivangat = count($getDevatage);
        } else {
            $totalDivangat = 0;
        }
        $deActiveUser = $totalDivangat + $totalFullDisiability + $totalHalfDisiability;

        $todayDate = date('Y-m-d', strtotime('+3 month'));
        $formDate = new DateTime($todayDate);
        $allRegistrationData = RegistrationModel::where('status', '1')->get();
        foreach ($allRegistrationData as $key => $value) {
            $dateOfBirth = new DateTime($value['date_of_birth']);
            $getAge = $dateOfBirth->diff($formDate)->y;
            if ($dateOfBirth->diff($formDate)->y >= 55) {
                $getFiftyFiveYearsData[] = RegistrationModel::where('status', '1')->where('date_of_birth', $dateOfBirth)->get();
            }
        }
        if (count($getFiftyFiveYearsData) == '0') {
            $pendingEntry = '0';
        } else {
            $pendingEntry = count($getFiftyFiveYearsData);
        }
        $regionData = RegionsModel::where('status', '1')->get();
        $councilData = CouncilModel::where('status', '1')->get();
        $divisionData = DivisionModel::where('status', '1')->get();
        $samajZone = SamajZoneModel::where('status', '1')->get();
        $yuvaMandal = YuvaMandalNumberModel::where('status', '1')->get();
        $RegistrationFee = RegistrationFeesModel::orderBy('registration_fees_id', 'DESC')->take(1)->get();
        //dd($RegistrationFee);
        return view('admin.registration')->with('processingId', $processingId)->with('getYskId', $getYskId)->with('deActiveUser', $deActiveUser)->with('getYskSerialNo', $getYskSerialNo)->with('totalHalfDisiability', $totalHalfDisiability)->with('totalFullDisiability', $totalFullDisiability)->with('totalDivangat', $totalDivangat)->with('activeUser', $activeUser)->with('isProfilePhoto', $isProfilePhoto)->with('yskMitra', $yskMitra)->with('pendingEntry', $pendingEntry)->with('regionData', $regionData)->with('councilData', $councilData)->with('divisionData', $divisionData)->with('samajZone', $samajZone)->with('yuvaMandal', $yuvaMandal)->with('RegistrationFee', $RegistrationFee)->with('accessData', $accessData);
    }

    public function registrationTest($region = 0, $council = 0, $startDate = 0, $endDate = 0, $division = 0, $samajzone = 0, $yuvamandal = 0, $agegroup = 0, $gender = 0, $status1 = 10, $processinid = 0, $yskname = 0, $yskidnew = 0, $yskidnewpre = 0)
    {
        //dd($processinid)
        if ($agegroup > 0) {
            //dd($agegroup);
            $agegroup1 = $agegroup;
            $pieces = explode("-", $agegroup1);
            //dd ($pieces[0]);
            $startAge = $pieces[0];
            $endAge = $pieces[1];
        }
        //dd($region);
        /*Session::forget('region_name');
        Session::forget('division_name');
        Session::forget('samaj_zone_name');
        Session::forget('a');
        */
        //dd($startDate);
        //,'7','8'
        $registration = RegistrationModel::whereNotIn('registrations.status', ['3', '6'])
            ->select('registrations.registration_id', 'registrations.status', 'registrations.ysk_id', 'registrations.pre_ysk_id', DB::raw('UPPER(registrations.name_as_per_yuva_sangh_org)as name_as_per_yuva_sangh_org'), 'registrations.processing_id', 'registrations.created_at',
                'regions.region_name',
                'regions.region_code', 'registrations.fk_city_id', 'registrations.phone_number_first', DB::raw('DATE_FORMAT(registrations.today_date,"%d-%m-%Y") as today_date'), DB::raw('DATE_FORMAT(registrations.ysk_date,"%d-%m-%Y") as ysk_date'))
            ->leftJoin('regions', 'regions.region_id', '=', 'registrations.fk_region_id')
            ->orderByRaw('LENGTH(ysk_id) asc')
            ->orderBy('ysk_id', 'ASC')
            ->orderByRaw('LENGTH(pre_ysk_id) asc')
            ->orderBy('pre_ysk_id', 'ASC');
        if ($region > 0) {

            $registration->where('fk_region_id', $region);
        }
        if ($council > 0) {

            $registration->where('fk_council_id', $council);
        }
        if ($startDate > 0) {
            $startDate1 = date('Y-m-d', strtotime($startDate));
            $registration->where('registrations.today_date', '>=', $startDate1);
        }
        if ($endDate > 0) {
            $endDate1 = date('Y-m-d', strtotime($endDate));
            $registration->where('registrations.today_date', '<=', $endDate1);
        }
        if ($division > 0) {
            $registration->where('registrations.fk_division_id', $division);
        }
        if ($samajzone > 0) {
            $registration->where('registrations.fk_samaj_zone_id', $samajzone);
        }
        if ($yuvamandal > 0) {
            $registration->where('registrations.fk_yuva_mandal_id', $yuvamandal);
        }
        if ($agegroup > 0) {
            $registration->where('registrations.age', '>=', $startAge)->where('registrations.age', '<=', $endAge);
        }
        if ($gender > 0) {
            if ($gender == 1) {
                $gendername = 'Male';
            } else {
                $gendername = 'Female';
            }
            $registration->where('registrations.gender', $gendername);

        }
        if ($status1 != 10) {
            $registration->where('registrations.status', $status1);
        }
        //dd($processinid);
        if (strlen($processinid) > 1) {
            $processinid1 = strval($processinid);

            $registration->where('registrations.processing_id', $processinid1);
        }
        if (strlen($yskname) > 1) {
            $yskname1 = strval($yskname);
            $registration->where('registrations.name_as_per_yuva_sangh_org', $yskname1);
        }
        if ($yskidnew > 0) {
            $registration->where('registrations.ysk_id', $yskidnew);
        }
        if ($yskidnewpre > 0) {
            $registration->where('registrations.pre_ysk_id', $yskidnewpre);
        }

        $registration->groupBy('registrations.registration_id');


        //dd($registration);
        return Datatables::of($registration)->make(true);

    }

    public function tooltipStatusAll()
    {
        $id = Input::get('id');
        $test = RegistrationUploadDocumentModel::select(DB::raw('group_concat(DISTINCT upload_registration_documnet_status) as status_doc '))->where('fk_registration_id', Input::get('id'))->whereIn('upload_registration_documnet_status', ['3', '1'])->get();
        if (count($test) > 0) {
            $upload = $test[0]['status_doc'];
            //$upload = ;
        } else {
            $upload = '0';
            //$upload = '';
        }
        $allBankEntery = AllBankEntryDetailsModel::select('amount')->where('fk_registration_id', $id)->get();
        if (count($allBankEntery) > 0) {
            $amount = $allBankEntery[0]['amount'];
            //$upload = ;
        } else {
            $amount = '0';
            //$upload = '';
        }
        // dd($amount);
        $nomineeDetails = NomineeDetailsModel::select('first_nominee_name', 'second_nominee_name')->where('fk_registration_id', $id)->get();
        if (count($nomineeDetails) > 0) {
            $first = $nomineeDetails[0]['first_nominee_name'];
            $second = $nomineeDetails[0]['second_nominee_name'];
            //$upload = ;
        } else {
            $first = '';
            $second = '';
            //$upload = '';
        }
        /*$registration1[]=[
            'today_date' => $value['today_date'],
            'registration_id' => $value['registration_id'],
            'amount' => $amount,
            'first_nominee_name' => $first,
            'second_nominee_name' => $second,
            'ysk_date' =>$value['ysk_date'],
            'ysk_id' =>$value['ysk_id'],
            'pre_ysk_id' =>$value['pre_ysk_id'],
            'name_as_per_yuva_sangh_org' =>$value['name_as_per_yuva_sangh_org'],
            'processing_id' =>$value['processing_id'],
            'region_name' =>$value['region_name'],
            'upload' =>$upload
        ];*/


        /*if($upload == '1,3' || $upload == '3,1'  || $amount == '' || $first == '' || $second == '')
            {
                $html = '0';
            }else*/
        if ($upload == '1' || $upload == '3' || $amount == '' || $first == '' ||
            $second == '') {
            $html = "1";
        } else {
            $html = "0";
        }

        $responseData = array("success" => "1", "html_data" => $html, 'amount' => $amount);
        echo json_encode($responseData);
        exit;
    }

    /**
     * @author Reshmi Das
     * Date:
     */
    public function addRegistration()
    {
        $accessData = $this->getArray('registration', Auth::user()->fk_role_id);
        $existingDisease = DiseaseModel::where('status', '1')->get();
        $regionData = RegionsModel::where('status', '1')->get();
        $councilData = CouncilModel::where('status', '1')->get();
        $divisionData = DivisionModel::where('status', '1')->get();
        $samajZone = SamajZoneModel::where('status', '1')->get();
        $yuvaMandal = YuvaMandalNumberModel::where('status', '1')->get();
        $bankName = LedgerAccountModel::where('fk_group_id', '14')->get();
        $preYskId = RegistrationModel::get();
        return view('admin.registration_add')->with('existing_disease', $existingDisease)->with('regionData', $regionData)->with('bankName', $bankName)->with('samajZone', $samajZone)->with('yuvaMandal', $yuvaMandal)->with('councilData', $councilData)->with('divisionData', $divisionData)->with('accessData', $accessData);
    }


    /**
     * @author Reshmi Das
     * Date:
     */
    public function getSamajZoneByRegionId(Request $request)
    {
        $regionId = Input::get('region_id');
        /////////////////////////////////////samajzone////////////////////////////
        $samajZoneData = SamajZoneModel::where([['status', '=', 1], ['fk_region_id', '=', $regionId]])->get()->toArray();
        $htmlData = '';
        $htmlData .= '<select class="form-control kt-select2" id="samaj_zone_name" name="fk_samaj_zone_id" onchange="getYuvaMandal(this.value)" style="width:100%;">
            <option value="" selected="selected">SELECT SAMAJZONE</option>';
        if (is_array($samajZoneData) && count($samajZoneData) > 0) {
            foreach ($samajZoneData as $key => $valueSamajZone) {
                $htmlData .= '<option value="' . $valueSamajZone['samaj_zone_id'] . '">' . $valueSamajZone['samaj_zone_name'] . '</option>';
            }
        }
        $htmlData .= '</select>';

        ///////////////////////////////////division zone////////////////////////

        $divisionName = DivisionModel::where([['status', '=', 1], ['fk_region_id', '=', $regionId]])->get()->toArray();

        $htmlData1 = '';
        $htmlData1 .= '<select class="form-control kt-select2" id="division_name" name="fk_division_id" style="width:100%;">
                    <option value="" selected="selected">SELECT DIVISION</option>';
        if (is_array($divisionName) && count($divisionName) > 0) {
            foreach ($divisionName as $key => $valueDivision) {
                $htmlData1 .= '<option value="' . $valueDivision['division_id'] . '">' . $valueDivision['division_name'] . '</option>';
            }
        }
        $htmlData1 .= '</select>';
        ///////////////////////////////////////Council Name/////////////////////////
        //$councilData     = CouncilModel::where(['status','=',1],['fk_region_id','=',$regionId])->get();
        /*$a = CouncilModel::where('status','1')->get();
        foreach ($a as $key) {

        }*/
        $htmlCouncilname = '';
        /*$htmlCouncilname .=
            '<select class="form-control kt-select2" id="council_name" name="fk_council_id">
                    <option value="" selected >Select Council</option>';
                    foreach($councilData as $valueCouncilData){
                $htmlCouncilname .='<option value="'.$valueCouncilData->council_id .'">'. strtoupper($valueCouncilData->name).'('.$valueCouncilData->code.' )</option>';
                    }
            $htmlCouncilname .='</select>';*/
        ////////////////////////////////Yuva Mandal Name////////////////////////////
        ///////////////////////////////////////////////////////////////////////////
        $responseData = array("success" => "1", "message" => '', "html_data" => $htmlData, "html_data_division" => $htmlData1);
        echo json_encode($responseData);
        exit;
    }

    /**
     * @author Reshmi Das
     * Date:
     */
    public function getYuvaMandalBySamajZoneId(Request $request)
    {
        $yuvaMandalId = Input::get('fk_yuva_mandal_id');

        $yuvaMandal = YuvaMandalNumberModel::where([['status', '=', 1], ['yuva_mandal_number_id', '=', $yuvaMandalId]])->first()->toArray();
        $samajZone = SamajZoneModel::where([['status', '=', 1], ['samaj_zone_id', '=', $yuvaMandal['fk_samaj_zone_id']]])->first();
        //dd($yuvaMandal);
        $htmlData = '<select class="form-control kt-select2" id="samaj_zone_name" name="fk_samaj_zone_id" style="width:100%;">';
        $htmlData .= '<option value="' . $samajZone['samaj_zone_id'] . '" select>' . $samajZone['samaj_zone_name'] . '</option>';
        $htmlData .= '</select>';
        ///////////////////////////////////division zone////////////////////////

        $divisionName = DivisionModel::where([['status', '=', 1], ['division_name', '=', $yuvaMandal['division_name']]])->first();

        $htmlData1 = '';
        $htmlData1 .= '<select class="form-control kt-select2" id="division_name" name="fk_division_id" style="width:100%;">';

        $htmlData1 .= '<option value="' . $divisionName['division_id'] . '" select>' . $divisionName['division_name'] . '</option>';
        $htmlData1 .= '</select>';
        $responseData = array("success" => "1", "message" => $yuvaMandal, "html_data" => $htmlData, "html_data1" => $htmlData1);
        echo json_encode($responseData);
        exit;
    }

    /**
     * @author Reshmi Das
     * Date:
     */
    public function getDataByFamilyId()
    {
        if (Input::get('family_id')) {
            $FamilyID = Input::get('family_id');
            $APIURL = 'https://www.yuvasangh.org/checklogin.aspx?UserID=yuva&Password=yuva&FamilyID=' . $FamilyID;

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $APIURL,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET"
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            $htmlData = "";
            $jsonData = "";
            if ($err) {
                $response1 = array("success" => 0, "message" => $err, "html_data" => $htmlData, "data" => $jsonData);
            } else {
                $jsonData = json_decode($response, true);
                if ($jsonData == 0) {
                    $response1 = array("success" => 0, "message" => "Please Enter Correct Family Id", "html_data" => $htmlData, "data" => $jsonData);
                } else {

                    $htmlData .= '<option value="" selected="selected">SELECT NAME</option>';
                    foreach ($jsonData["DATA"] as $key => $value) {
                        $htmlData .= '<option value="' . $value["MemberID"] . '">' . $value["Name"] . '</option>';
                    }
                    $response1 = array("success" => 1, "message" => "", "html_data" => $htmlData, "data" => $jsonData);
                }
            }
            return json_encode($response1);
            exit;
        }
    }

    /**
     * @author Reshmi Das
     * Date:
     */
    public function getDataByFirstNomineeFamilyId()
    {
        if (Input::get('first_nominee_family_id')) {
            $FamilyID = Input::get('first_nominee_family_id');
            $APIURL = 'https://www.yuvasangh.org/checklogin.aspx?UserID=yuva&Password=yuva&FamilyID=' . $FamilyID;

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $APIURL,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET"
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            $htmlData = "";
            $jsonData = "";
            if ($err) {
                $response1 = array("success" => 0, "message" => $err, "html_data" => $htmlData, "data" => $jsonData);
            } else {
                $jsonData = json_decode($response, true);
                if ($jsonData == 0) {
                    $response1 = array("success" => 0, "message" => "Please Enter Correct Family Id", "html_data" => $htmlData, "data" => $jsonData);
                } else {

                    $htmlData .= '<option value="" selected="selected">SELECT NOMINEE</option>';
                    foreach ($jsonData["DATA"] as $key => $value) {
                        $htmlData .= '<option value="' . $value["MemberID"] . '">' . $value["Name"] . '</option>';
                    }
                    $response1 = array("success" => 1, "message" => "", "html_data" => $htmlData, "data" => $jsonData);
                }
            }
            return json_encode($response1);
            exit;
        }
    }


    /**
     * @author Reshmi Das
     * Date:
     */
    public function getDataBySecondNomineeFamilyId()
    {
        if (Input::get('second_nominee_family_id')) {
            $FamilyID = Input::get('second_nominee_family_id');
            $APIURL = 'https://www.yuvasangh.org/checklogin.aspx?UserID=yuva&Password=yuva&FamilyID=' . $FamilyID;

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $APIURL,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET"
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            $htmlData = "";
            $jsonData = "";
            if ($err) {
                $response1 = array("success" => 0, "message" => $err, "html_data" => $htmlData, "data" => $jsonData);
            } else {
                $jsonData = json_decode($response, true);
                if ($jsonData == 0) {
                    $response1 = array("success" => 0, "message" => "Please Enter Correct Family Id", "html_data" => $htmlData, "data" => $jsonData);
                } else {

                    $htmlData .= '<option value="" selected="selected">SELECT NOMINEE</option>';
                    foreach ($jsonData["DATA"] as $key => $value) {
                        $htmlData .= '<option value="' . $value["MemberID"] . '">' . $value["Name"] . '</option>';
                    }
                    $response1 = array("success" => 1, "message" => "", "html_data" => $htmlData, "data" => $jsonData);
                }
            }
            return json_encode($response1);
            exit;
        }
    }


    /**
     * @author Reshmi Das
     * Date:
     */
    public function getDataByMemberId()
    {
        $FamilyID = Input::get('family_id');
        $APIURL = 'https://www.yuvasangh.org/checklogin.aspx?UserID=yuva&Password=yuva&FamilyID=' . $FamilyID;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $APIURL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));
        $response = curl_exec($curl);
        //echo $response;exit;
        $err = curl_error($curl);
        curl_close($curl);
        $htmlData = "";
        $jsonData = "";
        $Name = "";
        $RegionId = "";
        $Mobile = "";
        $BirthDate = "";
        $StateId = "";
        $CityId = "";
        $SamajZoneId = "";
        $YuvaMandalId = "";
        $DistrictId = "";
        $Pincode = "";
        $Address = "";
        $Photo = "";
        $MemberID = "";
        $Gender = "";
        $RegCode = "";
        if ($err) {
            //echo "cURL Error #:" . $err;
            $response1 = array("success" => 0, "message" => $err, "html_data" => $htmlData, "data" => $jsonData);
        } else {
            $jsonData = json_decode($response, true);
            //echo $jsonData;exit;
            if ($jsonData == 0) {
                $response1 = array("success" => 0, "message" => "Please enter correct family id", "html_data" => $htmlData, "data" => $jsonData);
            } else {
                $getRegistrationData = RegistrationModel::where('status', '!=', '3')->where('member', Input::get('member'))->first();
                //dd($getRegistrationData);
                if ($getRegistrationData != '') {
                    $response1 = array("success" => 0, "message" => "Member already exist", "nameAsPerYuvaSanghOrg" => $getRegistrationData['name_as_per_yuva_sangh_org'], "processingId" => $getRegistrationData['processing_id'], "data" => $jsonData);
                } else {
                    foreach ($jsonData["DATA"] as $key => $value) {
                        if ($value["MemberID"] == Input::get('member')) {
                            $Name = $value["Name"];
                            $Region = $value["Region"];
                            $Mobile = $value["Mobile"];
                            $BirthDate = str_replace('/', '-', $value["BirthDate"]);
                            $State = $value["State"];
                            $City = $value["City"];
                            /*$SamajZone  = $value["SamajZone"];
                                $YuvaMandal = $value["YuvaMandal"];*/
                            $District = $value["District"];
                            $Pincode = $value["Pincode"];
                            $Address = $value["Address"];
                            $Photo = $value["Photo"];
                            $Gender = $value["Gender"];
                            $RegCode = $value["RegCode"];
                        }
                    }
                    //dd($BirthDate);
                    $region = RegionsModel::where('status', '1')->get();
                    foreach ($region as $key) {
                        if (strtolower($key->region_name) == strtolower($Region)) {
                            $regionId = $key->region_id;
                        }
                    }


                    $html_data = "";
                    $html_registration_fees = "";
                    $from = new DateTime($BirthDate);
                    $today = new DateTime(Input::get('today_date'));
                    $findAge = $from->diff($today)->y;
                    $regDate = date('Y-m-d', strtotime(Input::get('today_date')));
                    $registrationFee = RegistrationFeesModel::where('status', '1')->where('end_date', '=', '0000-00-00')->first();
                    if ($registrationFee['start_date'] == '' || $regDate <= $registrationFee['start_date']) {
                        $registrationFee1 = RegistrationFeesModel::where('status', '1')->where('start_date', '<=', $regDate)->where('end_date', '>=', $regDate)->first();
                    } elseif ($regDate >= $registrationFee['start_date']) {
                        $registrationFee1 = RegistrationFeesModel::where('status', '1')->where('end_date', '=', '0000-00-00')->first();
                    }
                    if ($findAge >= $registrationFee1['start_age1'] && $findAge <= $registrationFee1['end_age1']) {
                        $registrationFeesAmount = $registrationFee1['fees_amount1'];
                    } elseif ($findAge >= $registrationFee1['start_age2'] && $findAge <= $registrationFee1['end_age2']) {
                        $registrationFeesAmount = $registrationFee1['fees_amount2'];
                    } elseif ($findAge >= $registrationFee1['start_age3'] && $findAge <= $registrationFee1['end_age3']) {
                        $registrationFeesAmount = $registrationFee1['fees_amount3'];
                    } elseif ($findAge >= $registrationFee1['start_age4'] && $findAge <= $registrationFee1['end_age4']) {
                        $registrationFeesAmount = $registrationFee1['fees_amount4'];
                    } else {
                        $registrationFeesAmount = '';
                    }

                    $response1 = array("success" => 1, "message" => "", "Name" => $Name, "RegionId" => $regionId, "Mobile" => $Mobile, "BirthDate" => $BirthDate, "StateId" => $State, "CityId" => $City, "DistrictId" => $District, "Pincode" => $Pincode, "Address" => $Address, "Photo" => $Photo, "Gender" => $Gender, "RegCode" => $RegCode, "html_data" => $findAge, "html_registration_fees" => $registrationFeesAmount, "data" => $jsonData);
                }
            }
        }
        return json_encode($response1);
        exit;
    }


    /**
     * @author Reshmi Das
     * Date:
     */
    public function getFirstNomineeData()
    {
        $FamilyID = Input::get('first_nominee_family_id');
        $APIURL = 'https://www.yuvasangh.org/checklogin.aspx?UserID=yuva&Password=yuva&FamilyID=' . $FamilyID;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $APIURL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));
        $response = curl_exec($curl);
        //echo $response;exit;
        $err = curl_error($curl);
        curl_close($curl);
        $htmlData = "";
        $jsonData = "";
        $Name = "";
        if ($err) {
            //echo "cURL Error #:" . $err;
            $response1 = array("success" => 0, "message" => $err, "html_data" => $htmlData, "data" => $jsonData);
        } else {
            $jsonData = json_decode($response, true);
            //echo $jsonData;exit;
            if ($jsonData == 0) {
                $response1 = array("success" => 0, "message" => "Please enter correct family id", "html_data" => $htmlData, "data" => $jsonData);
            } else {

                foreach ($jsonData["DATA"] as $key => $value) {
                    if ($value["MemberID"] == Input::get('first_nominee_member_id')) {
                        $Name = $value["Name"];
                    }
                }
                $MemberID = Input::get('member');
                $firstNomineeId = Input::get('first_nominee_member_id');
                $response1 = array("success" => 1, "message" => "", "Name" => $Name, "MemberID" => $MemberID, "firstNomineeId" => $firstNomineeId, "data" => $jsonData);
            }
        }
        return json_encode($response1);
        exit;
    }

    /**
     * @author Reshmi Das
     * Date:
     */
    public function getSecondNomineeData()
    {
        $FamilyID = Input::get('second_nominee_family_id');
        $APIURL = 'https://www.yuvasangh.org/checklogin.aspx?UserID=yuva&Password=yuva&FamilyID=' . $FamilyID;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $APIURL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));
        $response = curl_exec($curl);
        //echo $response;exit;
        $err = curl_error($curl);
        curl_close($curl);
        $htmlData = "";
        $jsonData = "";
        $Name = "";
        if ($err) {
            //echo "cURL Error #:" . $err;
            $response1 = array("success" => 0, "message" => $err, "html_data" => $htmlData, "data" => $jsonData);
        } else {
            $jsonData = json_decode($response, true);
            //echo $jsonData;exit;
            if ($jsonData == 0) {
                $response1 = array("success" => 0, "message" => "Please enter correct family id", "html_data" => $htmlData, "data" => $jsonData);
            } else {

                foreach ($jsonData["DATA"] as $key => $value) {
                    if ($value["MemberID"] == Input::get('second_nominee_member_id')) {
                        $Name = $value["Name"];
                    }
                }
                $MemberID = Input::get('member');
                $secondNomineeId = Input::get('second_nominee_member_id');
                $response1 = array("success" => 1, "message" => "", "Name" => $Name, "MemberID" => $MemberID, "secondNomineeId" => $secondNomineeId, "data" => $jsonData);
            }
        }
        return json_encode($response1);
        exit;
    }


    /**
     * @author Reshmi Das
     * Date:
     */
    public function findAgeByDateOfBirth()
    {
        $html_data = "";
        $html_registration_fees = "";
        $date_of_birth = Input::get('date_of_birth');
        $from = new DateTime(Input::get('date_of_birth'));
        $today = new DateTime(Input::get('today_date'));
        $findAge = $from->diff($today)->y;

        $regDate = date('Y-m-d', strtotime(Input::get('today_date')));
        $registrationFee = RegistrationFeesModel::where('status', '1')->where('end_date', '=', '0000-00-00')->first();
        if ($registrationFee['start_date'] == '' || $regDate <= $registrationFee['start_date']) {
            $registrationFee1 = RegistrationFeesModel::where('status', '1')->where('start_date', '<=', $regDate)->where('end_date', '>=', $regDate)->first();
        } elseif ($regDate >= $registrationFee['start_date']) {
            $registrationFee1 = RegistrationFeesModel::where('status', '1')->where('end_date', '=', '0000-00-00')->first();
        }
        if ($findAge >= $registrationFee1['start_age1'] && $findAge <= $registrationFee1['end_age1']) {

            $registrationFeesAmount = $registrationFee1['fees_amount1'];
        } elseif ($findAge >= $registrationFee1['start_age2'] && $findAge <= $registrationFee1['end_age2']) {
            $registrationFeesAmount = $registrationFee1['fees_amount2'];
        } elseif ($findAge >= $registrationFee1['start_age3'] && $findAge <= $registrationFee1['end_age3']) {
            $registrationFeesAmount = $registrationFee1['fees_amount3'];
        } elseif ($findAge >= $registrationFee1['start_age4'] && $findAge <= $registrationFee1['end_age4']) {
            $registrationFeesAmount = $registrationFee1['fees_amount4'];
        } else {
            $registrationFeesAmount = '';
        }

        $responseData = array("success" => "1", "html_data" => $findAge, "html_registration_fees" => $registrationFeesAmount);
        echo json_encode($responseData);
        exit;
    }


    /**
     * @author Reshmi Das
     * Date:
     */
    public function saveRegistration(Request $request)
    {
        //dd(date("Y-m-d", strtotime(Input::get('date_of_birth'))));
        $this->validate($request, [
            'family_id' => 'required',
            'member' => 'required|unique:registrations,member,3,status',
            'aadhar_card_number' => 'unique:registrations,aadhar_card_number,3,status',
            'name_as_per_yuva_sangh_org' => 'required',
            'date_of_birth' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'country' => 'required',
            'home_address' => 'required',
            'pincode' => 'required',
            'registration_amount' => 'required',
            'phone_number_first' => 'required|numeric',
            'fk_region_id' => 'required',
            'fk_samaj_zone_id' => 'required',
            'fk_yuva_mandal_id' => 'required',
        ]);

        $getProcessingId = RegistrationModel::get();
        foreach ($getProcessingId as $key => $value) {
            $processingId = $value['processing_id'];
        }
        $expldProcessingId = explode('-', $processingId);
        $autoIncrement = $expldProcessingId[1] + 1;


        $stateValue = "";
        $districtValue = "";
        $cityValue = "";
        $overseaState = "";
        $overseaCity = "";
        $givenCountry = Input::get('country');
        if ($givenCountry == 'India') {
            $this->validate($request, [
                'india_state' => 'required',
                'fk_district_id' => 'required',
                'fk_city_id' => 'required',
            ]);
            $stateValue = strtoupper(Input::get('india_state'));
            $districtValue = strtoupper(Input::get('fk_district_id'));
            $cityValue = strtoupper(Input::get('fk_city_id'));
        } else {
            $this->validate($request, [
                'overseas_state' => 'required',
                'overseas_city' => 'required',
            ]);
            $overseaState = strtoupper(Input::get('overseas_state'));
            $overseaCity = strtoupper(Input::get('overseas_city'));
        }

        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }

        if (Input::get('age') > 18) {
            RegistrationModel::create([
                'processing_id' => $expldProcessingId[0] . '-' . $autoIncrement,
                'today_date' => date('Y-m-d', strtotime(Input::get('today_date'))),
                'ysk_id' => Input::filled('ysk_id') ? Input::get('ysk_id') : '',
                //'pre_ysk_id'          => Input::get('pre_ysk_id'),
                'family_id' => Input::get('family_id'),
                'member' => Input::get('member'),
                'name_as_per_yuva_sangh_org' => Input::get('name_as_per_yuva_sangh_org'),
                'hidden_name_as_per_yuva_sangh_org' => Input::get('hidden_name_as_per_yuva_sangh_org'),
                'aadhar_card_number' => Input::filled('aadhar_card_number') ? Input::get('aadhar_card_number') : '',
                'other_document_number' => Input::filled('other_document_number') ? Input::get('other_document_number') : '',
                'date_of_birth' => date("Y-m-d", strtotime(Input::get('date_of_birth'))),
                'age' => Input::get('age'),
                'gender' => Input::get('gender'),
                'country' => Input::get('country'),
                'fk_state_id' => $stateValue,
                'fk_district_id' => $districtValue,
                'fk_city_id' => $cityValue,
                'overseas_state' => $overseaState,
                'overseas_city' => $overseaCity,
                'home_address' => strtoupper(Input::get('home_address')),
                'fk_existing_disease' => Input::filled('fk_existing_disease') ? implode(',', Input::get('fk_existing_disease')) : '',
                'pincode' => Input::get('pincode'),
                'registration_amount' => Input::get('registration_amount'),
                'email' => Input::filled('email') ? Input::get('email') : '',
                'phone_number_first' => Input::get('phone_number_first'),
                'phone_number_second' => Input::filled('phone_number_second') ? Input::get('phone_number_second') : '',
                'fk_region_id' => Input::get('fk_region_id'),
                'fk_council_id' => Input::filled('fk_council_id') ? Input::get('fk_council_id') : '',
                'fk_division_id' => Input::filled('fk_division_id') ? Input::get('fk_division_id') : '',
                'fk_samaj_zone_id' => Input::get('fk_samaj_zone_id'),
                'fk_yuva_mandal_id' => Input::get('fk_yuva_mandal_id'),
                'password' => implode($pass),
                'created_by' => Auth::user()->user_id,
            ]);

            $getRegistrationId = RegistrationModel::get();
            foreach ($getRegistrationId as $key => $value) {
                $registrationId = $value['registration_id'];
            }

            NomineeDetailsModel::create([
                'fk_registration_id' => $registrationId,
                'first_nominee_family_id' => Input::filled('first_nominee_family_id') ? Input::get('first_nominee_family_id') : '',
                'first_nominee_member_id' => Input::filled('first_nominee_member_id') ? Input::get('first_nominee_member_id') : '',
                'first_nominee_name' => Input::filled('first_nominee_name') ? strtoupper(Input::get('first_nominee_name')) : '',
                'first_nominee_relation' => Input::filled('first_nominee_relation') ? strtoupper(Input::get('first_nominee_relation')) : '',
                'second_nominee_family_id' => Input::filled('second_nominee_family_id') ? Input::get('second_nominee_family_id') : '',
                'second_nominee_member_id' => Input::filled('second_nominee_member_id') ? Input::get('second_nominee_member_id') : '',
                'second_nominee_name' => Input::filled('second_nominee_name') ? strtoupper(Input::get('second_nominee_name')) : '',
                'second_nominee_relation' => Input::filled('second_nominee_relation') ? strtoupper(Input::get('second_nominee_relation')) : '',
            ]);

            RegistrationPaymentModel::create([
                'fk_registration_id' => $registrationId,
                'fk_reg_bank_name' => Input::filled('reg_bank_name') ? Input::get('reg_bank_name') : '',
                'bank_amount' => Input::get('bank_amount'),
                'ysk_member_bank_name' => Input::filled('ysk_member_bank_name') ? strtoupper(Input::get('ysk_member_bank_name')) : '',
                'branch_name' => Input::filled('branch_name') ? strtoupper(Input::get('branch_name')) : '',
                'cheque_number' => Input::filled('cheque_number') ? Input::get('cheque_number') : '',
                'narration' => Input::filled('narration') ? strtoupper(Input::get('narration')) : '',
            ]);

            if ($request->hasfile('photo')) {
                foreach ($request->file('photo') as $file) {
                    $name = strtotime(date("Y-m-d H:i:s")) . $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $file->move('assets/uploads/user_image/', $name);
                    RegistrationUploadDocumentModel::create([
                        'fk_registration_id' => $registrationId,
                        'upload_registration_documnet_status' => '1',
                        'upload_document_extension' => $extension,
                        'upload_registration_document' => $name,
                    ]);
                }
            }

            if ($request->hasfile('yskregistrationimage')) {
                foreach ($request->file('yskregistrationimage') as $file) {
                    $name = strtotime(date("Y-m-d H:i:s")) . $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $file->move('assets/uploads/ysk_registration_image/', $name);
                    RegistrationUploadDocumentModel::create([
                        'fk_registration_id' => $registrationId,
                        'upload_registration_documnet_status' => '2',
                        'upload_document_extension' => $extension,
                        'upload_registration_document' => $name,
                    ]);
                }
            }

            if ($request->hasfile('aadhar_card_photo')) {
                foreach ($request->file('aadhar_card_photo') as $file) {
                    $name = strtotime(date("Y-m-d H:i:s")) . $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $file->move('assets/uploads/aadhar_image/', $name);
                    RegistrationUploadDocumentModel::create([
                        'fk_registration_id' => $registrationId,
                        'upload_registration_documnet_status' => '3',
                        'upload_document_extension' => $extension,
                        'upload_registration_document' => $name,
                    ]);
                }
            }

            if ($request->hasfile('other_document_photo')) {
                foreach ($request->file('other_document_photo') as $file) {
                    $name = strtotime(date("Y-m-d H:i:s")) . $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $file->move('assets/uploads/proof_image/', $name);
                    RegistrationUploadDocumentModel::create([
                        'fk_registration_id' => $registrationId,
                        'upload_registration_documnet_status' => '4',
                        'upload_document_extension' => $extension,
                        'upload_registration_document' => $name,
                    ]);
                }
            }
        } else {
            RegistrationModel::create([
                'processing_id' => $expldProcessingId[0] . '-' . $autoIncrement,
                'today_date' => date('Y-m-d', strtotime(Input::get('today_date'))),
                'ysk_id' => Input::filled('ysk_id') ? Input::get('ysk_id') : '',
                //'pre_ysk_id'          => Input::get('pre_ysk_id'),
                'family_id' => Input::get('family_id'),
                'member' => Input::get('member'),
                'name_as_per_yuva_sangh_org' => strtoupper(Input::get('name_as_per_yuva_sangh_org')),
                'hidden_name_as_per_yuva_sangh_org' => Input::get('hidden_name_as_per_yuva_sangh_org'),
                'aadhar_card_number' => Input::filled('aadhar_card_number') ? Input::get('aadhar_card_number') : '',
                'other_document_number' => Input::filled('other_document_number') ? Input::get('other_document_number') : '',
                'date_of_birth' => date("Y-m-d", strtotime(Input::get('date_of_birth'))),
                'age' => Input::get('age'),
                'gender' => Input::get('gender'),
                'country' => Input::get('country'),
                'fk_state_id' => $stateValue,
                'fk_district_id' => $districtValue,
                'fk_city_id' => $cityValue,
                'overseas_state' => $overseaState,
                'overseas_city' => $overseaCity,
                'home_address' => strtoupper(Input::get('home_address')),
                'fk_existing_disease' => Input::filled('fk_existing_disease') ? implode(',', Input::get('fk_existing_disease')) : '',
                'pincode' => Input::get('pincode'),
                'registration_amount' => Input::get('registration_amount'),
                'email' => Input::filled('email') ? Input::get('email') : '',
                'phone_number_first' => Input::get('phone_number_first'),
                'phone_number_second' => Input::filled('phone_number_second') ? Input::get('phone_number_second') : '',
                'fk_region_id' => Input::get('fk_region_id'),
                'fk_council_id' => Input::filled('fk_council_id') ? Input::get('fk_council_id') : '',
                'fk_division_id' => Input::filled('fk_division_name') ? Input::get('fk_division_name') : '',
                'fk_samaj_zone_id' => Input::get('fk_samaj_zone_id'),
                'fk_yuva_mandal_id' => Input::get('fk_yuva_mandal_id'),
                'status' => '6',
                'password' => implode($pass),
                'created_by' => Auth::user()->user_id,
            ]);
            $getRegistrationId = RegistrationModel::get();
            foreach ($getRegistrationId as $key => $value) {
                $registrationId = $value['registration_id'];
            }

            NomineeDetailsModel::create([
                'fk_registration_id' => $registrationId,
                'first_nominee_family_id' => Input::filled('first_nominee_family_id') ? Input::get('first_nominee_family_id') : '',
                'first_nominee_member_id' => Input::filled('first_nominee_member_id') ? Input::get('first_nominee_member_id') : '',
                'first_nominee_name' => Input::filled('first_nominee_name') ? strtoupper(Input::get('first_nominee_name')) : '',
                'first_nominee_relation' => Input::filled('first_nominee_relation') ? strtoupper(Input::get('first_nominee_relation')) : '',
                'second_nominee_family_id' => Input::filled('second_nominee_family_id') ? Input::get('second_nominee_family_id') : '',
                'second_nominee_member_id' => Input::filled('second_nominee_member_id') ? Input::get('second_nominee_member_id') : '',
                'second_nominee_name' => Input::filled('second_nominee_name') ? strtoupper(Input::get('second_nominee_name')) : '',
                'second_nominee_relation' => Input::filled('second_nominee_relation') ? strtoupper(Input::get('second_nominee_relation')) : '',
                'fk_registration_default_status' => '6',
            ]);

            RegistrationPaymentModel::create([
                'fk_registration_id' => $registrationId,
                'fk_reg_bank_name' => Input::filled('reg_bank_name') ? Input::get('reg_bank_name') : '',
                'bank_amount' => Input::get('bank_amount'),
                'ysk_member_bank_name' => Input::filled('ysk_member_bank_name') ? strtoupper(Input::get('ysk_member_bank_name')) : '',
                'branch_name' => Input::filled('branch_name') ? strtoupper(Input::get('branch_name')) : '',
                'cheque_number' => Input::filled('cheque_number') ? Input::get('cheque_number') : '',
                'narration' => Input::filled('narration') ? strtoupper(Input::get('narration')) : '',
                'registration_payment_status' => '6',
            ]);

            if ($request->hasfile('photo')) {
                foreach ($request->file('photo') as $file) {
                    $name = strtotime(date("Y-m-d H:i:s")) . $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $file->move('assets/uploads/user_image/', $name);
                    RegistrationUploadDocumentModel::create([
                        'fk_registration_id' => $registrationId,
                        'upload_registration_documnet_status' => '1',
                        'upload_document_extension' => $extension,
                        'upload_registration_document' => $name,
                    ]);
                }
            }

            if ($request->hasfile('yskregistrationimage')) {
                foreach ($request->file('yskregistrationimage') as $file) {
                    $name = strtotime(date("Y-m-d H:i:s")) . $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $file->move('assets/uploads/ysk_registration_image/', $name);
                    RegistrationUploadDocumentModel::create([
                        'fk_registration_id' => $registrationId,
                        'upload_registration_documnet_status' => '2',
                        'upload_document_extension' => $extension,
                        'upload_registration_document' => $name,
                    ]);
                }
            }

            if ($request->hasfile('aadhar_card_photo')) {
                foreach ($request->file('aadhar_card_photo') as $file) {
                    $name = strtotime(date("Y-m-d H:i:s")) . $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $file->move('assets/uploads/aadhar_image/', $name);
                    RegistrationUploadDocumentModel::create([
                        'fk_registration_id' => $registrationId,
                        'upload_registration_documnet_status' => '3',
                        'upload_document_extension' => $extension,
                        'upload_registration_document' => $name,
                    ]);
                }
            }

            if ($request->hasfile('other_document_photo')) {
                foreach ($request->file('other_document_photo') as $file) {
                    $name = strtotime(date("Y-m-d H:i:s")) . $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $file->move('assets/uploads/proof_image/', $name);
                    RegistrationUploadDocumentModel::create([
                        'fk_registration_id' => $registrationId,
                        'upload_registration_documnet_status' => '4',
                        'upload_document_extension' => $extension,
                        'upload_registration_document' => $name,
                    ]);
                }
            }
        }

        return redirect()->route('registration')->with('success', 'Registration has been completed successfully');

    }

    /**
     * @author Reshmi Das
     * Date:
     */
    public function editRegistration(Request $request)
    {
        $accessData = $this->getArray('registration', Auth::user()->fk_role_id);
        $regionData = RegionsModel::where('status', '1')->get();
        $bankName = LedgerAccountModel::where('fk_group_id', '14')->get();
        $editRegistration = RegistrationModel::where('registration_id', $request->registration_id)->get();
        $editRegistrationPayment = RegistrationPaymentModel::where('fk_registration_id', $request->registration_id)->where('registration_payment_status', '!=', '3')->first();
        $existingDisease = DiseaseModel::where('status', '1')->get();
        $samajZoneData = DB::table('samaj_zones')->where('status', '1')->get();
        $divisionName = DB::table('divisions')->where('status', '1')->get();
        //dd($divisionName);
        $yuvaMandalData = DB::table('yuva_mandal_numbers')->where('status', '1')->get();
        $councilData = CouncilModel::where('status', '1')->get();
        $nomineeData = NomineeDetailsModel::where('fk_registration_id', $request->registration_id)->where('fk_registration_default_status', '!=', '3')->first();

        $profileDocument = RegistrationUploadDocumentModel::where('fk_registration_id', $request->registration_id)->where('upload_registration_documnet_status', '1')->get();
        $yskImage = RegistrationUploadDocumentModel::where('fk_registration_id', $request->registration_id)->where('upload_registration_documnet_status', '2')->get();
        $aadharDocument = RegistrationUploadDocumentModel::where('fk_registration_id', $request->registration_id)->where('upload_registration_documnet_status', '3')->get();
        $otherDocument = RegistrationUploadDocumentModel::where('fk_registration_id', $request->registration_id)->where('upload_registration_documnet_status', '4')->get();
        return view('admin.registration_edit')->with('existing_disease', $existingDisease)->with('regionData', $regionData)->with('bankName', $bankName)->with('editRegistration', $editRegistration[0])->with('samajZoneData', $samajZoneData)->with('yuvaMandalData', $yuvaMandalData)->with('councilData', $councilData)->with('nomineeData', $nomineeData)->with('editRegistrationPayment', $editRegistrationPayment)->with('divisionName', $divisionName)->with('aadharDocument', $aadharDocument)->with('profileDocument', $profileDocument)->with('yskImage', $yskImage)->with('otherDocument', $otherDocument)->with('accessData', $accessData);
    }

    /**
     * @author Reshmi Das
     * Date:
     */
    public function deleteUploadDocument(Request $request)
    {
        $deleteDocument = RegistrationUploadDocumentModel::where('registration_document_id', $request->id)->delete();
        $responseData = array("success" => "1");
        echo json_encode($responseData);
        exit;
    }

    /**
     * @author Reshmi Das
     * Date:
     */
    public function updateRegistration(Request $request)
    {
        if (Input::get('aadhar_card_number') != '') {
            $this->validate($request, [
                'aadhar_card_number' => 'unique:registrations,aadhar_card_number,' . $request->editId . ',registration_id,status,1|min:12',
            ]);
            $this->validate($request, [
                'aadhar_card_number' => 'unique:registrations,aadhar_card_number,' . $request->editId . ',registration_id,status,0|min:12',
            ]);
        }

        $stateValue = "";
        $districtValue = "";
        $cityValue = "";
        $overseaState = "";
        $overseaCity = "";
        $givenCountry = Input::get('country');
        if ($givenCountry == 'India') {
            $this->validate($request, [
                'india_state' => 'required',
                'fk_district_id' => 'required',
                'fk_city_id' => 'required',
            ]);
            $stateValue = strtoupper(Input::get('india_state'));
            $districtValue = strtoupper(Input::get('fk_district_id'));
            $cityValue = strtoupper(Input::get('fk_city_id'));
        } else {
            $this->validate($request, [
                'overseas_state' => 'required',
                'overseas_city' => 'required',
            ]);
            $overseaState = strtoupper(Input::get('overseas_state'));
            $overseaCity = strtoupper(Input::get('overseas_city'));
        }

        RegistrationModel::where('registration_id', $request->editId)->update(array(
            'family_id' => Input::get('family_id'),
            'ysk_id' => Input::get('ysk_id'),
            'member' => Input::get('member'),
            'name_as_per_yuva_sangh_org' => Input::get('name_as_per_yuva_sangh_org'),
            'aadhar_card_number' => Input::get('aadhar_card_number'),
            'other_document_number' => Input::filled('other_document_number') ? Input::get('other_document_number') : '',
            'date_of_birth' => date("Y-m-d", strtotime(Input::get('date_of_birth'))),
            'age' => Input::get('age'),
            'gender' => Input::get('gender'),
            'country' => Input::get('country'),
            'fk_state_id' => $stateValue,
            'fk_district_id' => $districtValue,
            'fk_city_id' => $cityValue,
            'home_address' => strtoupper(Input::get('home_address')),
            'fk_existing_disease' => Input::filled('fk_existing_disease') ? implode(',', Input::get('fk_existing_disease')) : '',
            'overseas_state' => $overseaState,
            'overseas_city' => $overseaCity,
            'email' => Input::filled('email') ? Input::get('email') : '',
            'pincode' => Input::get('pincode'),
            'registration_amount' => Input::get('registration_amount'),
            'phone_number_first' => Input::get('phone_number_first'),
            'phone_number_second' => Input::filled('phone_number_second') ? Input::get('phone_number_second') : '',
            'fk_region_id' => Input::get('fk_region_id'),
            'fk_council_id' => Input::filled('fk_council_id') ? Input::get('fk_council_id') : '',
            'fk_division_id' => Input::filled('fk_division_id') ? Input::get('fk_division_id') : '',
            'fk_samaj_zone_id' => Input::get('fk_samaj_zone_id'),
            'fk_yuva_mandal_id' => Input::get('fk_yuva_mandal_id'),
        ));
        NomineeDetailsModel::where('fk_registration_id', $request->editId)->update(array(
            'first_nominee_family_id' => Input::get('first_nominee_family_id'),
            'first_nominee_member_id' => Input::get('first_nominee_member_id'),
            'first_nominee_name' => strtoupper(Input::get('first_nominee_name')),
            'first_nominee_relation' => strtoupper(Input::get('first_nominee_relation')),
            'second_nominee_family_id' => Input::get('second_nominee_family_id'),
            'second_nominee_member_id' => Input::get('second_nominee_member_id'),
            'second_nominee_name' => strtoupper(Input::get('second_nominee_name')),
            'second_nominee_relation' => strtoupper(Input::get('second_nominee_relation')),
        ));

        RegistrationPaymentModel::where('fk_registration_id', $request->editId)->update(array(
            'fk_reg_bank_name' => Input::filled('reg_bank_name') ? Input::get('reg_bank_name') : '',
            'bank_amount' => Input::get('bank_amount'),
            'ysk_member_bank_name' => Input::filled('ysk_member_bank_name') ? strtoupper(Input::get('ysk_member_bank_name')) : '',
            'branch_name' => Input::filled('branch_name') ? strtoupper(Input::get('branch_name')) : '',
            'cheque_number' => Input::filled('cheque_number') ? Input::get('cheque_number') : '',
            'narration' => Input::filled('narration') ? strtoupper(Input::get('narration')) : '',
        ));

        if ($request->hasfile('photo')) {
            foreach ($request->file('photo') as $file) {
                $name = strtotime(date("Y-m-d H:i:s")) . $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $file->move('assets/uploads/user_image/', $name);
                RegistrationUploadDocumentModel::create([
                    'fk_registration_id' => $request->editId,
                    'upload_registration_documnet_status' => '1',
                    'upload_document_extension' => $extension,
                    'upload_registration_document' => $name,
                ]);
            }
        }

        if ($request->hasfile('aadhar_card_photo')) {
            foreach ($request->file('aadhar_card_photo') as $file) {
                $name = strtotime(date("Y-m-d H:i:s")) . $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $file->move('assets/uploads/aadhar_image/', $name);
                RegistrationUploadDocumentModel::create([
                    'fk_registration_id' => $request->editId,
                    'upload_registration_documnet_status' => '3',
                    'upload_document_extension' => $extension,
                    'upload_registration_document' => $name,
                ]);
            }
        }

        if ($request->hasfile('ysk_registration_image')) {
            foreach ($request->file('ysk_registration_image') as $file) {
                $name = strtotime(date("Y-m-d H:i:s")) . $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $file->move('assets/uploads/ysk_registration_image/', $name);
                RegistrationUploadDocumentModel::create([
                    'fk_registration_id' => $request->editId,
                    'upload_registration_documnet_status' => '2',
                    'upload_document_extension' => $extension,
                    'upload_registration_document' => $name,
                ]);
            }
        }

        if ($request->hasfile('other_document_photo')) {
            foreach ($request->file('other_document_photo') as $file) {
                $name = strtotime(date("Y-m-d H:i:s")) . $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $file->move('assets/uploads/proof_image/', $name);
                RegistrationUploadDocumentModel::create([
                    'fk_registration_id' => $request->editId,
                    'upload_registration_documnet_status' => '4',
                    'upload_document_extension' => $extension,
                    'upload_registration_document' => $name,
                ]);
            }
        }

        $regDate = date('Y-m-d');
        $registrationDate = RegistrationModel::where('status', '!=', '3')->where('registration_id', $request->editId)->first();
        $allBankEntry = AllBankEntryDetailsModel::where('status', '1')->where('fk_registration_id', $request->editId)->first();
        $nomineeData = NomineeDetailsModel::where('fk_registration_id', $request->editId)->first();
        $regData = RegistrationModel::orderBy('pre_ysk_id', 'ASC')->get();
        foreach ($regData as $key => $value) {
            $preYsk = $value['pre_ysk_id'];
        }
        $profilePhoto = RegistrationUploadDocumentModel::where('fk_registration_id', $request->editId)->where('upload_registration_documnet_status', '1')->first();
        $aadharPhoto = RegistrationUploadDocumentModel::where('fk_registration_id', $request->editId)->where('upload_registration_documnet_status', '3')->first();

        if ($registrationDate['status'] == '6' && $registrationDate['ysk_date'] == '0000-00-00') {
            if ($registrationDate['family_id'] != '' && $registrationDate['member'] != '' && $registrationDate['name_as_per_yuva_sangh_org'] != '' && $aadharPhoto != '' && $registrationDate['date_of_birth'] != '' && $registrationDate['age'] != '' && $registrationDate['gender'] != '' && $registrationDate['country'] != '' && (($registrationDate['fk_state_id'] != '' && $registrationDate['fk_district_id'] != '' && $registrationDate['fk_city_id'] != '') || ($registrationDate['overseas_state'] != '' && $registrationDate['overseas_city'] != '')) && $registrationDate['pincode'] != '' && $registrationDate['home_address'] != '' && $registrationDate['registration_amount'] != '' && $registrationDate['phone_number_first'] != '' && $registrationDate['fk_region_id'] != '' && $registrationDate['fk_samaj_zone_id'] != '' && $registrationDate['fk_yuva_mandal_id'] != '' && $profilePhoto != '' && $registrationDate['aadhar_card_number'] != '' && $allBankEntry['amount'] != '' && $nomineeData['first_nominee_name'] != '' && $nomineeData['second_nominee_name'] != '') {
                RegistrationModel::where('registration_id', $request->editId)->update(array(
                    'ysk_date' => $regDate
                ));
            }
            return redirect()->route('minor-account')->with('success', 'Minor Account data has been updated successfully');
        } else {
            if ($registrationDate['ysk_confirmation_date'] == '0000-00-00' && $registrationDate['ysk_date'] == '0000-00-00' && $registrationDate['status'] != '6') {
                if ($registrationDate['family_id'] != '' && $registrationDate['member'] != '' && $registrationDate['name_as_per_yuva_sangh_org'] != '' && $aadharPhoto != '' && $registrationDate['date_of_birth'] != '' && $registrationDate['age'] != '' && $registrationDate['gender'] != '' && $registrationDate['country'] != '' && (($registrationDate['fk_state_id'] != '' && $registrationDate['fk_district_id'] != '' && $registrationDate['fk_city_id'] != '') || ($registrationDate['overseas_state'] != '' && $registrationDate['overseas_city'] != '')) && $registrationDate['pincode'] != '' && $registrationDate['home_address'] != '' && $registrationDate['registration_amount'] != '' && $registrationDate['phone_number_first'] != '' && $registrationDate['fk_region_id'] != '' && $registrationDate['fk_samaj_zone_id'] != '' && $registrationDate['fk_yuva_mandal_id'] != '' && $profilePhoto != '' && $registrationDate['aadhar_card_number'] != '' && $allBankEntry['amount'] != '' && $nomineeData['first_nominee_name'] != '' && $nomineeData['second_nominee_name'] != '') {
                    $lockingendDate = LockingPeriodModel::where('status', '1')->where('end_date', '=', '0000-00-00')->get();
                    if ($regDate >= $lockingendDate[0]['start_date']) {
                        $lockingPeriodData = LockingPeriodModel::where('status', '1')->where('end_date', '=', '0000-00-00')->first();
                    } else {
                        $lockingPeriodData = LockingPeriodModel::where('status', '1')->where('start_date', '<=', $regDate)->where('end_date', '>=', $regDate)->first();
                    }
                    if ($registrationDate['fk_existing_disease'] == '') {
                        $lockingPeriodDays = date('Y-m-d', strtotime($regDate . '+ ' . $lockingPeriodData['locking_days'] . 'days'));
                    } else {
                        $lockingPeriodDays = date('Y-m-d', strtotime($regDate . '+ ' . $lockingPeriodData['disease_days'] . 'days'));;
                    }
                    if ($registrationDate['ysk_id'] == '') {
                        RegistrationModel::where('registration_id', $request->editId)->update(array(
                            'ysk_date' => $regDate,
                            'ysk_confirmation_date' => $lockingPeriodDays,
                            'pre_ysk_id' => $preYsk + 1,
                            'status' => '1',
                        ));
                        NomineeDetailsModel::where('fk_registration_id', $request->editId)->update(array(
                            'fk_registration_default_status' => '1',
                        ));
                        RegistrationPaymentModel::where('fk_registration_id', $request->editId)->update(array(
                            'registration_payment_status' => '1',
                        ));
                        $getRegistrationDevelopmentFund = RegistrationDonationModel::where('status', '1')->where('start_date', '<=', $registrationDate['today_date'])->where('end_date', '>=', $registrationDate['today_date'])->get()->toArray();
                        if ($getRegistrationDevelopmentFund == []) {
                            $getRegistrationDevelopmentFund = RegistrationDonationModel::where('status', '1')->where('end_date', '0000-00-00')->get()->toArray();
                        }
                        $totalDevelopmentFundAmount = $getRegistrationDevelopmentFund[0]['region_registration_amount'] + $getRegistrationDevelopmentFund[0]['yuva_mandal_registration_amount'];
                        for ($i = 2009; $i <= date('Y'); $i++) {
                            $startDay = 1;
                            $startMonth = 4;
                            $startDate = strftime("%F", strtotime($i . "-" . $startMonth . "-" . $startDay));
                            $futureDate = date('Y-m-d', strtotime('+364 day', strtotime($startDate)));
                            if ($registrationDate['today_date'] >= $startDate && $registrationDate['today_date'] <= $futureDate) {
                                $startYear = $startDate;
                                $endYear = $futureDate;
                            }
                        }
                        $getSameYearData = RegistrationDevelopmentFundAmount::where('start_year', $startYear)->where('end_year', $endYear)->get();
                        if (count($getSameYearData) == 0) {
                            $y = RegistrationDevelopmentFundAmount::create([
                                'start_year' => $startYear,
                                'end_year' => $endYear,
                                'total_amount' => $totalDevelopmentFundAmount,
                                'region_development_amount' => $getRegistrationDevelopmentFund[0]['region_registration_amount'],
                                'yuva_mandal_development_amount' => $getRegistrationDevelopmentFund[0]['yuva_mandal_registration_amount'],
                            ]);
                        } else {
                            $getAmount = RegistrationDevelopmentFundAmount::where('start_year', $startYear)->where('end_year', $endYear)->first();
                            $y = RegistrationDevelopmentFundAmount::where('start_year', $startYear)->where('end_year', $endYear)->update(array(
                                'start_year' => $startYear,
                                'end_year' => $endYear,
                                'total_amount' => $getAmount['total_amount'] + $totalDevelopmentFundAmount,
                                'region_development_amount' => $getRegistrationDevelopmentFund[0]['region_registration_amount'],
                                'yuva_mandal_development_amount' => $getRegistrationDevelopmentFund[0]['yuva_mandal_registration_amount'],
                            ));
                        }
                    } elseif ($registrationDate['ysk_id'] != '') {
                        RegistrationModel::where('registration_id', $request->editId)->update(array(
                            'ysk_date' => $regDate,
                            'ysk_confirmation_date' => $lockingPeriodDays,
                            'status' => '1',
                        ));
                        NomineeDetailsModel::where('fk_registration_id', $request->editId)->update(array(
                            'fk_registration_default_status' => '1',
                        ));
                        RegistrationPaymentModel::where('fk_registration_id', $request->editId)->update(array(
                            'registration_payment_status' => '1',
                        ));

                        $getRegistrationDevelopmentFund = RegistrationDonationModel::where('status', '1')->where('start_date', '<=', $registrationDate['today_date'])->where('end_date', '>=', $registrationDate['today_date'])->get()->toArray();
                        if ($getRegistrationDevelopmentFund == []) {
                            $getRegistrationDevelopmentFund = RegistrationDonationModel::where('status', '1')->where('end_date', '0000-00-00')->get()->toArray();
                        }
                        $totalDevelopmentFundAmount = $getRegistrationDevelopmentFund[0]['region_registration_amount'] + $getRegistrationDevelopmentFund[0]['yuva_mandal_registration_amount'];
                        for ($i = 2009; $i <= date('Y'); $i++) {
                            $startDay = 1;
                            $startMonth = 4;
                            $startDate = strftime("%F", strtotime($i . "-" . $startMonth . "-" . $startDay));
                            $futureDate = date('Y-m-d', strtotime('+364 day', strtotime($startDate)));
                            if ($registrationDate['today_date'] >= $startDate && $registrationDate['today_date'] <= $futureDate) {
                                $startYear = $startDate;
                                $endYear = $futureDate;
                            }
                        }
                        $getSameYearData = RegistrationDevelopmentFundAmount::where('start_year', $startYear)->where('end_year', $endYear)->get();
                        if (count($getSameYearData) == 0) {
                            $y = RegistrationDevelopmentFundAmount::create([
                                'start_year' => $startYear,
                                'end_year' => $endYear,
                                'total_amount' => $totalDevelopmentFundAmount,
                                'region_development_amount' => $getRegistrationDevelopmentFund[0]['region_registration_amount'],
                                'yuva_mandal_development_amount' => $getRegistrationDevelopmentFund[0]['yuva_mandal_registration_amount'],
                            ]);
                        } else {
                            $getAmount = RegistrationDevelopmentFundAmount::where('start_year', $startYear)->where('end_year', $endYear)->first();
                            $y = RegistrationDevelopmentFundAmount::where('start_year', $startYear)->where('end_year', $endYear)->update(array(
                                'start_year' => $startYear,
                                'end_year' => $endYear,
                                'total_amount' => $getAmount['total_amount'] + $totalDevelopmentFundAmount,
                                'region_development_amount' => $getRegistrationDevelopmentFund[0]['region_registration_amount'],
                                'yuva_mandal_development_amount' => $getRegistrationDevelopmentFund[0]['yuva_mandal_registration_amount'],
                            ));
                        }
                    }

                }
            }
            return redirect()->route('registration')->with('success', 'Registration has been updated successfully');
        }
    }

    /**
     * @author Reshmi Das
     * Date:
     */
    public function deleteRegistration(Request $request)
    {
        RegistrationModel::where('registration_id', $request->registration_id)->update(array('status' => '3'));
        NomineeDetailsModel::where('fk_registration_id', $request->registration_id)->update(array('fk_registration_default_status' => '3'));
        RegistrationPaymentModel::where('fk_registration_id', $request->registration_id)->update(array('registration_payment_status' => '3'));
        return redirect()->route('registration')->with('success', 'Registration has been deleted successfully');
    }

    /**
     * @author Reshmi Das
     * Date:
     */
    public function multipleDeleteRegistration(Request $request)
    {
        RegistrationModel::whereIn('registration_id', explode(",", $request->ids))->update(array('status' => '3'));
        NomineeDetailsModel::whereIn('fk_registration_id', explode(",", $request->ids))->update(array('fk_registration_default_status' => '3'));
        RegistrationPaymentModel::where('fk_registration_id', explode(",", $request->ids))->update(array('registration_payment_status' => '3'));
        Session::flash('success', 'Registration has been deleted successfully.');
        return response()->json(['status' => true, 'message' => "Registration has been deleted successfully."]);
    }

    /**
     * @author Reshmi Das
     * Date:
     */
    public function detailsRegistration(Request $request)
    {
        $accessData = $this->getArray('registration', Auth::user()->fk_role_id);
        $detailsRegistration = RegistrationModel::where('registration_id', $request->registration_id)->where('registrations.status', '!=', '3')
            ->select(
                'registrations.*',
                'councils.name',
                'councils.code',
                'regions.region_name',
                'regions.region_code',
                'samaj_zones.samaj_zone_name',
                'yuva_mandal_numbers.yuva_mandal_number',
                'nominee_details.first_nominee_family_id',
                'nominee_details.first_nominee_name',
                'nominee_details.first_nominee_relation',
                'nominee_details.second_nominee_family_id',
                'nominee_details.second_nominee_name',
                'nominee_details.second_nominee_relation'
            )
            ->leftJoin('councils', 'councils.council_id', '=', 'registrations.fk_council_id')
            ->leftJoin('regions', 'regions.region_id', '=', 'registrations.fk_region_id')
            ->leftJoin('samaj_zones', 'samaj_zones.samaj_zone_id', '=', 'registrations.fk_samaj_zone_id')
            ->leftJoin('yuva_mandal_numbers', 'yuva_mandal_numbers.yuva_mandal_number_id', '=', 'registrations.fk_yuva_mandal_id')
            ->leftJoin('nominee_details', 'nominee_details.fk_registration_id', '=', 'registrations.registration_id')
            ->first();


        $BirthDate = $detailsRegistration['date_of_birth'];
        $from = new DateTime($BirthDate);
        $today = new DateTime(date('Y-m-d'));
        $findAge = $from->diff($today)->y;
        //dd($detailsRegistration['age']);
        $dieaseData = DiseaseModel::whereIn('disease_id', explode(',', $detailsRegistration['fk_existing_disease']))->get()->toArray();
        if ($dieaseData == []) {
            $diseaseName = '';
        } else {
            for ($i = 0; $i < count($dieaseData); $i++) {
                $diseaseName[] = $dieaseData[$i]['disease_name'];
            }
        }

        $registerPayment = RegistrationPaymentModel::where('registration_payment_details.registration_payment_status', '!=', '3')
            ->where('registration_payment_details.fk_registration_id', $request->registration_id)
            ->select('registration_payment_details.*',
                'ledger_accounts.legder_name'
            )
            ->leftJoin('ledger_accounts', 'ledger_accounts.ledger_account_id', '=', 'registration_payment_details.fk_reg_bank_name')
            ->first();
        $pendingAmount = $registerPayment['bank_amount'] + $registerPayment['check_bounce_amount'];
        $profilePhoto = RegistrationUploadDocumentModel::where('fk_registration_id', $request->registration_id)->where('upload_registration_documnet_status', '1')->get()->toArray();
        $aadharPhoto = RegistrationUploadDocumentModel::where('fk_registration_id', $request->registration_id)->where('upload_registration_documnet_status', '3')->get()->toArray();

        $paymentDetails = AllBankEntryModel::where('ledger_account', $request->registration_id)
            ->select('all_bank_entry.*',
                'ledger_accounts.legder_name'
            )
            ->leftJoin('ledger_accounts', 'ledger_accounts.ledger_account_id', '=', 'all_bank_entry.fk_bank_id')
            ->get();
        //dd(paymentDetails);
        $getRegisterFamilyId = RegistrationModel::where('registration_id', $request->registration_id)->first();
        $getOtherMemberDetails = RegistrationModel::where('family_id', $getRegisterFamilyId['family_id'])->get()->toArray();
        $umrnNumber = AchModel::where('fk_ysk_id', $detailsRegistration['ysk_id'])->orWhere('fk_ysk_id', $detailsRegistration['pre_ysk_id'])->first();
        //dd($getOtherMemberDetails);
        return view('admin.registration_view')->with('detailsRegistration', $detailsRegistration)->with('registerPayment', $registerPayment)->with('diseaseName', $diseaseName)->with('pendingAmount', $pendingAmount)->with('profilePhoto', $profilePhoto)->with('paymentDetails', $paymentDetails)->with('aadharPhoto', $aadharPhoto)->with('getOtherMemberDetails', $getOtherMemberDetails)->with('umrnNumber', $umrnNumber)->with('accessData', $accessData)->with('findAge', $findAge);
    }

    /**
     * @author Reshmi Das
     * Date:
     */
    public function tooltipStatus()
    {
        $registration = RegistrationModel::where('status', '!=', '3')->where('registration_id', Input::get('id'))->first();
        $allBankEntry = AllBankEntryDetailsModel::where('status', '1')->where('fk_registration_id', Input::get('id'))->first();
        $nomineeData = NomineeDetailsModel::where('fk_registration_id', Input::get('id'))->first();
        $profilePhoto = RegistrationUploadDocumentModel::where('fk_registration_id', Input::get('id'))->where('upload_registration_documnet_status', '1')->first();
        $aadharPhoto = RegistrationUploadDocumentModel::where('fk_registration_id', Input::get('id'))->where('upload_registration_documnet_status', '3')->first();

        $html = '';
        if ($aadharPhoto == '' && $profilePhoto == '' && $allBankEntry['amount'] == '' && $registration['aadhar_card_number'] == '' && ($nomineeData['first_nominee_name'] == '' || $nomineeData['second_nominee_name'] == '')) {
            $html = 'Aadhar Card Photo And Profile Photo And Amount And Aadhar Card Number And Nominee';
        } elseif ($aadharPhoto == '' && $profilePhoto == '' && $allBankEntry['amount'] == '' && $registration['aadhar_card_number'] == '') {
            $html = 'Aadhar Card Photo And Profile Photo And Amount And Aadhar Card Number';
        } elseif ($aadharPhoto == '' && $profilePhoto == '' && $registration['aadhar_card_number'] == '' && ($nomineeData['first_nominee_name'] == '' || $nomineeData['second_nominee_name'] == '')) {
            $html = 'Aadhar Card Photo And Profile Photo And Aadhar Card Number And Nominee';
        } elseif ($aadharPhoto == '' && $registration['aadhar_card_number'] == '' && $allBankEntry['amount'] == '' && ($nomineeData['first_nominee_name'] == '' || $nomineeData['second_nominee_name'] == '')) {
            $html = 'Aadhar Card Photo And Aadhar Card Number And Amount And Nominee.';
        } elseif ($aadharPhoto == '' && $profilePhoto == '' && $allBankEntry['amount'] == '' && ($nomineeData['first_nominee_name'] == '' || $nomineeData['second_nominee_name'] == '')) {
            $html = 'Aadhar Card Photo And Profile Photo And Amount And Nominee.';
        } elseif ($registration['aadhar_card_number'] == '' && $profilePhoto == '' && $allBankEntry['amount'] == '' && ($nomineeData['first_nominee_name'] == '' || $nomineeData['second_nominee_name'] == '')) {
            $html = 'Aadhar Card Number And Profile Photo And Amount And Nominee';
        } elseif ($aadharPhoto == '' && $profilePhoto == '' && $registration['aadhar_card_number'] == '') {
            $html = 'Aadhar Card Photo And Profile Photo And Aadhar Card Number';
        } elseif ($aadharPhoto == '' && $profilePhoto == '' && $allBankEntry['amount'] == '') {
            $html = 'Aadhar Card Photo And Profile Photo And Amount';
        } elseif ($aadharPhoto == '' && $allBankEntry['amount'] == '' && ($nomineeData['first_nominee_name'] == '' || $nomineeData['second_nominee_name'] == '')) {
            $html = 'Aadhar Card Photo And Nominee And Amount';
        } elseif ($registration['aadhar_card_number'] == '' && $profilePhoto == '' && $allBankEntry['amount'] == '') {
            $html = 'Aadhar Card Number And Profile Photo And Amount';
        } elseif ($registration['aadhar_card_number'] == '' && $allBankEntry['amount'] == '' && ($nomineeData['first_nominee_name'] == '' || $nomineeData['second_nominee_name'] == '')) {
            $html = 'Aadhar Card Number And Nominee And Amount';
        } elseif ($profilePhoto == '' && $allBankEntry['amount'] == '' && ($nomineeData['first_nominee_name'] == '' || $nomineeData['second_nominee_name'] == '')) {
            $html = 'Nominee And Profile Photo And Amount ';
        } elseif ($registration['aadhar_card_number'] == '' && $profilePhoto == '' && ($nomineeData['first_nominee_name'] == '' || $nomineeData['second_nominee_name'] == '')) {
            $html = 'Aadhar Card Number And Profile Photo And Nominee';
        } elseif ($profilePhoto == '' && $aadharPhoto == '' && ($nomineeData['first_nominee_name'] == '' || $nomineeData['second_nominee_name'] == '')) {
            $html = 'Aadhar Card Photo And Nominee And Profile Photo';
        } elseif ($aadharPhoto == '' && $registration['aadhar_card_number'] == '' && $allBankEntry['amount'] == '') {
            $html = 'Aadhar Card Photo And Aadhar Card Number And Amount';
        } elseif ($aadharPhoto == '' && $registration['aadhar_card_number'] == '') {
            $html = 'Aadhar Card Photo And Aadhar Card Number';
        } elseif ($aadharPhoto == '' && $profilePhoto == '') {
            $html = 'Aadhar Card Photo And Profile Photo';
        } elseif ($aadharPhoto == '' && $allBankEntry['amount'] == '') {
            $html = 'Aadhar Card Photo And Amount';
        } elseif ($aadharPhoto == '' && ($nomineeData['first_nominee_name'] == '' || $nomineeData['second_nominee_name'] == '')) {
            $html = 'Aadhar Card Photo And Nominee';
        } elseif ($registration['aadhar_card_number'] == '' && $profilePhoto == '') {
            $html = 'Aadhar Card Number And Profile Photo';
        } elseif ($registration['aadhar_card_number'] == '' && $allBankEntry['amount'] == '') {
            $html = 'Aadhar Card Number And Amount';
        } elseif ($registration['aadhar_card_number'] == '' && ($nomineeData['first_nominee_name'] == '' || $nomineeData['second_nominee_name'] == '')) {
            $html = 'Aadhar Card Number And Nominee';
        } elseif ($profilePhoto == '' && $allBankEntry['amount'] == '') {
            $html = 'Profile Photo And Amount';
        } elseif ($profilePhoto == '' && ($nomineeData['first_nominee_name'] == '' || $nomineeData['second_nominee_name'] == '')) {
            $html = 'Profile Photo And Nominee';
        } elseif ($allBankEntry['amount'] == '' && ($nomineeData['first_nominee_name'] == '' || $nomineeData['second_nominee_name'] == '')) {
            $html = 'Amount And Nominee';
        } elseif ($aadharPhoto == '') {
            $html = 'Aadhar Card Photo';
        } elseif ($profilePhoto == '') {
            $html = 'Profile Photo';
        } elseif ($allBankEntry['amount'] == '') {
            $html = 'Amount';
        } elseif ($registration['aadhar_card_number'] == '') {
            $html = 'Aadhar Card Number';
        } elseif ($nomineeData['first_nominee_name'] == '' || $nomineeData['second_nominee_name'] == '') {
            $html = 'Nominee';
        }
        $responseData = array("success" => "1", "html_data" => $html);
        echo json_encode($responseData);
        exit;
    }

    /**
     * @author Reshmi Das
     * Date:
     */
    public function paymentDetails(Request $request)
    {
        $accessData = $this->getArray('registration', Auth::user()->fk_role_id);
        $registrationData = RegistrationModel::where('registration_id', $request->registration_id)
            ->select('registrations.*',
                'regions.region_name',
                'regions.region_code'
            )
            ->leftJoin('regions', 'regions.region_id', '=', 'registrations.fk_region_id')
            ->first();

        $bankEntry = AllBankEntryDetailsModel::where('status', '1')->where('fk_registration_id', $request->registration_id)->where('payment_type', 'Credit')->groupBy('fk_all_bank_entry_id')->get()->toArray();
        //dd($bankEntry);
        foreach ($bankEntry as $key => $value) {
            $totalAmount[] = $value['amount'];
        }
        $getAllBankEntryDetails = AllBankEntryDetailsModel::where('all_bank_entry_details.status', '1')->where('all_bank_entry_details.fk_registration_id', $request->registration_id)
            ->select('all_bank_entry_details.*',
                'all_bank_entry.payment_date',
                'all_bank_entry.payment_mode'
            )
            ->leftJoin('all_bank_entry', 'all_bank_entry.all_bank_entry_id', '=', 'all_bank_entry_details.fk_all_bank_entry_id')
            ->get()->toArray();

        /*for ($i=0; $i < count($getAllBankEntryDetails); $i++) {
            $getAllBankEntry[] = AllBankEntryModel::where('all_bank_entry_id',$getAllBankEntryDetails[$i]['fk_all_bank_entry_id'])
            ->where('all_bank_entry.status','1')
            ->select('all_bank_entry.*',
                'all_bank_entry_details.fk_registration_id',
                'all_bank_entry_details.fk_behalf_of_payment_id',
                'all_bank_entry_details.ysk_entry',
                'all_bank_entry_details.payment_type',
                'ledger_accounts.legder_name'
            )
            ->leftJoin('all_bank_entry_details','all_bank_entry_details.fk_all_bank_entry_id','=','all_bank_entry.all_bank_entry_id')
            ->leftJoin('ledger_accounts','ledger_accounts.ledger_account_id','=','all_bank_entry.fk_bank_id')
            ->first()->toArray();
        }
*/
        //dd($getAllBankEntryDetails);
        return view('admin.registration_payment')->with('registrationData', $registrationData)->with('totalAmount', $totalAmount)->with('getAllBankEntryDetails', $getAllBankEntryDetails)->with('accessData', $accessData);
    }

    public function council(Request $request)
    {
        //echo json_encode($courses, JSON_PRETTY_PRINT);

//yahan poora data set aayega jo query chalayi hai karo isse fatafat
        $states = DB::table("councils")
            ->where("council_id", $request->councilname)
            ->pluck("fk_region");
        $region = explode(',', $states);
        foreach ($region as $key => $value) {
            //print_r($reg);
            //$test=$reg[];
            $Region_name = DB::table("regions")->where("region_id", $value)->pluck("region_name", "region_id");
//             if(!empty($Region_name)){
//                 return response()->json($Region_name);
//             }
            // return response()->json($Region_name);

        }

        // Enable query log
        return response()->json($Region_name);
// Your Eloquent query executed by using get()


    }

    public function division(Request $request)
    {

        $division = DB::table("divisions")
            ->where("fk_region_id", $request->region_name)
            ->pluck("division_name");


        return response()->json($division);
        // Enable query log

// Your Eloquent query executed by using get()


    }

    public function samaj(Request $request)
    {

        $samaj_zone_name = DB::table("samaj_zones")
            ->where("fk_region_id", $request->region_name)
            ->pluck("samaj_zone_name");


        return response()->json($samaj_zone_name);
        // Enable query log

// Your Eloquent query executed by using get()


    }

    public function yuvamandal(Request $request)
    {

        $yuva_mandal_name = DB::table("yuva_mandal_numbers")
            ->where("fk_region_id", $request->region_name)
            ->pluck("yuva_mandal_number");


        return response()->json($yuva_mandal_name);
        // Enable query log

// Your Eloquent query executed by using get()


    }

    public function councilname(Request $request)
    {
        //$reg='hello';
        $council = $request->region_name;
        $council_name = DB::table("councils")
            ->whereRaw("FIND_IN_SET('$council',fk_region)")
            ->pluck("name");
        return response()->json($council_name);

    }
//        $council_name = DB::table("councils")
//            ->where("fk_region",$request->region_name)
//            ->pluck("name");




}
