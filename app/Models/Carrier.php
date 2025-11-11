<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
     protected $table = 'carriers';
    public $timestamps = true; 

    protected $fillable = [
        'user_id',
        'carrier_name',
        'mc_ff',
        'mc_ff_hidden',
        'dot',
        'address',
        'address_line2',
        'address_line3',
        'country',
        'state',
        'city',
        'zip_code',
        'contact_name',
        'email',
        'telephone',
        'extn',
        'toll_free',
        'fax',
        'payment_terms',
        'tax_id',
        'username',
        'password',
        'urs',
        'factoring_company',
        'notes',
        'acc_sts',
        'load_type',
        'black_listed',
        'corporation',
        'lib_company',
        'lib_policy_no',
        'lib_exp_date',
        'lib_telephone',
        'lib_extn',
        'lib_contact',
        'lib_liability',
        'lib_notes',
        'ins_com_same_lib',
        'ins_company',
        'ins_policy_no',
        'ins_exp_date',
        'ins_telephone',
        'ins_extn',
        'ins_contact',
        'ins_liability',
        'ins_notes',
        'cargo_com_same_lib',
        'cargo_company',
        'cargo_policy_no',
        'cargo_exp_date',
        'cargo_telephone',
        'cargo_extn',
        'cargo_liability',
        'cargo_contact',
        'cargo_notes',
        'wsib',
        'fmcsa_ins_com',
        'wsib_policy_no',
        'wsib_exp_date',
        'wsib_type',
        'wsib_coverage',
        'wsib_telephone',
        'best_rating',
        'primary_name',
        'primary_telephone',
        'primary_email',
        'sec_name',
        'sec_telephone',
        'sec_email',
        'size_of_fleet',
        'main_notes',
        'created_at',
        'approve_sts'
    ];


    public function fleetDetails()
    {
        return $this->hasMany(CarrierFleetDetail::class, 'carrier_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
