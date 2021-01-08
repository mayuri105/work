<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SahyognidhiNomineeModel extends Model
{
    protected $primaryKey = 'sahyognidhi_nominee_id';

    protected $fillable = ['fk_sahyognidhi_id', 'first_nominee_name', 'hidden_first_nominee_member_id', 'first_nominee_relation', 'first_nominee_contact_number', 'first_nominee_email', 'second_nominee_name', 'hidden_second_nominee_member_id', 'second_nominee_relation', 'second_nominee_email', 'second_nominee_contact_number', 'ask_first_nominee_family_id', 'ask_first_nominee_member_id', 'ask_first_nominee_name', 'ask_first_nominee_relation', 'ask_first_nominee_email', 'ask_first_nominee_contact_number', 'ask_second_nominee_family_id', 'ask_second_nominee_member_id', 'ask_second_nominee_name', 'ask_second_nominee_relation', 'ask_second_nominee_email', 'ask_second_nominee_contact_number', 'status', 'created_by', 'updated_by'];

    protected $table = 'sahyognidhi_nominee_details';
}
