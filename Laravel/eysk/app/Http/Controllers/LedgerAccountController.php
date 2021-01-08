<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LedgerAccountModel;
use App\GroupModel;
use Input;
use Session;
use Auth;
class LedgerAccountController extends Controller
{
    public function __construct()
	{
		$this->middleware('checkLogin');
	} 
	
    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function ledgerAccount()
    {
        Session::forget('region_name');
		Session::forget('division_name');
		Session::forget('samaj_zone_name');
		Session::forget('a');
		$accessData = $this->getArray('ledger-account',Auth::user()->fk_role_id);
    	$getLedgerAccount = LedgerAccountModel::where('ledger_accounts.status','1')
    					->select('ledger_accounts.*',
    						'groups.group_name',
    					)
    					->leftJoin('groups','groups.group_id','=','ledger_accounts.fk_group_id')
    					->orderBy('ledger_accounts.ledger_account_id','DESC')
    					->get();
    	return view('admin.ledger_account')->with('getLedgerAccount',$getLedgerAccount)->with('accessData',$accessData);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function addLedgerAccount()
    {
        $accessData = $this->getArray('ledger-account',Auth::user()->fk_role_id);
    	$getGroupName = GroupModel::where(['groups.status'=>1])
		->select(
			'groups.*',
			'groups_new.group_name as parent_menu_title'
		)
		->leftJoin('groups as groups_new', 'groups.fk_group_id', '=', 'groups_new.group_id')
		->where('groups.fk_group_id', '=', '0')
		->get();

		$getSubGroupName = GroupModel::where(['groups.status'=>1])
		->select(
			'groups.*',
			'groups_new.group_name as parent_menu_title'
		)
		->leftJoin('groups as groups_new', 'groups.fk_group_id', '=', 'groups_new.group_id')
		->where('groups.fk_group_id', '!=', 'groups_new.group_id')
		->get();

    	return view('admin.ledger_account_add')->with('getGroupName',$getGroupName)->with('getSubGroupName',$getSubGroupName)->with('accessData',$accessData);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function saveLedgerAccount(Request $request)
    {
    	$this->validate($request,[
			'legder_name' => 'required|unique:ledger_accounts,legder_name,3,status',
			'fk_group_id' => 'required',
		]);
    	LedgerAccountModel::create([
    		'legder_name' => strtoupper(Input::get('legder_name')),
    		'fk_group_id' => Input::get('fk_group_id'),
    		'created_by'  => Auth::user()->user_id,
    	]);
    	return redirect()->route('ledger-account')->with('success','Ledger Account details has been added successfully.');
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function editLedgerAccount(Request $request)
    {
        $accessData = $this->getArray('ledger-account',Auth::user()->fk_role_id);
    	$getGroupName = GroupModel::where(['groups.status'=>1])
		->select(
			'groups.*',
			'groups_new.group_name as parent_menu_title'
		)
		->leftJoin('groups as groups_new', 'groups.fk_group_id', '=', 'groups_new.group_id')
		->where('groups.fk_group_id', '=', '0')
		->get();

		$getSubGroupName = GroupModel::where(['groups.status'=>1])
		->where('groups.group_id','!=',$request->group_id)
		->select(
			'groups.*',
			'groups_new.group_name as parent_menu_title'
		)
		->leftJoin('groups as groups_new', 'groups.fk_group_id', '=', 'groups_new.group_id')
		->where('groups.fk_group_id', '!=', 'groups_new.group_id')
		//->where('groups_new.group_id','<>',$request->group_id)
		->get();
		//dd($getSubGroupName->toArray());
		$editLedgerAccountData = LedgerAccountModel::where('status','1')->where('ledger_account_id',$request->ledger_account_id)->first();
		return view('admin.ledger_account_edit')->with('getGroupName',$getGroupName)->with('getSubGroupName',$getSubGroupName)->with('editLedgerAccountData',$editLedgerAccountData)->with('accessData',$accessData);
    }

    /**
	 * @author Reshmi Das
	 * Date: 
	 */
    public function updateLedgerAccount(Request $request)
    {
    	$this->validate($request,[
			'legder_name' => 'required|unique:ledger_accounts,legder_name,'.$request->editId.',ledger_account_id,status,1',
		]);
		LedgerAccountModel::where('ledger_account_id',$request->editId)->update(array(
			'legder_name' => strtoupper(Input::get('legder_name')),
			'fk_group_id' => Input::get('fk_group_id'),
			'updated_by'  => Auth::user()->user_id,
		));
		return redirect()->route('ledger-account')->with('success','Ledger Account details has been updated successfully.');
    }
}
