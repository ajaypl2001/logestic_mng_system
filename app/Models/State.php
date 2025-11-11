<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';

    public $timestamps = true;

    protected $fillable = [
        'cou_id',
        'state',
        'state_sts',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'cou_id');
    }

     public function customers()
    {
        return $this->hasMany(Customer::class, 'state', 'id');
    }
}
