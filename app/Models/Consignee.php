<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consignee extends Model
{
    protected $table = 'consignee';
    
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
        'consignee_hours',
        'appointments',
        'major_inspection_Dir',
        'duplicate_Info',
        'as_shipper',
        'status_ind',
        'notes',
        'user_id',
        'internal_notes',
        'acc_sts'
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
