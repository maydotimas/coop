<?php

namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';
    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'civil_status',
        'birth_date',
        'birth_place',
        'house_number',
        'street',
        'subdivision',
        'barangay',
        'city',
        'province',
        'region',
        'zip_code',
        'email_address',
        'contact_number',
        'department',
        'department_others',
        'service_years',
        'service_status',
        'rank_unit',
        'gross_income',
        'pay_jurisdiction',
        'pay_slip_account_no',
        'pledge_subscription',
        'initial_capital_payment',
        'user_id',
        'membership_fee',
    ];
}
