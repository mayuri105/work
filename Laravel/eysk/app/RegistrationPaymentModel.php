<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationPaymentModel extends Model
{
   protected $primaryKey = 'registration_payment_detail_id';

    protected $fillable = ['fk_registration_id', 'fk_reg_bank_name', 'bank_amount', 'ysk_member_bank_name', 'branch_name', 'cheque_number', 'narration', 'registration_payment_status','check_bounce_amount','check_clear_date','transaction_id','status','created_by','updated_by'];

    protected $table = 'registration_payment_details';
}
