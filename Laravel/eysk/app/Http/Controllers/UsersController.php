<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $user;
	  public function __construct(User $user)
    {
        $this->user = $user;
    }

     public function getUsersForDataTable(Request $request)
    {
        //$users = $this->user->all();
        $query = $this->user->orderBy('user_id', 'asc');
        //$users = $query->paginate(20);
        return datatables($query)->make(true);
         // dd($users);
        //return UserResource::collection($users);
    }
    public function test(){
        //dd(1);
            return view('welcome');
    }
}
