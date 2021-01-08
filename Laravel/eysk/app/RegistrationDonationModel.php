<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationDonationModel extends Model
{
    protected $primaryKey = 'registration_donation_id';

    protected $fillable = ['start_date', 'end_date', 'region_registration_amount', 'yuva_mandal_registration_amount', 'status', 'created_by', 'updated_by'];

    protected $table = 'registration_donations';
}
