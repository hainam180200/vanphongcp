<?php

namespace App\Models;


use Eloquent;
use Illuminate\Database\Eloquent\Builder;

class Txns extends BaseModel
{

    //Bảng biến động số dư của user
	protected $table = 'txns';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
	protected $fillable = [
		'shop_id',
		'trade_type',
		'user_id',
		'order_id',
		'amount',
		'last_balance',
		'description',
		'ip',
		'is_add',
		'is_refund',
		'status',

	];

	//foreign key of user(user_id)
    public function user()
    {
        return $this->belongsTo(User::class)->select('id','username','email','fullname_display');
    }

    public function txnsable()
    {
        return $this->morphTo();
    }



    public static function boot()
    {
        parent::boot();

        //set default auto add  scope to query
        static::addGlobalScope('global_scope', function (Builder $model) {
            $model->where('txns.shop_id', session('shop_id'));
        });
        static::saving(function ($model) {
            $model->shop_id = session('shop_id');
            $model->ip = \Request::getClientIp();
        });
        //end set default auto add  scope to query

    }



}
