<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'customer_name',
        'mc_ff',
        'mc_ff_hidden',
        'customer_id',
        'address',
        'address_line2',
        'address_line3',
        'country',
        'state',
        'city',
        'zip_code',
        'ISBillingAddSameAsMailing',
        'bill_address',
        'bill_address_line2',
        'bill_address_line3',
        'bill_country',
        'bill_state',
        'bill_city',
        'bill_zip_code',
        'primary_contact',
        'telephone',
        'extn',
        'email',
        'toll_free',
        'fax',
        'secondary_contact',
        'secondary_email',
        'bill_mail',
        'secondary_telephone',
        'secondary_extn',
        'acc_sts',
        'urs',
        'black_listed',
        'is_broker',
        'curr_setting',
        'payment_terms',
        'credit_limit',
        'sales_rep',
        'factoring_company',
        'federal_id',
        'workers_comp',
        'website_url',
        'show_tel_tax',
        'as_shipper',
        'as_consignee',
        'internal_notes',
        'show_miles_quote',
        'rate_type',
        'fsc_type',
        'fsc_rate',
        'created_by',
        'created_name',
        'created_date',
        'created_datetime',
        'last_update_date'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country', 'id');
    }

    public function loads()
    {
        return $this->hasMany(LoadCreation::class, 'customer_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
