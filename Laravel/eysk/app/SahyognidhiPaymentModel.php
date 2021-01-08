<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SahyognidhiPaymentModel extends Model
{
    protected $primaryKey = 'sahyognidhi_payment_id';

    protected $fillable = ['fk_sahyognidhi_id', 'nominee_member_id', 'payment_give_nominee_name', 'nominee_ysk_id', 'sahyognidhi_payment_date', 'fk_bank_id', 'sahyognidhi_amount', 'cheque_clearence_date', 'close_reason', 'reason_selection', 'payment_status', 'status', 'after_half_disiability', 'created_by', 'updated_by'];

    protected $table = 'sahyognidhi_payments';
}
