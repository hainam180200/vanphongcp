<?php

namespace App\Models;


use Eloquent;

class TelecomValue extends BaseModel
{

	protected $table = 'telecom_value';
    protected $fillable = [
        'telecom_id',
        'amount',
        'telecom_key',
        'ratio_true_amount',
        'ratio_false_amount',
        'agency_ratio_true_amount',
        'agency_ratio_false_amount',
        'type_charge',
        'status'
    ];





}
