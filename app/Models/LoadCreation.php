<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoadCreation extends Model
{
    protected $table = 'load_creation';
    
    public $timestamps = true; 

    protected $fillable = [
        'customer_id',
        'user_id',
        'search_terms',
        'dispatcher',
        'load_status',
        'wo',
        'payment_type',
        'type',
        'shipper_rate',
        'pds',
        'fsc_per',
        'fsc',
        'adv_payment',
        'load_type',
        'bill_type',
        'mc_no',
        'equipment_type',
        'carrier_fee',
        'currency',
        'carrier_pds',
        'carrierrate_check',
        'carrierrate',
        'final_carrier_fee',
        'final_shipper_rate'
    ];


    public function charges()
    {
        return $this->hasMany(Charge::class, 'creation_id', 'id');
    }

     public function shippers()
    {
        return $this->hasMany(ShipperDetail::class, 'creation_id', 'id');
    }

    public function consignees()
    {
        return $this->hasMany(ConsigneeDetail::class, 'creation_id', 'id');
    }

     public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
