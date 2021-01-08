<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationDevelopmentFundAmount extends Model
{
    protected $primaryKey = 'registration_development_fund_id';

    protected $fillable = ['start_year', 'end_year', 'fk_region_id', 'fk_yuva_mandal_id', 'total_registration', 'region_development_amount', 'yuva_mandal_development_amount', 'total_amount','status', 'created_by', 'updated_by'];

    protected $table = 'registration_development_fund';
}
