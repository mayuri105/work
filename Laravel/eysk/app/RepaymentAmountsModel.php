<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepaymentAmountsModel extends Model
{
   protected $primaryKey = 'repayment_amount_id';

    protected $fillable = ['fk_repayment_id', 'fk_registration_id', 'ysk_id', 'start_year', 'end_year', 'repayment_amount', 'delay_charge', 'Cheque_bounce', 'ach_bounce', 'payment_status', 'bounce_status', 'payment_completed', 'created_by','ach_date','fk_region_id','fk_bank_id','cheque_clear_date','cheque_bounce_date','ach_bounce_date','ach_bounce_narration','ach_paid_narration','fk_registration_payment_detail_id'];

    protected $table = 'repayment_amounts';
}
