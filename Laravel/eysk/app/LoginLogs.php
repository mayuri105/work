<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginLogs extends Model
{
    protected $primaryKey = 'login_log_id';

    protected $table = 'login_logs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fk_user_id', 'mac_address', 'login_date_time'];
}
