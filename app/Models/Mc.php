<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mc extends Model
{
    protected $table = 'mc';

    protected $primaryKey = 'id';

    public $timestamps = true; 

    protected $fillable = [
        'mc_no',
        'user_id',
        'carrier_name',
        'commodity_type',
        'commodity_value',
        'equ_type',
        'com_value_prf',
        'created_datetime',
        'approve_sts'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
