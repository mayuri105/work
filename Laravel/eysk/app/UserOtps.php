<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOtps extends Model
{
    protected $primaryKey = 'user_otp_id';

    protected $table = 'user_otps';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fk_user_id', 'otp'];
}
