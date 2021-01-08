<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AllBankEntryDetailsModel extends Model
{
    protected $primaryKey = 'all_bank_entry_details_id';

    protected $fillable = ['fk_all_bank_entry_id', 'fk_registration_id', 'ysk_entry', 'payment_type', 'amount', 'fk_behalf_of_payment_id', 'status', 'created_by', 'updated_by'];

    protected $table = 'all_bank_entry_details';
}
