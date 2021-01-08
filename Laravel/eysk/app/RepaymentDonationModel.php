<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepaymentDonationModel extends Model
{
    protected $primaryKey = 'repayment_donations_id';

    protected $fillable = ['start_date', 'end_date', 'region_repayment_amount', 'yuva_mandal_repayment_amount', 'status', 'created_by', 'updated_by'];

    protected $table = 'repayment_donations';
}
