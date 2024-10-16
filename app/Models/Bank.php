<?php

namespace App\Models;


use Eloquent;

class Bank extends BaseModel
{

	protected $table = 'bank';
	protected $dates = [
		'updated_at',
		'deleted_at'
	];
	protected $fillable = [
		'title',
		'idkey',
		'key',
		'username',
		'password',
		'holder_name',
		'image',
		'bank_type',
		'fee',
		'fee_type',
		'status',
	];

}
