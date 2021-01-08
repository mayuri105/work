<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'user_id';

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fk_role_id', 'fk_karyakarta_id', 'fk_employee_id', 'ysk_id', 'family_id','name','email','password','phone_number','gender','photo','fk_regional_id','fk_division_id','fk_yuva_mandal_id','first_time_login','mac_address','status','account_create_date','account_close_date','created_by','updated_by'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password','remember_token'];
}
