<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wards extends BaseModel
{
    use HasFactory;
    protected $table = 'wards';
    protected $dates = [
		'created_at',
		'updated_at'
	];
    protected $fillable = [
		'name',
		'code',
		'division_type',
		'codename',
		'district_code',
	];
    function district(){
        return $this->belongsTo(Districts::class,'district_code','code');
    }
}
