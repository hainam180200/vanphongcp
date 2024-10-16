<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinces extends BaseModel
{
    use HasFactory;
    protected $table = 'provinces';
    protected $dates = [
		'created_at',
		'updated_at'
	];
    protected $fillable = [
		'name',
		'code',
		'division_type',
		'codename',
		'phone_code',
	];
    function districts(){
        return $this->hasMany(Districts::class,'province_code','code');
    }
}
