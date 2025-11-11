<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipper extends Model
{
    protected $table = 'shippers';

    public $timestamps = true;
    
    protected $fillable = [
        'name',
        'addressl_1',
        'addressl_2',
        'addressl_3',
        'country_name',
        'state_name',
        'city',
        'zip_code',
        'contact_name',
        'contact_email',
        'tele_phone',
        'telephone_ext',
        'toll_free',
        'fax',
        'shipping_hours',
        'appointments',
        'major_inspection_Dir',
        'duplicate_Info',
        'status_ind',
        'notes',
        'internal_notes',
        'as_consignee',
        'acc_sts',
        'user_id',
        'updated_at',
        'created_at'
    ];

     public function country()
    {
        return $this->belongsTo(Country::class, 'country_name', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
