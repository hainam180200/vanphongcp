<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PlusMoney extends BaseModel {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'plus_money';

	/**
	 * The fillable fields for the model.
	 *
	 * @var    array
	 */
	protected $fillable = [

		'shop_id',
		'module',
		'user_id',
        'amount',
        'source_type',
        'source_bank',
        'status',
        'processor_id',
        'is_add',
        'description',
        'created_at',

	];



	public function user()
	{
		return $this->belongsTo(User::class, 'user_id')->select(['id','username','email']);
	}

    public function processor()
    {
        return $this->belongsTo(User::class, 'processor_id')->select(['id','username','email']);
    }


    public function txns()
    {
        return $this->morphOne(Txns::class, 'txnsable');
    }


    public static function boot()
    {
        parent::boot();

        //set default auto add  scope to query
        static::addGlobalScope('global_scope', function (Builder $model){
            $model->where('plus_money.shop_id', session('shop_id'));

        });
        static::saving(function ($model) {
            $model->shop_id = session('shop_id');

        });
        //end set default auto add  scope to query

        static::deleting(function($model) {

        });
    }

}
