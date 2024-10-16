<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreTelecomValue extends Model
{
    protected $table = 'store_telecom_value';
    protected $fillable = [
        'amount',
        'telecom_key',
        'telecom_id',
        'ratio_default',
        'ratio_agency',
        'status',
        'gate_id',
    ];
}
