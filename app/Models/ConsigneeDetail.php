<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsigneeDetail extends Model
{
    protected $primaryKey = 'consignee_id';

    public $timestamps = true; 

    protected $fillable = [
        'creation_id',
        'consignee_id',
        'consignee_location',
        'consignee_date',
        'consignee_time',
        'consignee_description',
        'consignee_type',
        'consignee_quantity',
        'consignee_weight',
        'consignee_value',
        'delivery_notes',
        'consignee_po_number',
        'consignee_pro_miles',
        'consignee_empty',
    ];

     public function loadcreation()
    {
        return $this->belongsTo(LoadCreation::class, 'creation_id', 'id');
    }


    public function consignee()
    {
        return $this->belongsTo(Consignee::class, 'consignee_id', 'id');
    }
}
