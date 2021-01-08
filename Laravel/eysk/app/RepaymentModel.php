<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepaymentModel extends Model
{
    protected $primaryKey = 'repayment_id';

    protected $fillable = ['repayment_id', 'fk_registration_id', 'age', 'amount', 'status', 'created_by', 'updated_by','start_year','end_year','phone_number_first','fk_region_id','name','ysk_id','ysk_confirmation_date','payment_status','payment_completed','bounce_status','payment_paid_date','ach_date','fk_bank_id'];

    protected $table = 'repayments';
}
