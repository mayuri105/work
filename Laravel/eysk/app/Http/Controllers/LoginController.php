<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserOtps;
use App\LoginLogs;
use App\RegistrationModel;
use Hash;
use Auth;
use Redirect;
use Session;
use Validator;
use Input;

class LoginController extends Controller{
	/**
	 * @author Purvesh Patel
	 * Date: 22 July 2019 4:29 PM
	 */
	public function login(){
		return view('signin');
	}
	
	public function userLogin(){
		return view('user_signin');
	}


	/**
	 * @author Purvesh Patel
	 * Date: 24 July 2019 11:26 AM
	 */
	public function loginAuthentications(Request $request) {
		//dd($this->getMacAddress());
		$rules = array(
			'email' 	=> 'required',
			'password' 	=> 'required' 
		);
		$validator = Validator::make(Input::all(),$rules);
		if($validator->fails()) {
			return Redirect::back()->withErrors($validator,'login')->withInput();
		}
		else{
			if(Auth::attempt(array(
				'email' 	=> $request->get('email'),
				'password' 	=> $request->get('password')
			))){
				//dd(Auth::user()->email);
				$userData = User::where('email',$request->get('email'))->get()->toArray();
				//dd($userData);
				if(is_array($userData) && count($userData) > 0){
					
					$loginLogCount = LoginLogs::where([['fk_user_id','=',$userData[0]['user_id']],['login_date_time','=',date("Y-m-d")]])->get()->toArray();
					if(is_array($loginLogCount) && count($loginLogCount) >= 10){
						Session::flash('error',"Your daily login limit exceeded, Please try tomorrow.");
						return Redirect::back();
					}
					else{
						$macAddress = $this->getMacAddress();
						//dd($macAddress);
						if($userData[0]['mac_address'] == $macAddress){
							$userSesData = [
							    "user_id" 		=> $userData[0]['user_id'],
							    "fk_role_id" 	=> $userData[0]['fk_role_id'],
							    "ysk_id" 		=> $userData[0]['ysk_id'],
							    "family_id" 	=> $userData[0]['family_id'],
							    "name" 			=> $userData[0]['name'],
							    "email" 		=> $userData[0]['email'],
							    "phone_number" 	=> $userData[0]['phone_number'],
							    "gender" 		=> $userData[0]['gender'],
							    "photo" 		=> $userData[0]['photo']
							];

							LoginLogs::create([
					            'fk_user_id' 		=> $userData[0]['user_id'],
					            'mac_address' 		=> $macAddress,
					            'login_date_time' 	=> date("Y-m-d")
					        ]);
							session()->put('auth_user', $userSesData);
							return redirect()->route('dashboard');
						}
						else{
							UserOtps::where([['fk_user_id','=',$userData[0]['user_id']]])->delete();
							$otpNumber = $this->createOTP();
							UserOtps::create([
					            'fk_user_id' 	=> $userData[0]['user_id'],
					            'otp' 			=> $otpNumber
					        ]);
					        $userOtp = [
							    "user_id" 	=> $userData[0]['user_id'],
							    "otp" 		=> $otpNumber
							];
							session()->put('user_otp', $userOtp);
							//$this->sendSMS($userData[0]['phone_number'],$otpNumber." is your verification code for yuva sangh.");
							return redirect()->route('dashboard');
						}
					}
				}
				else{
					Session::flash('error',"Invalid Credentials, Please try again.");
					return Redirect::back()->withInput(Input::except('password'));
				}
			}
			else{
				Session::flash('error',"Invalid Credentials, Please try again.");
				return Redirect::back()->withInput(Input::except('password'));
			}
		}
	}


	/**
	 * @author Purvesh Patel
	 * Date: 24 July 2019 5:15 PM
	 */
	public function otpVerification() {
		//dd(Session::get('user_otp'));
		return view('otp_verification');
	}

