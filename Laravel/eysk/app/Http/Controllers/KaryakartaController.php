<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\RoleModel;
use App\ModuleModel;
use App\ModulePageModel;
use App\RolePermissionModel;
use App\RegistrationModel;
use App\KaryakartaModel;
use App\User;
use Input;
use Hash;
use Auth;
use Session;
class KaryakartaController extends Controller
{
    public function karyakarta()
    {
        $accessData = $this->getArray('karyakarta',Auth::user()->fk_role_id);
        $getKaryakartaData = KaryakartaModel::where('karyakartas.status','!=','3')
                             ->select('karyakartas.*',
                                'roles.name'
                            )
                             ->leftJoin('roles','roles.role_id','=','karyakartas.fk_role_id')
                             ->get();
    	return view('admin.karyakarta')->with('getKaryakartaData',$getKaryakartaData)->with('accessData',$accessData);
    }

    public function addKaryakarta(Request $request)
    {
        $accessData = $this->getArray('karyakarta',Auth::user()->fk_role_id);
        $roleData = DB::table('roles')
                    //->whereNotIn('role_id', $roleIdData)
                    ->where('roles.status','1')
                    ->get(); 

    	//$roleData = RoleModel::where('status','1')->get();
        $yskId = RegistrationModel::where('status','!=','3')->where('status','!=','2')->where('status','!=','5')->get();
        return view('admin.karyakarta_add')->with('roleData',$roleData)->with('yskId',$yskId)->with('accessData',$accessData);
    }

    public function getAssignPermission(Request $request)
    {
        $roleData = RoleModel::where('status','1')->get();
        $moduleData = ModuleModel::where('status','1')->get();
        $modulePage = array();
        foreach ($moduleData as $moduleDatas) {
            $modulePageData = ModulePageModel::where(['status' => '1','fk_module_id' => $moduleDatas->module_id])->get();
            foreach ($modulePageData as $modulePageDatas) {
                $modulePage[$moduleDatas->name][] = array(
                    'page_id' => $modulePageDatas->page_id,
                    'parent_page_id' => $modulePageDatas->parent_page_id,
                    'page_title' => $modulePageDatas->page_title,
                    'page_slug' => $modulePageDatas->page_slug
                );
            }
        }
        $rolePermissionData = RolePermissionModel::where('fk_role_id',$request->fk_designation_id)->get();
        $role_fk_page_id = array();
        foreach ($rolePermissionData as $key => $rolePermissionDataValue) {
            $role_fk_page_id[] = $rolePermissionDataValue['fk_page_id'];
        }
        $html = '';
        foreach ($modulePage as $key => $valueModulePage) {
            $html .= '
            <div class="m-demo">
            <div class="m-demo__preview m-demo__preview--badge p-4"><p>'.$key.'</p>
            <div class="kt-checkbox-inline">';
            foreach ($valueModulePage as $key => $valueModulePageSlug) {
                $checkedboxData = "";
                if(in_array($valueModulePageSlug['page_id'], $role_fk_page_id)){
                    $checkedboxData = "checked";
                }
                $html .='<label class="kt-checkbox m-checkbox" cheched="">';
                if ($valueModulePageSlug['page_slug'] == "All") {
                    $html .='<input '. $checkedboxData .' type="checkbox" value="'.$valueModulePageSlug['page_id'] .'" name="page_slugs[]" onchange="checkAll('.$valueModulePageSlug['page_id'] .')" id="pages'.$valueModulePageSlug['page_id'].'" class="add_class_'.$valueModulePageSlug['page_id'].' kt-checkbox kt-checkbox--single kt-checkbox--solid">'.$valueModulePageSlug['page_slug'].'
                    <span></span>                                               
                    </label>';
                }
                else{
                    $html .= '<input '.$checkedboxData.' type="checkbox" value="'.$valueModulePageSlug['page_id'].'" name="page_slugs[]" onchange="checkSubCheckbox('.$valueModulePageSlug['page_id'].','.$valueModulePageSlug['parent_page_id'].')" id="pages'.$valueModulePageSlug['page_id'].'" class="add_class_sub_'.$valueModulePageSlug['parent_page_id'].' kt-checkbox kt-checkbox--single kt-checkbox--solid"> '.$valueModulePageSlug['page_slug'].'
                    <span></span>
                    </label>';
                }
            }
            $html .='</div></div>';
        }
        $responseData = array("success" => "1","message" => "","html_data" => $html);
        echo json_encode($responseData);
        exit;

    }

