<?php

namespace App\Models;

use Illuminate\Http\Request;

class Shop extends BaseModel {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'shop';

	/**
	 * The fillable fields for the model.
	 *
	 * @var    array
	 */
	protected $fillable = [

		'idkey',
		'title',
		'domain',
		'note',
		'status',
		'created_at',
	];

}
