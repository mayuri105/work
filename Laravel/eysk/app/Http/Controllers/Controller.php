<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\ModulePageModel;
use DB;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
	 * @author Purvesh Patel
	 * Date: 24 July 2019 11:26 AM
	 */
	protected function getMacAddress(){
		$mac = request()->ip(); 
		return $mac;

		// Turn on output buffering
		/*ob_start();
		//Get the ipconfig details using system commond
		system('ipconfig /all');
		// Capture the output into a variable
		$mycom=ob_get_contents();
		// Clean (erase) the output buffer
		ob_clean();
		$findme = "Physical";
		//Search the "Physical" | Find the position of Physical text
		$pmac = strpos($mycom, $findme);
		// Get Physical Address
		$mac=substr($mycom,($pmac+36),17);
		//Display Mac Address
		echo '<h1>'.$mac.'</h1>';
		return $mac;*/
	}


	/**
     * Description : Create a OTP
     * Created by : @author Purvesh Patel
     * Created Date: 25 July 2019 5:45 PM
     */
	protected function createOTP($length = 6) {
	    $characters = '0123456789';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}


	/**
     * Description : Send a OTP on mobile number
     * Created by : @author Purvesh Patel
     * Created Date: 29 July 2019 5:14 PM
     */
	protected function sendSMS($mobileNumber,$name,$yskId) {
	    $curl = curl_init();
        $data = array('name'=>$name,'yskId' => $yskId);
		$mess = json_encode($data);
		$message = json_decode($mess);
		
	    $url = "http://sms.mobileadz.in/api/push.json?apikey=5ce64d9ed4ab4&route=Transactional&sender=YSKYSK&mobileno=".$mobileNumber."&text=".$message->name.','.$message->yskId;
		curl_setopt_array($curl, array(
		    CURLOPT_URL => $url,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_ENCODING => "",
		    CURLOPT_MAXREDIRS => 10,
		    CURLOPT_TIMEOUT => 30000,
		    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		    CURLOPT_CUSTOMREQUEST => "GET",
		    CURLOPT_HTTPHEADER => array(
		    	"content-type: application/json",
		    ),
		));

		$response 	= curl_exec($curl);
		$err 		= curl_error($curl);

		curl_close($curl);
		//dd($response);
	}
	
	protected function sendSMS1($mobileNumber,$name,$yskId,$totalAmountToPay,$others) {
	    $curl = curl_init();
        $data = array('name'=>$name,'yskId' => $yskId,'totalAmountToPay' => $totalAmountToPay,'others' => $others);
		$mess = json_encode($data);
		$message = json_decode($mess);
		
	    $url = "http://sms.mobileadz.in/api/push.json?apikey=5ce64d9ed4ab4&route=Transactional&sender=YSKYSK&mobileno=".$mobileNumber."&text=".$message->name.','.$message->yskId.','.$message->totalAmountToPay.','.$message->others;
		curl_setopt_array($curl, array(
		    CURLOPT_URL => $url,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_ENCODING => "",
		    CURLOPT_MAXREDIRS => 10,
		    CURLOPT_TIMEOUT => 30000,
		    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		    CURLOPT_CUSTOMREQUEST => "GET",
		    CURLOPT_HTTPHEADER => array(
		    	"content-type: application/json",
		    ),
		));

		$response 	= curl_exec($curl);
		$err 		= curl_error($curl);

		curl_close($curl);
		//dd($response);
	}
	
	function RefundPayment($get18To30,$get31To37,$get38To47,$get48To55,$totalAmount) {
		$ousideserviceadd = array();
		$get18To30Age = $get18To30 * 17.5;
		$get31To37Age = $get31To37 * 22.5;
		$get38To47Age = $get38To47 * 27.5;
		$get48To55Age = $get48To55 * 32.5;

        $totalWeightage = ($get18To30Age + $get31To37Age + $get38To47Age + $get48To55Age);
       
        if($get18To30 > 0){
			$amountGiven18To30 = (($totalAmount * $get18To30Age)/$totalWeightage) / $get18To30;
        }else{
        	$amountGiven18To30 = 0 ;
        }

        if($get31To37 > 0){
			$amountGiven31To37 = (($totalAmount * $get31To37Age)/$totalWeightage) / $get31To37;
		}else{
        	$amountGiven31To37 = 0 ;
        }

		if($get38To47 > 0){	
			$amountGiven38To47 = (($totalAmount * $get38To47Age)/$totalWeightage) / $get38To47;
		}else{
        	$amountGiven38To47 = 0 ;
        }

		if($get48To55 > 0){	
			$amountGiven48To55 = (($totalAmount * $get48To55Age)/$totalWeightage) / $get48To55;
		}else{
        	$amountGiven48To55 = 0 ;
        }

		$ousideserviceadd = [$amountGiven18To30,$amountGiven31To37,$amountGiven38To47,$amountGiven48To55];
		return $ousideserviceadd;

    }
    
	function ExpectedData($refundpayment18To30,$refundpayment31To37,$refundpayment38To47,$refundpayment48To55,$new18To30Register1,$new31To37Register1,$new38To47Register1,$new48To55Register1,$newYskMitra1,$monthcount) {

		$totalExpectedReal = array();
		$perPerson18To30 = $refundpayment18To30 * $new18To30Register1 ;
		$perPerson31To37 = $refundpayment31To37 * $new31To37Register1 ;
		$perPerson38To47 = $refundpayment38To47 * $new38To47Register1 ;
		$perPerson48To55 = $refundpayment48To55 * $new48To55Register1 ;
		$perYskMitra1 = $refundpayment48To55 * $newYskMitra1 ;
		$totalExpected = $perPerson18To30+$perPerson31To37+$perPerson38To47+$perPerson48To55+$perYskMitra1;

		$refundpayment18To30per = $refundpayment18To30/12;
		$refundpayment31To37per = $refundpayment31To37/12;
		$refundpayment38To47per = $refundpayment38To47/12;
		$refundpayment48To55per = $refundpayment48To55/12;
		//dd($monthcount);
		$total18To30per = $refundpayment18To30per *  $monthcount;
		$total31To37per = $refundpayment31To37per *  $monthcount; 	
		$total38To47per = $refundpayment38To47per *  $monthcount;
		$total48To55per = $refundpayment48To55per *  $monthcount;
		$totalyskper 	= $refundpayment48To55per *  $monthcount;
		

		$perPerson18To30real = $total18To30per * $new18To30Register1 ;
		$perPerson31To37real = $total31To37per * $new31To37Register1 ;
		$perPerson38To47real = $total38To47per * $new38To47Register1 ;
		$perPerson48To55real = $total48To55per * $new48To55Register1 ;
		$perPersonYskmitra = $totalyskper * $newYskMitra1 ;

		$totalReal = $perPerson18To30real+$perPerson31To37real+$perPerson38To47real+$perPerson48To55real+$perPersonYskmitra;

		$difference = $totalExpected - $totalReal;
		$totalExpectedReal = [$totalExpected,$totalReal,$difference];
		return $totalExpectedReal;

    }
    
    public function getArray($url,$role_id)
    {
    	$module_array = ModulePageModel::where('page_url',$url)->get();
        //dd($module_array);
    	$accessArray  = array();
        if(!empty($module_array)){

            $module_id    = $module_array[0]->fk_module_id;
            DB::enableQueryLog();
            $permission = ModulePageModel::where('role_permissions.fk_role_id',$role_id)
            ->select(
                'module_pages.page_url as page_url'
            )
            ->leftJoin('role_permissions', 'role_permissions.fk_page_id', '=', 'module_pages.page_id')
            ->get();
            foreach ($permission->toarray() as $key => $value) {
                array_push($accessArray, $value['page_url']);
            }
        }         
        return $accessArray;
    }
	
}