    public function getYskDetailByRegistrationId(Request $request)
    {
        $getYskDetails = RegistrationModel::where('registration_id',$request->fk_registration_id)
                        ->select('registrations.*',
                            'regions.region_name',
                            'regions.region_id',
                            'councils.name',
                            'councils.council_id',
                            'samaj_zones.samaj_zone_name',
                            'samaj_zones.samaj_zone_id',
                            'yuva_mandal_numbers.yuva_mandal_number',
                            'yuva_mandal_numbers.yuva_mandal_number_id',
                            'divisions.division_name',
                            'divisions.division_id'
                        )
                        ->leftJoin('regions','regions.region_id','=','registrations.fk_region_id')
                        ->leftJoin('councils','councils.council_id','=','registrations.fk_council_id')
                        ->leftJoin('samaj_zones','samaj_zones.samaj_zone_id','=','registrations.fk_samaj_zone_id')
                        ->leftJoin('yuva_mandal_numbers','yuva_mandal_numbers.yuva_mandal_number_id','=','registrations.fk_yuva_mandal_id')
                        ->leftJoin('divisions','divisions.division_id','=','registrations.fk_division_id')
                        ->first(); 
            if ($getYskDetails['ysk_id'] != '') {
                $yskId = $getYskDetails['ysk_id'];
            }
            else{
                $yskId = $getYskDetails['pre_ysk_id'];
            }
            //dd($yskId);
                        //dd($getYskDetails->toArray());
        $responseData = array("success" => "1","message" => "","name_as_per_yuva_sangh_org" => $getYskDetails['name_as_per_yuva_sangh_org'],"phone_number_first" => $getYskDetails['phone_number_first'],"phone_number_second" => $getYskDetails['phone_number_second'],"email" => $getYskDetails['email'],"city" => $getYskDetails['fk_city_id'],"region_name" => $getYskDetails['region_name'],"yuva_mandal_name" => $getYskDetails['yuva_mandal_number'],"council_name" => $getYskDetails['name'],"samaj_zone_name" => $getYskDetails['samaj_zone_name'],"division_name" => $getYskDetails['division_name'],"ysk_id" => $yskId);
        echo json_encode($responseData);
        exit;

    }

    public function saveKaryakarta(Request $request)
    {
       // dd(Auth::user()['user_id']);
       if(Input::get('page_slugs') == ''){
           return redirect()->route('add-karyakarta')->with("error","Give properb role permission.");
       }
       else{
         KaryakartaModel::create([
            'fk_role_id' => Input::get('fk_role_id'),
            'start_date' => date('Y-m-d',strtotime(Input::get('start_date'))),
            'fk_registration_id'         => Input::get('fk_registration_id'),
            'name_as_per_yuva_sangh_org' => strtoupper(Input::get('name_as_per_yuva_sangh_org')),
            'phone_number_first'  => Input::filled('phone_number_first') ? Input::get('phone_number_first') : '',
            'phone_number_second' => Input::filled('phone_number_second') ? Input::get('phone_number_second') : '',
            'ysk_id'              => Input::get('ysk_id'),
            'email' => Input::filled('email') ? Input::get('email') : '',
            'city'  => Input::filled('city') ? Input::get('city') : '',
            'region_name'       => Input::filled('region_name') ? Input::get('region_name') : '',
            'yuva_mandal_name'  => Input::filled('yuva_mandal_name') ? Input::get('yuva_mandal_name') : '',
            'council_name'      => Input::filled('council_name') ? Input::get('council_name') : '',
            'samaj_zone_name'   => Input::filled('samaj_zone_name') ? Input::get('samaj_zone_name') : '',
            'division_name'     => Input::filled('division_name') ? Input::get('division_name') : '',
            'password'          => Input::get('password'),
            'karyakarta_email_id' => Input::get('karyakarta_email_id'),
            'ysk_details'       => strtoupper(Input::get('ysk_details')),
            'end_date'          => Input::filled('end_date') ? date('Y-m-d',strtotime(Input::get('end_date'))) : '',
            'created_by'        => Auth::user()['user_id'],
        ]);
        
        $karyakartaData = KaryakartaModel::get();
        foreach($karyakartaData as $key => $value){
            $karyakartaId = $value['karyakarta_id'];
        }
      
        $updateRole = Input::all();
        $updateRoleArray = array();
        $delRole = RolePermissionModel::where('fk_role_id',Input::get('fk_role_id'))->delete();
        foreach ($updateRole['page_slugs'] as $key => $value) {
            $updateRoleArray[] = array(
                "fk_role_id" => Input::get('fk_role_id'),
                "fk_page_id" => $value,
                "updated_by" => Auth::user()->user_id,
                "updated_at" => date('Y-m-d H:i:s'),
            );
        }
        $updateRoleData = RolePermissionModel::insert($updateRoleArray);
        User::create([
            "fk_role_id" => Input::get('fk_role_id'),
            "fk_karyakarta_id" => $karyakartaId,
            "email"      => Input::get('karyakarta_email_id'),
            "name"       => strtoupper(Input::get('name_as_per_yuva_sangh_org')),
            "password"   => Hash::make(Input::get('password')),
        ]);
        return redirect()->route('karyakarta')->with("success","Karyakarta has been added successfully.");
       }
    }