	/**
	 * @author Purvesh Patel
	 * Date: 24 July 2019 5:15 PM
	 */
	public function otpAuthentication(Request $request) {
		$rules = array(
			'otp' 	=> 'required'
		);
		$validator = Validator::make(Input::all(),$rules);
		if($validator->fails()) {
			return Redirect::back()->withErrors($validator,'otp_verification')->withInput();
		}
		else{
			$otpData = UserOtps::where([['fk_user_id','=',Session::get('user_otp')['user_id']]])->get()->toArray();
			//dd($otpData);
			//Session::forget('save_step_data');
			if($otpData['0']['otp'] == $request->get('otp')){
				
				UserOtps::where([['fk_user_id','=',Session::get('user_otp')['user_id']]])->delete();
				
				$userData 	= User::where('user_id',Session::get('user_otp')['user_id'])->get()->toArray();
		        
		        $macAddress = $this->getMacAddress();
		        
		        User::where('user_id', $userData[0]['user_id'])->update(array(
					'mac_address'    =>  $macAddress
				));
				$userSesData = [
				    "user_id" 		=> $userData[0]['user_id'],
				    "fk_role_id" 	=> $userData[0]['fk_role_id'],
				    "ysk_id" 		=> $userData[0]['ysk_id'],
				    "family_id" 	=> $userData[0]['family_id'],
				    "name" 			=> $userData[0]['name'],
				    "email" 		=> $userData[0]['email'],
				    "phone_number" 	=> $userData[0]['phone_number'],
				    "gender" 		=> $userData[0]['gender'],
				    "photo" 		=> $userData[0]['photo']
				];

				LoginLogs::create([
		            'fk_user_id' 		=> $userData[0]['user_id'],
		            'mac_address' 		=> $macAddress,
		            'login_date_time' 	=> date("Y-m-d")
		        ]);

				session()->put('auth_user', $userSesData);
				Session::forget('save_step_data');
				return redirect()->route('dashboard');
			}
			else{
				Session::flash('error',"Invalid OTP, Please try again.");
				return Redirect::back()->withInput();
			}
		}
	}

	/**
	 * @author Purvesh Patel
	 * Date: 24 July 2019 11:43 AM
	 */
	public function logout() {
		Session::flush();
		Auth::logout();
		Session::forget('save_step_data');
		return redirect()->route('login');
	}
	
	/**
	 * @author Purvesh Patel
	 * Date: 24 July 2019 11:43 AM
	 */
	public function mac() {
	    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        dd($ip);
	}
	
	public function userLoginAuthentications(Request $request) {
		//dd($this->getMacAddress());
		$rules = array(
			'ysk_id' 	=> 'required',
			'password' 	=> 'required' 
		);
		$validator = Validator::make(Input::all(),$rules);
		if($validator->fails()) {
			return Redirect::back()->withErrors($validator,'userpanel')->withInput();
		}
		else{
			$userData = RegistrationModel::where('ysk_id',$request->get('ysk_id'))->orWhere('ysk_id',$request->get('pre_ysk_id'))->first();
			
			if($userData['ysk_id'] != ''){
				$userDataForLogin = RegistrationModel::where([['status','!=','3'],['status','!=','0']])->where('ysk_id',$request->get('ysk_id'))->where('password',$request->get('password'))->first();
				$id =$userDataForLogin['registration_id'];
				//dd($id);
				if($userDataForLogin != ''){
					return redirect()->route('user-dashboard',$id);
				}
				else{
					Session::flash('error',"Invalid Credentials, Please try again.");
					return Redirect::back()->withInput(Input::except('password'));
				}
			}
			elseif ($userData['ysk_id'] == '') {
				$userDataForLogin = RegistrationModel::where([['status','!=','3'],['status','!=','0']])->where('pre_ysk_id',$request->get('ysk_id'))->where('password',$request->get('password'))->first();
				$id = $userDataForLogin['registration_id'];
				if($userDataForLogin != ''){
					return redirect()->route('user-dashboard',$id);
				}
				else{
					Session::flash('error',"Invalid Credentials, Please try again.");
					return Redirect::back()->withInput(Input::except('password'));
				}

			}
			else{
				dd(1);
			}
    	}
    }
}
