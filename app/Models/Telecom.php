<?php

namespace App\Models;


use Eloquent;

class Telecom extends BaseModel
{

	protected $table = 'telecom';
    protected $fillable = [
        'title',
        'image',
        'key',
        'ratio',
        'type_charge',
        'seri',
        'order',
        'gate_id',
        'note',
        'status',

    ];

    public function telecom_value(){
        return $this->hasMany('App\Models\TelecomValue','telecom_id','id');

    }
}
