<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FiftyYearModel extends Model
{
    protected $primaryKey = 'ysk_transfer_id';

    protected $fillable = ['fk_registration_id', 'old_member_name', 'old_member_ysk_id', 'fk_old_member_region_id', 'old_member_registration_fees', 'new_member_name', 'new_member_ysk_id', 'fk_new_member_region_id', 'new_member_registartion_fees', 'difference_amount', 'status','created_by', 'updated_by'];

    protected $table = 'ysk_transfer';
}
