<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepaymentAchsModel extends Model
{
    protected $primaryKey = 'repayment_ach_id';

    protected $fillable = ['fk_repayment_id', 'fk_registration_id', 'ysk_id', 'start_year', 'end_year', 'repayment_amount', 'delay_charge', 'Cheque_bounce', 'ach_bounce', 'payment_completed', 'created_by'];

    protected $table = 'repayment_achs';
}
