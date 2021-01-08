<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourierModel;
use App\CourierDocumentModel;
use App\RegistrationModel;
use App\CourierCompanyModel;
use App\SahyognidhiRequestModel;
use App\CourierSlipModel;
use Input;
use Session;
use Auth;
use DateTime;
class CourierController extends Controller
{
	public function __construct()
	{
		$this->middleware('checkLogin');
	}
    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function courier()
    {
    	Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
		$accessData = $this->getArray('courier',Auth::user()->fk_role_id);
    	$registrationData = RegistrationModel::where('status','1')->where('courier_id','0')->get();
        
        $sahyognidhiData  = SahyognidhiRequestModel::where('status','0')->where('sahyognidhiError1','')->where('courier_id','0')->get();

        $todayDate = date('Y-m-d', strtotime('+3 month'));
        $formDate = new DateTime($todayDate);
        $allRegistrationData = RegistrationModel::where('status','1')->get();
        foreach ($allRegistrationData as $key => $value) {
            $dateOfBirth = new DateTime($value['date_of_birth']);
            $getAge = $dateOfBirth->diff($formDate)->y;
            if ($dateOfBirth->diff($formDate)->y >= 30) {
                $getFiftyFiveYearsData[] = RegistrationModel::where('status','1')->where('date_of_birth',$dateOfBirth)->get();
            }
        }

    	$courier = CourierModel::where('couriers.status','1')
    				->orderBy('couriers.courier_id','DESC')
    				->groupBy('couriers.courier_id')
    				->get();
    	return view('admin.courier')->with('courier',$courier)->with('registrationData',$registrationData)->with('sahyognidhiData',$sahyognidhiData)->with('getFiftyFiveYearsData',$getFiftyFiveYearsData)->with('accessData',$accessData);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function addCourier()
    {
        $accessData = $this->getArray('courier',Auth::user()->fk_role_id);
		$yskMember = RegistrationModel::where('status','1')->get();
    	return view('admin.courier_add')->with('yskMember',$yskMember)->with('accessData',$accessData);
    }

    public function getNameByYskId(Request $request)
    {
    	$registrationData = RegistrationModel::where('registration_id',$requestfk_registration_id)->first();
    	dd($registrationData);
    	$response = array("success" => "1","message" => '',"name" => $registrationData['name_as_per_yuva_sangh_org'],"phoneNumber" => $registrationData['phone_number_first']);
		echo json_encode($response);
		exit;
    }
    
    public function addForRegistrationSahyognidhi(Request $request)
    {
        $id = $request->id;
        $yskMember = RegistrationModel::where('registration_id',$request->id)->first();
        $sahyognidhiRequestData = SahyognidhiRequestModel::where('sahyognidhi_id',$request->id)->first();
        //dd($sahyognidhiRequestData);
        return view('admin.courier_add_for_registration_sahyognidhi')->with('id',$id)->with('yskMember',$yskMember)->with('sahyognidhiRequestData',$sahyognidhiRequestData);
    }
    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function saveCourier(Request $request)
    {
    	$this->validate($request,[
			'courier_status'    => 'required',
			'fk_registration_id'=> 'required',
			'courier_date'      => 'required',
			'name_as_per_yuva_sangh_org'  => 'required',
			'phone_number'      => 'required',
			'company_name'      => 'required',
			'courier_narration'      => 'required',
			'courier_static_id' => 'required',
		]);
		
    	CourierModel::create([
    		'courier_status'    => Input::get('courier_status'),
    		'fk_registration_id'=> Input::get('fk_registration_id'),
    		'courier_date'      => date("Y-m-d", strtotime(Input::get('courier_date'))),
    		'company_name'      => Input::get('company_name'),
    		'courier_static_id' => Input::get('courier_static_id'),
    		'name_as_per_yuva_sangh_org' => Input::get('name_as_per_yuva_sangh_org'),
    		'phone_number'		=> Input::get('phone_number'),
    		'courier_narration'	=> Input::get('courier_narration'),
            'courier_for'       => Input::filled('courier_for') ? Input::get('courier_for') : 'Courier',
    		'created_by'        => Auth::user()->user_id,
    	]);	

    	$getCourierData = CourierModel::get();
    	foreach ($getCourierData as $key => $value) {
    		$courierId = $value['courier_id'];
    	}

    	if($request->hasfile('courier_slip'))
    	{
    		foreach($request->file('courier_slip') as $file)
    		{
    			$name = strtotime(date("Y-m-d H:i:s")).$file->getClientOriginalName();
    			$extension = $file->getClientOriginalExtension();
    			$file->move('assets/uploads/courier_slip/', $name);
    			CourierSlipModel::create([
    				'fk_courier_id' => $courierId,
    				'upload_document_extension'   => $extension,
    				'upload_courier_slip' => $name,
    				'created_by'          => Auth::user()->user_id,
    			]); 
    		}
    	}

        if(Input::get('courier_for') == 'Registration'){
            RegistrationModel::where('ysk_id',Input::get('fk_registration_id'))->orWhere('pre_ysk_id',Input::get('fk_registration_id'))->update(array(
                'courier_id' => $courierId,
                'courier_for' => Input::get('courier_for'),
            ));
        }
        if(Input::get('courier_for') == 'Sahyognidhi Request'){
            SahyognidhiRequestModel::where('status','0')->where('sahyognidhiError','')->where('fk_ysk_id',Input::get('fk_registration_id'))->update(array(
                'courier_id' => $courierId,
            ));
        }

        if(Input::get('courier_for') == '55 Years'){
            RegistrationModel::where('ysk_id',Input::get('fk_registration_id'))->orWhere('pre_ysk_id',Input::get('fk_registration_id'))->update(array(
                'courier_id' => $courierId,
                'courier_for' => Input::get('courier_for'),
            ));
        }
		
		return redirect()->route('courier')->with('success','Courier Details has been added successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function editCourier(Request $request)
    {
        $accessData = $this->getArray('courier',Auth::user()->fk_role_id);
    	$editCourier        = CourierModel::where('courier_id',$request->courier_id)->first();
    	$courierDocument    = CourierSlipModel::where('fk_courier_id',$request->courier_id)->get();
    	return view('admin.courier_edit')->with('editCourier',$editCourier)->with('courierDocument',$courierDocument)->with('accessData',$accessData);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function updateCourier(Request $request)
    {
    	$this->validate($request,[
			'courier_status'    => 'required',
			'fk_registration_id'=> 'required',
			'courier_date'      => 'required',
			'name_as_per_yuva_sangh_org'  => 'required',
			'phone_number'      => 'required',
			'company_name'      => 'required',
			'courier_narration'      => 'required',
			'courier_static_id' => 'required',
		]);
		CourierModel::where('courier_id',$request->editId)->update(array(
    		'courier_status'    => Input::get('courier_status'),
    		'fk_registration_id'=> Input::get('fk_registration_id'),
    		'courier_date'      => date("Y-m-d", strtotime(Input::get('courier_date'))),
    		'company_name'      => Input::get('company_name'),
    		'courier_static_id' => Input::get('courier_static_id'),
    		'name_as_per_yuva_sangh_org' => Input::get('name_as_per_yuva_sangh_org'),
    		'phone_number'		=> Input::get('phone_number'),
    		'courier_narration'	=> Input::get('courier_narration'),
    		'updated_by'        => Auth::user()->user_id,
    	));
    	if($request->hasfile('courier_slip'))
        {
            foreach($request->file('courier_slip') as $file)
            {
                $name = strtotime(date("Y-m-d H:i:s")).$file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $file->move('assets/uploads/courier_slip/', $name);
                CourierSlipModel::create([
                    'fk_courier_id' => $request->editId,
                    'upload_document_extension'   => $extension,
                    'upload_courier_slip' => $name,
                    'created_by'          => Auth::user()->user_id,
                ]); 
            }
        }

	    return redirect()->route('courier')->with('success','Courier Details has been updated successfully');
	}

	/**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function deleteCourier(Request $request)
    {
    	CourierModel::where('courier_id',$request->courier_id)->update(array('status' => '3'));
    	CourierSlipModel::where('fk_courier_id',$request->courier_id)->delete();
		return redirect()->route('courier')->with('success','Courier Deatils has been deleted successfully');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function multipleDeleteCourier(Request $request)
    {
    	CourierModel::whereIn('courier_id',explode(",",$request->ids))->update(array('status' => '3'));
    	CourierSlipModel::whereIn('fk_courier_id',explode(",",$request->ids))->delete();
		Session::flash('success', 'Courier deatils has been deleted successfully.');
		return response()->json(['status'=>true,'message'=>"Courier deatils has been deleted successfully."]);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function courierDetails(Request $request)
    {
        $accessData = $this->getArray('courier',Auth::user()->fk_role_id);
    	$courierDetails = CourierModel::where('courier_id',$request->courier_id)->first();
        $courierImage   = CourierSlipModel::where('fk_courier_id',$request->courier_id)->get()->toArray();
       // dd($courierDetails);
    	return view('admin.courier_view')->with('courierDetails',$courierDetails)->with('courierImage',$courierImage)->with('accessData',$accessData);
    }

    public function deleteCourierUploadDocument(Request $request)
    {
    	$deleteDocument = CourierSlipModel::where('courier_slip_id',$request->id)->delete();
    	$responseData = array("success" => "1");
        echo json_encode($responseData);
        exit;
    }
}
