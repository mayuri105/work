<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SahyognidhiManpowerRefundpaymentAmounts extends Model
{
    protected $primaryKey = 'sahyognidhi_manpower_refundpayment_amount_id';

    protected $fillable = ['fk_sahyognidhi_manpower_id', 'first_total_amount', 'second_total_amount', 'first_amount_group1', 'first_amount_group2', 'first_amount_group3','first_amount_group4','first_amount_group5', 'second_amount_group1', 'second_amount_group2', 'second_amount_group3', 'second_amount_group4', 'second_amount_group5', 'admin_charge', 'created_by','updated_by'];

    
}