    public function editKaryakarta(Request $request)
    {
        $accessData = $this->getArray('karyakarta',Auth::user()->fk_role_id);
        $editKaryakartaDetails = KaryakartaModel::where('karyakartas.karyakarta_id',$request->id)
                                ->select('karyakartas.*',
                                    'roles.name'
                                )
                                ->leftJoin('roles','roles.role_id','=','karyakartas.fk_role_id')
                                ->first();
        //$listRoleData = RoleModel::where('role_id',$id)->get();
        $rolePermissionData = RolePermissionModel::where('fk_role_id',$editKaryakartaDetails['fk_role_id'])->get();
        $role_fk_page_id = array();
        foreach ($rolePermissionData as $key => $rolePermissionDataValue) {
            $role_fk_page_id[] = $rolePermissionDataValue['fk_page_id'];
        }

        $rolePermissionRoleId = DB::table('role_permissions')
                                ->select('roles.role_id')
                                ->join('roles','roles.role_id','=','role_permissions.fk_role_id')
                                ->groupBy('role_permissions.fk_role_id')
                                ->get();

        $moduleData = ModuleModel::where('status','1')->get();
        $modulePage = array();
        foreach ($moduleData as $moduleDatas) {
            $modulePageData = ModulePageModel::where('status','1')->where('fk_module_id',$moduleDatas->module_id)->get();
            foreach ($modulePageData as $modulePageDatas) {
                $modulePage[$moduleDatas->name][] = array(
                    "page_id" => $modulePageDatas->page_id,
                    "page_slug" => $modulePageDatas->page_slug,
                    "parent_page_id" => $modulePageDatas->parent_page_id,
                    "page_title" => $modulePageDatas->page_title
                );
            }
        }
    	return view('admin.karyakarta_edit')->with('modulePage',$modulePage)->with(['currentPageId'=>$role_fk_page_id,'role_id'=>$editKaryakartaDetails['fk_role_id'],'modulePage'=>$modulePage])->with('editKaryakartaDetails',$editKaryakartaDetails)->with('accessData',$accessData);
    }

    public function updateKaryakarta(Request $request)
    {
        //dd(Input::get('karyakarta_email_id'));
        if (Input::get('end_date') != '') {
            KaryakartaModel::where('karyakarta_id',$request->editId)->update(array(
                'karyakarta_email_id' => Input::get('karyakarta_email_id'),
                'password'          => Input::get('password'),
                'ysk_details'       => strtoupper(Input::get('ysk_details')),
                'end_date'          => Input::filled('end_date') ? date('Y-m-d',strtotime(Input::get('end_date'))) : '',
                'status'            => '0',
                'updated_by'        => Auth::user()->user_id,
            ));
        }
        else{
            KaryakartaModel::where('karyakarta_id',$request->editId)->update(array(
                'karyakarta_email_id' => Input::get('karyakarta_email_id'),
                'password'          => Input::get('password'),
                'ysk_details'       => strtoupper(Input::get('ysk_details')),
                'end_date'          => Input::filled('end_date') ? date('Y-m-d',strtotime(Input::get('end_date'))) : '',
                'updated_by'        => Auth::user()->user_id,
            ));            
        }
        $updateRole = Input::all();
        $updateRoleArray = array();
        $delRole = RolePermissionModel::where('fk_role_id',Input::get('fk_role_id'))->delete();
        foreach ($updateRole['page_slugs'] as $key => $value) {
            $updateRoleArray[] = array(
                "fk_role_id" => Input::get('fk_role_id'),
                "fk_page_id" => $value,
                "updated_by" => Auth::user()->user_id,
                "updated_at" => date('Y-m-d H:i:s'),
            );
        }
        User::where('fk_karyakarta_id',$request->editId)->update(array(
            "email"      => Input::get('karyakarta_email_id'),
            "password"   => Hash::make(Input::get('password')),
        ));
        $updateRoleData = RolePermissionModel::insert($updateRoleArray);
        return redirect()->route('karyakarta')->with("success","Karyakarta has been updated successfully.");
    }

    public function viewKaryakarta(Request $request)
    {
        $accessData = $this->getArray('karyakarta',Auth::user()->fk_role_id);
        $viewKaryakartaDetails = KaryakartaModel::where('karyakarta_id',$request->id)
                                 ->first();
    	return view('admin.karyakarta_view')->with('viewKaryakartaDetails',$viewKaryakartaDetails)->with('accessData',$accessData);
    }

    public function deleteKaryakarta(Request $request)
    {
       KaryakartaModel::where('karyakarta_id',$request->id)->update(array(
            'status' => '3',
        ));
        $getKaryakarta = KaryakartaModel::where('karyakarta_id',$request->id)->first();
        User::where('fk_role_id',$getKaryakarta['fk_role_id'])->delete();
        return redirect()->route('karyakarta')->with("success","Karyakarta has been deleted successfully.");
    }

    public function multipleDeleteKaryakarta(Request $request)
    {
        KaryakartaModel::whereIn('karyakarta_id',explode(",",$request->ids))->update(array('status' => '3'));
        Session::flash('success', 'Karkyakarta has been deleted successfully.');
        return response()->json(['status'=>true,'message'=>"Karkyakarta deleted successfully."]);
    }

    public function deactiveStatus(Request $request)
    {
        KaryakartaModel::where('karyakarta_id',$request->karkyakarta_id)->update(array(
            'deactive_reason' => strtoupper(Input::get('deactive_reason')),
            'status' => '0',
        ));
        return redirect()->route('karyakarta')->with("success","Karyakarta has been deactivated successfully.");
    }
}
