<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Districts extends BaseModel
{
    use HasFactory;
    protected $table = 'districts';
    protected $dates = [
		'created_at',
		'updated_at'
	];
    protected $fillable = [
		'name',
		'code',
		'division_type',
		'codename',
		'province_code',
	];
	function province(){
        return $this->belongsTo(Provinces::class,'province_code','code');
    }

    function wards(){
        return $this->hasMany(Wards::class,'district_code','code');
    }
}
