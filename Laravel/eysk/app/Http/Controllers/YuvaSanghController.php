<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeathTypeModel;
use App\DeathTypeAmountModel;
use DB;
use Session;
use App\BankDetailsModel;
use App\BankChargesModel;
use App\AchChargeModel;
use App\ReservedFundsModel;
use App\DistrictModel;
use App\DistrictAreasModel;
use App\ExpenseTypeModel;
use App\IncomeTypeModel;
use App\RegistrationFeesModel;
use App\RegionsModel;
use App\SamajZoneModel;
use App\YuvaMandalNumberModel;
use Illuminate\Support\Facades\Input;
class YuvaSanghController extends Controller
{
	public function addDeathType()
	{
		return view('admin.add_death_type');
	}
	public function saveDeathType(Request $request)
	{
		$this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
		$saveDeathTypeData = new DeathTypeModel();
		$saveDeathTypeData->title = $request->title;
		$saveDeathTypeData->description = $request->description;
		$saveDeathTypeData->created_by = '1';
		$saveDeathTypeData->updated_by = '1';
		$saveDeathTypeData->created_at = date('Y-m-d H:i:s');
		$saveDeathTypeData->updated_at = date('Y-m-d H:i:s');
		$saveDeathTypeData->save();
		return redirect()->route('view-death-type')->with('success','Death type has been added successfully');
	}
	public function viewDeathType()
	{
		$deathTypeData = DeathTypeModel::where('status','1')->orderBy('death_type_id','DESC')->get();
		return view('admin.death_type',['deathTypeData' => $deathTypeData]);
	}
	public function editDeathType(Request $request)
	{
		$editDeathTypeData = DeathTypeModel::where('death_type_id',$request->death_type_id)->first();
		return view('admin.edit_death_type')->with('editDeathTypeData',$editDeathTypeData);
	}
	public function updateDeathType(Request $request)
	{
		$DeathTypeData = Input::all();
		$saveUpdateDeathType = array(
			'title' => Input::get('title'),
			'description' => Input::get('description'),
			'created_by' => '1',
			'updated_by' => '1',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		);
		//dd($saveUpdateDeathType);
		$updateDeathTypeData = DeathTypeModel::find($request->editId)->update($saveUpdateDeathType);
		//dd($saveUpdateDeathType);
		return redirect()->route('view-death-type')->with('success','Death type has been updated successfully');
	}
	public function deleteDeathType($id)
	{
		//dd($id);
		$deleteDeathTypeData = DeathTypeModel::where('death_type_id',$id)->delete();
		return redirect()->route('view-death-type')->with('success','Death type has been deleted successfully');
	}
	public function multipleDeleteDeathType(Request $request)
	{
		$ids = $request->ids;
        //dd($ids);
		DeathTypeModel::whereIn('death_type_id',explode(",",$ids))->delete();
		return response()->json(['status'=>true,'message'=>"Death type deleted successfully."]);   
	}
	public function deathTypeAmount()
	{
		$deathTypeAmountData =  DeathTypeAmountModel::where('status','1')->orderBy('death_type_amounts_id', 'DESC')->get();
		return view('admin.death_type_amount',['deathTypeAmountData' => $deathTypeAmountData]);
	}
	public function addDeathTypeAmount()
	{
		return view('admin.add_death_type_amount');
	}
	public function saveDeathTypeAmount(Request $request)
	{
		$this->validate($request,[
			'amount' => 'required|numeric',
			'start_date' => 'required',
			'end_date' => 'required',
		]);
		$svDeathTypeAmountData = Input::all();
		$saveDeathTypeAmountData = array(
			'start_date' => date("Y-m-d", strtotime(Input::get('start_date'))),
			'end_date' => date("Y-m-d", strtotime(Input::get('end_date'))),
			'amount' => Input::get('amount'),
			'created_by' => '1'
		);
		//dd($saveDeathTypeAmountData['start_date']);
		$insert = DeathTypeAmountModel::insert($saveDeathTypeAmountData);
		return redirect()->route('death-type-amount')->with('success','Death type Amount has been added successfully');
	}
	public function editDeathTypeAmount($id)
	{
		$editDeathAmountData = DeathTypeAmountModel::where('death_type_amounts_id',$id)->get();
    	//dd($editDeathAmountData);
		return view('admin.edit_death_type_amount')->with('editDeathAmountData',$editDeathAmountData[0]);
	}
	public function updateDeathTypeAmount(Request $request)
	{
    	//dd($request->editId);
    	$this->validate($request,[
			'amount' => 'required|numeric',
		]);
		$upDeathAmount = DeathTypeAmountModel::where('death_type_amounts_id',$request->editId)->update(array('status' => '0'));
		$updateDeathAmount = Input::all();
		$updateDeathAmountData = array(
			'start_date' => date("Y-m-d", strtotime(Input::get('start_date'))),
			'end_date' => date("Y-m-d", strtotime(Input::get('end_date'))),
			'amount' => Input::get('amount'),
			'updated_by' => '1',
			'updated_at' => date('Y-m-d H:i:s')
		);
		$updateDeathTypeAmountData = DeathTypeAmountModel::insert($updateDeathAmountData);
		//dd($update);
		return redirect()->route('death-type-amount')->with('success','Death type Amount has been updated successfully');
	}
	public function deleteDeathTypeAmount($id)
	{
		$deleteDeathTypeAmountData = DeathTypeAmountModel::where('death_type_amounts_id',$id)->delete();
		//dd($deleteDeathTypeAmountData);
		return redirect()->route('death-type-amount')->with('success','Death type Amount has been deleted successfully');
	}
	public function multipleDeleteDeathTypeAmount(Request $request)
	{
		$ids = $request->ids;
        //dd($ids);
		DeathTypeAmountModel::whereIn('death_type_amounts_id',explode(",",$ids))->delete();
		Session::flash('success', 'Death type Amount deleted successfully.');
		return response()->json(['status'=>true,'message'=>"Death type Amount deleted successfully."]);
	}
	public function bankDetails()
	{
		$bankDetailsData = BankDetailsModel::where('status','1')->orderBy('bank_detail_id','DESC')->get();
		return view('admin.bank_details',['bankDetailsData' => $bankDetailsData]);
	}
	public function defaultBankAccount($id)
	{
		$defaultBankAccount = BankDetailsModel::where('bank_detail_id','!=',$id)->update(array('default_account' => '0'));
		$defaultBankAccountData = BankDetailsModel::where('bank_detail_id',$id)->update(array('default_account' => '1'));
		//dd($switchBankDetails);
		return redirect()->route('bank-details');
	}
	public function addBankDetails()
	{
		return view('admin.add_bank_details');
	}
	public function saveBankDetails(Request $request)
	{
		$this->validate($request,[
			'bank_name' => 'required',
			'bank_account_type' => 'required',
			'bank_branch' => 'required',
			'bank_account_number' => 'required|alpha_num',
			'bank_ifsc_code' => 'required|alpha_num',
		]);
		$saveBankDetailsData = new BankDetailsModel();
		$saveBankDetailsData->bank_name = $request->bank_name;
		$saveBankDetailsData->bank_account_type = $request->bank_account_type;
		$saveBankDetailsData->bank_branch = $request->bank_branch;
		$saveBankDetailsData->bank_account_number = $request->bank_account_number;
		$saveBankDetailsData->bank_ifsc_code = $request->bank_ifsc_code;
		$saveBankDetailsData->created_by = '1';
		$saveBankDetailsData->updated_by = '1';
		$saveBankDetailsData->created_at = date('Y-m-d H:i:s');
		$saveBankDetailsData->updated_at = date('Y-m-d H:i:s');
		$saveBankDetailsData->save();
		return redirect()->route('bank-details')->with('success','Bank details has been added successfully');
	}
	public function editBankDetails(Request $request)
	{
		$editBankDetailsData = BankDetailsModel::where('bank_detail_id',$request->bank_detail_id)->get();
		return view('admin.edit_bank_details',['editBankDetailsData' => $editBankDetailsData[0]]);
	}
	public function updateBankDeatils(Request $request)
	{
		//dd($request->editId);
		$this->validate($request,[
			'bank_name' => 'required',
			'bank_account_type' => 'required',
			'bank_branch' => 'required',
			'bank_account_number' => 'required|alpha_num',
			'bank_ifsc_code' => 'required|alpha_num',
		]);
		$updateBankDetailsData = BankDetailsModel::where('bank_detail_id',$request->editId)->update(array('status' => '0'));
		$upBankDeatils = Input::all();
		$upBankDeatilsData = array(
			'bank_name' => Input::get('bank_name'),
			'bank_account_type' => Input::get('bank_account_type'),
			'bank_branch' => Input::get('bank_branch'),
			'bank_account_number' => Input::get('bank_account_number'),
			'bank_ifsc_code' => Input::get('bank_ifsc_code'),
			'created_by' => '1',
			'updated_by' => '1',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		);
		//dd($upBankDeatilsData);
		$update = BankDetailsModel::insert($upBankDeatilsData);
		return redirect()->route('bank-details')->with('success','Bank details has been updated successfully');
	}
	public function deleteBankDetails($id)
	{
		$deleteBankDetailsData = BankDetailsModel::where('bank_detail_id',$id)->update(array('status' => '3'));
		return redirect()->route('bank-details')->with('success','Bank details has been deleted successfully');
	}
	public function multipleDeleteBankDetails(Request $request)
	{
		$ids = $request->ids;
        //dd($ids);
		BankDetailsModel::whereIn('bank_detail_id',explode(",",$ids))->update(array('status' => '3'));
		return response()->json(['status'=>true,'message'=>"Bank details deleted successfully."]);
	}
	public function bankCharges()
	{
		$bankChargesData = BankChargesModel::where('status','1')->orderBy('bank_charges_id','DESC')->get();
		return view('admin.bank_charges',['bankChargesData' => $bankChargesData]);
	}
	public function addBankCharges()
	{
		return view('admin.add_bank_charges');
	}
	public function saveBankCharges(Request $request)
	{
		$this->validate($request,[
			'bank_charges_amount' => 'required',
			'start_date' => 'required',
			'end_date' => 'required',
		]);
		$saveBankChargesData = Input::all();
		$saveBankChargesArray = array(
			'bank_charges_amount' => Input::get('bank_charges_amount'),
			'start_date' => Input::get('start_date'),
			'end_date' => Input::get('end_date'),
			'created_by' => '1',
			'updated_by' => '1',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		);
		$insertBankCharges = DB::table('bank_charges')->insert($saveBankChargesArray);
		//dd($insertBankCharges);
		return redirect()->route('bank-charge')->with('success','Bank charge amount has been added successfully');
	}
	public function editBankCharge(Request $request)
	{
		$editBankChargedata = BankChargesModel::where('bank_charges_id',$request->bank_charges_id)->get();
		return view('admin.edit_bank_charges',['editBankChargedata' => $editBankChargedata[0]]);
	}
	public function updateBankCharge(Request $request)
	{
		$updateBankChargeData = BankChargesModel::where('bank_charges_id',$request->editId)->update(array('status' => '0'));
		$upBankCharge = Input::all();
		$upBankChargeData = array(
			'bank_charges_amount' => Input::get('bank_charges_amount'),
			'start_date' => Input::get('start_date'),
			'end_date' => Input::get('end_date'),
			'created_by' => '1',
			'updated_by' => '1',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		);
		$update = BankChargesModel::insert($upBankChargeData);
		return redirect()->route('bank-charge')->with('success','Bank charge amount has been updated successfully');
	}
	public function deleteBankCharge($id)
	{
		$deleteBankDetailsData = BankChargesModel::where('bank_charges_id',$id)->update(array('status' => '3'));
		return redirect()->route('bank-charge')->with('success','Bank charge amount has been deleted successfully');
	}
	public function multipleDeleteBankCharge(Request $request)
	{
		$ids = $request->ids;
        //dd($ids);
		BankChargesModel::whereIn('bank_charges_id',explode(",",$ids))->update(array('status' => '3'));
		return response()->json(['status'=>true,'message'=>"Bank charge amount deleted successfully."]);
	}
	public function achCharges()
	{
		$achChargesAmountData = AchChargeModel::where('status','1')->orderBy('ach_charge_id','DESC')->get();
		return view('admin.ach_charges',['achChargesAmountData' => $achChargesAmountData]);
	}
	public function addAchCharges()
	{
		return view('admin.add_ach_charges');
	}
	public function saveAchChargeAmount(Request $request)
	{
		$this->validate($request,[
			'ach_charges_amount' => 'required',
			'start_date' => 'required',
			'end_date' => 'required',
		]);
		$saveAchChargeAmountData = new AchChargeModel();
		$saveAchChargeAmountData->ach_charges_amount = $request->ach_charges_amount;
		$saveAchChargeAmountData->start_date = $request->start_date;
		$saveAchChargeAmountData->end_date = $request->end_date;
		$saveAchChargeAmountData->created_by = '1';
		$saveAchChargeAmountData->updated_by = '1';
		$saveAchChargeAmountData->created_at = date('Y-m-d H:i:s');
		$saveAchChargeAmountData->updated_at = date('Y-m-d H:i:s');
		$saveAchChargeAmountData->save();
		return redirect()->route('ach-charges')->with('success','Ach cahrge amount has been deleted successfully');
	}
	public function editAchCharge(Request $request)
	{
		$editAchChargeAmountData = 	AchChargeModel::where('ach_charge_id',$request->ach_charge_id)->get();
		return view('admin.edit_ach_charges',['editAchChargeAmountData' => $editAchChargeAmountData[0]]);
	}
	public function updateAchCharge(Request $request)
	{
		$updateAchChargeData = AchChargeModel::where('ach_charge_id',$request->editId)->update(array('status' => '0'));
		$upAchCharge = Input::all();
		$upAchChargeData = array(
			'ach_charges_amount' => Input::get('ach_charges_amount'),
			'start_date' => Input::get('start_date'),
			'end_date' => Input::get('end_date'),
			'created_by' => '1',
			'updated_by' => '1',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		);
		$update = AchChargeModel::insert($upAchChargeData);
		return redirect()->route('ach-charges')->with('success','Ach cahrge amount has been updated successfully');
	}
	public function deleteAchCharge($id)
	{
		$deleteAchChargeData = AchChargeModel::where('ach_charge_id',$id)->update(array('status' => '3'));
		return redirect()->route('ach-charges')->with('success','Ach cahrge amount has been deleted successfully');
	}
	public function multipleDeleteAchCharge(Request $request)
	{
		$ids = $request->ids;
        //dd($ids);
		AchChargeModel::whereIn('ach_charge_id',explode(",",$ids))->update(array('status' => '3'));
		return response()->json(['status'=>true,'message'=>"Ach cahrge amount deleted successfully."]);
	}
	/*public function rePaymentDate()
	{
		return view('admin.re_payment_dates');
	}*/
	public function reserveFunds()
	{
		$reserveFundsData = ReservedFundsModel::where('status','1')->orderBy('reserved_fund_id','DESC')->get();
		return view('admin.reserved_funds',['reserveFundsData' => $reserveFundsData]);
	}
	public function addReserveFunds()
	{
		return view('admin.add_reserved_funds');
	}
	public function saveReserveFunds(Request $request)
	{
		$this->validate($request,[
			'percentage' => 'required|between:0,99.99',
			'start_date' => 'required',
			'end_date' => 'required',
		]);
		$saveReserveFundsData = new ReservedFundsModel();
		$saveReserveFundsData->percentage = $request->percentage;
		$saveReserveFundsData->start_date = $request->start_date;
		$saveReserveFundsData->end_date = $request->end_date;
		$saveReserveFundsData->created_by = '1';
		$saveReserveFundsData->updated_by = '1';
		$saveReserveFundsData->created_at = date('Y-m-d H:i:s');
		$saveReserveFundsData->updated_at = date('Y-m-d H:i:s');
		$saveReserveFundsData->save();
		return redirect()->route('reserve-funds')->with('success','Reserve funds data has been added successfully');
	}
	public function editReserveFunds(Request $request)
	{
		$editReserveFundsData = ReservedFundsModel::where('reserved_fund_id',$request->reserved_fund_id)->get();
		return view('admin.edit_reserved_funds',['editReserveFundsData' => $editReserveFundsData[0]]);
	}
	public function updateReserveFunds(Request $request)
	{
		//dd($request->editId);
		$updateReserveFundsData = ReservedFundsModel::where('reserved_fund_id',$request->editId)->update(array('status' => '0'));
		$upReserveFunds = Input::all();
		$upReserveFundsData = array(
			'percentage' => Input::get('percentage'),
			'start_date' => Input::get('start_date'),
			'end_date' => Input::get('end_date'),
			'created_by' => '1',
			'updated_by' => '1',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		);
		$update = ReservedFundsModel::insert($upReserveFundsData);
		return redirect()->route('reserve-funds')->with('success','Reserve funds data has been added successfully');
	}
	public function deleteReserveFunds($id)
	{
		$deleteAchChargeData = ReservedFundsModel::where('reserved_fund_id',$id)->update(array('status' => '3'));
		return redirect()->route('reserve-funds')->with('success','Reserve funds data has been deleted successfully');
	}
	public function multipleDeleteReserveFunds(Request $request)
	{
		$ids = $request->ids;
        //dd($ids);
		ReservedFundsModel::whereIn('reserved_fund_id',explode(",",$ids))->update(array('status' => '3'));
		return response()->json(['status'=>true,'message'=>"Reserve funds data deleted successfully."]);
	}
	public function listDistrict()
	{
		$listDistrictData = DistrictModel::where('status','1')->get();
		return view('admin.districts',['listDistrictData' => $listDistrictData]);
	}
	public function addDistrict()
	{
		return view('admin.add_district');
	}
	public function saveDistrict(Request $request)
	{
		$this->validate($request,[
			'district_name' => 'required',
		]);
		$svDistrictData = Input::all();
		$saveDistrictData = array(
			'district_name' => Input::get('district_name'),
			'created_by' => '1',
			'updated_by' => '1',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		);
		$insert = DistrictModel::insert($saveDistrictData);
		return redirect()->route('list-district')->with('success','District has been added successfully') ;
	}
	public function editDistrict(Request $request)
	{
		$editDistrictData = DistrictModel::where('district_id',$request->district_id)->get();
		return view('admin.edit_district',['editDistrictData' => $editDistrictData[0]]);
	}
	public function updateDistrict(Request $request)
	{
		//dd($request->editId);
		$updateDistrictData = DistrictModel::where('district_id',$request->editId)->update(array('status' => '0'));
		$upDistrict = Input::all();
		$upDistrictData = array(
			'district_name' => Input::get('district_name'),
			'created_by' => '1',
			'updated_by' => '1',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		);
		$update = DistrictModel::insert($upDistrictData);
		return redirect()->route('list-district')->with('success','District has been updated successfully') ;
	}
	public function deleteDistrict($id)
	{
		$deleteAchChargeData = DistrictModel::where('district_id',$id)->update(array('status' => '3'));
		return redirect()->route('list-district')->with('success','District has been deleted successfully');
	}
	public function multipleDeleteDistrict(Request $request)
	{
		$ids = $request->ids;
        //dd($ids);
		DistrictModel::whereIn('district_id',explode(",",$ids))->update(array('status' => '3'));
		return response()->json(['status'=>true,'message'=>"District deleted successfully."]);
	}
	public function districtArea()
	{
		$districtAreaData =  DB::table('district_areas')
		->select('district_areas.area_id','district_areas.fk_district_id','district_areas.area_name','districts.district_id','districts.district_name')
		->join('districts','districts.district_id','=','district_areas.fk_district_id')
		->where('district_areas.status','1')
		->groupBy('district_areas.fk_district_id')
		->get();
		//dd($districtAreaData);
		return view('admin.district_area',['districtAreaData' => $districtAreaData]);
	}
	public function addDistrictArea()
	{
		$addDistrictAreaData =  DistrictModel::where('status','1')->get();
		return view('admin.add_district_areas',['addDistrictAreaData' => $addDistrictAreaData]);
	}
	public function saveDistrictArea(Request $request)
	{
		$this->validate($request,[
			'area_name' => 'required',
		]);
		$svDistrictArea = Input::all();
		$saveDistrictAreaData = array(
			'fk_district_id' => Input::get('fk_district_id'),
			'area_name' => Input::get('area_name'),
			'created_by' => '1',
			'updated_by' => '1',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		);
		$insert = DistrictAreasModel::insert($saveDistrictAreaData);
		return redirect()->route('list-district-area')->with('success','District Area has been added successfully');
	}
	public function editDistrictArea($id)
	{
		$etDistrictData = DistrictModel::where('district_id',$id)->get();
		$editDistrictAreaData = DistrictAreasModel::where('fk_district_id',$id)->get();
		//dd($editDistrictAreaData);
		return view('admin.edit_district_areas')->with('etDistrictData',$etDistrictData[0])->with('editDistrictAreaData',$editDistrictAreaData[0]);
	}
	public function updateDistrictArea(Request $request)
	{
		$upDistrictAreaData = DistrictAreasModel::where('area_id',$request->editId)->update(array('status' => '0'));
		$updateDistrictAreaData = array(
			'fk_district_id' => Input::get('fk_district_id'),
			'area_name' => Input::get('area_name'),
			'created_by' => '1',
			'updated_by' => '1',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		);
		//dd($updateDistrictAreaData);
		$update = DistrictAreasModel::insert($updateDistrictAreaData);
		return redirect()->route('list-district-area')->with('success','District Area has been updated successfully');
	}
	public function deleteDistrictArea($id)
	{
		$deleteDistrictAreaData = DistrictAreasModel::where('area_id',$id)->update(array('status' => '3'));
		return redirect()->route('list-district-area')->with('success','District Area has been deleted successfully');
	}
	public function multipleDeleteDistrictArea(Request $request)
	{
		$ids = $request->ids;
        //dd($ids);
		DistrictAreasModel::whereIn('area_id',explode(",",$ids))->update(array('status' => '3'));
		return response()->json(['status'=>true,'message'=>"District Area deleted successfully."]);
	}
	public function expenseType()
	{
		$expenseTypeData = ExpenseTypeModel::where('status','1')->get();
		return view('admin.expense_type',['expenseTypeData' => $expenseTypeData]);
	}
	public function addExpenseType()
	{
		return view('admin.add_expense_type');
	}
	public function saveExpenseType(Request $request)
	{
		$this->validate($request,[
			'expense_type' => 'required',
		]);
		$svExpenseType = Input::all();
		$saveExpenseTypeData = array(
			'expense_type' => Input::get('expense_type'),
			'created_by' => '1',
			'updated_by' => '1',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		);
		$insert = ExpenseTypeModel::insert($saveExpenseTypeData);
		return redirect()->route('expense-type')->with('success','Expense type data has been added successfully');
	}
	public function editExpenseType(Request $request)
	{
		$editExpenseType = ExpenseTypeModel::where('expense_type_id',$request->expense_type_id)->get();
		return view('admin.edit_expense_type',['editExpenseType' => $editExpenseType[0]]);
	}
	public function updateExpenseType(Request $request)
	{
		$upExpenseType = ExpenseTypeModel::where('expense_type_id',$request->editId)->update(array('status' => '0'));
		//dd()
		$updateExpenseType = array(
			'expense_type' => Input::get('expense_type'),
			'created_by' => '1',
			'updated_by' => '1',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		);
		$update = ExpenseTypeModel::insert($updateExpenseType);
		return redirect()->route('expense-type')->with('success','Expense type data has been updated successfully');
	}
	public function deleteExpenseType($id)
	{
		$deleteExpenseTypeData = ExpenseTypeModel::where('expense_type_id',$id)->update(array('status' => '3'));
		return redirect()->route('expense-type')->with('success','Expense type data has been deleted successfully');
	}
	public function multipleDeleteExpenseType(Request $request)
	{
		$ids = $request->ids;
        //dd($ids);
		ExpenseTypeModel::whereIn('expense_type_id',explode(",",$ids))->update(array('status' => '3'));
		return response()->json(['status'=>true,'message'=>"Expense type data deleted successfully."]);
	}
	public function incomeType()
	{
		$incomeTypeData = IncomeTypeModel::where('status','1')->orderBy('income_type_id','DESC')->get();
		return view('admin.income_types',['incomeTypeData' => $incomeTypeData]);
	}
	public function addIncomeType()
	{
		return view('admin.add_income_type');
	}
	public function saveIncomeType( Request $request)
	{
		$this->validate($request,[
			'income_type' => 'required',
		]);
		$svIncomeType = Input::all();
		$saveIncomeTypeData = array(
			'income_type' => Input::get('income_type'),
			'created_by' => '1',
			'updated_by' => '1',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		);
		$insert = IncomeTypeModel::insert($saveIncomeTypeData);
		return redirect()->route('income-type')->with('success','Income type data has been added successfully');
	}
	public function editIncomeType(Request $request)
	{
		$editIncomeTypeData = IncomeTypeModel::where('income_type_id',$request->income_type_id)->get();
		return view('admin.edit_income_type',['editIncomeTypeData' => $editIncomeTypeData[0]]);
	}
	public function updateIncomeType(Request $request)
	{
		$this->validate($request,[
			'income_type' => 'required',
		]);
		$upIncomeType = IncomeTypeModel::where('income_type_id',$request->editId)->update(array('status' => '0'));
		$updateIncomeTypeData = array(
			'income_type' => Input::get('income_type'),
			'created_by' => '1',
			'updated_by' => '1',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		);
		$update = IncomeTypeModel::insert($updateIncomeTypeData);
		return redirect()->route('income-type')->with('success','Income type data has been updated successfully');
	}
	public function deleteIncomeType($id)
	{
		$deleteIncomeTypeData = IncomeTypeModel::where('income_type_id',$id)->update(array('status' => '3'));
		return redirect()->route('income-type')->with('success','Income type data has been deleted successfully');
	}
	public function multipleDeleteIncomeType(Request $request)
	{
		$ids = $request->ids;
        //dd($ids);
		IncomeTypeModel::whereIn('income_type_id',explode(",",$ids))->update(array('status' => '3'));
		return response()->json(['status'=>true,'message'=>"Income type data deleted successfully."]);
	}
}
