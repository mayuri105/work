<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SahyognidhiManpowerModel extends Model
{
    protected $primaryKey = 'sahyognidhi_manpower_id';

    protected $fillable = ['start_year', 'end_year', 'total_sahyognidhi_request', 'total_sahyognidhi_amount', 'drop_ratio_percentage', 'round_up_drop_ratio_amount', 'actual_drop_ratio_amount', 'reserve_fund_percentage', 'reserve_fund_amount', 'last_year_reserve_fund_amount', 'total_amount', 'status','created_by','total_group1_people','total_group2_people','total_group3_people','total_group4_people','total_group5_people','created_by','updated_by'];

    protected $table = 'sahyognidhi_manpowers';
}
