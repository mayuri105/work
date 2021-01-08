<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartialPermanentDisabilitySahyognidhiPaymentsModel extends Model
{
    protected $primaryKey = 'ppdsp_id';

    protected $fillable = ['name', 'ysk_id','claim_amount','given_amount','outstanding_amount','claim_person’s_name','claim_person’s_contact_number','claim_person’s_address','given_date','next_claim_amount_date','status','created_by','updated_by',''];

    protected $table = 'partial_permanent_disability_sahyognidhi_payments';
}
