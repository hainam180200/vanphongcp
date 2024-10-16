<?php

namespace App\Models;


use Eloquent;
use Illuminate\Database\Eloquent\Builder;

class Charge extends BaseModel
{

	protected $table = 'charge';
	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at'
	];
	protected $fillable = [
		'type_charge',
		'user_id',
		'gate_id',
		'telecom_key',
		'pin',
		'serial',
        'declare_amount',
		'amount',
		'ratio',
		'real_received_amount',
		'tnxs_id',
		'response_code',
		'response_mess',
		'tranid',
		'description',
		'ip',
		'processor_username',
		'process_at',
		'process_log',
		'api_type',
        'request_at',
        'finish_at',
		'status',
		'status_callback',
	];


    public function user(){
        return $this->belongsTo(User::class)->select(['id','username','email','fullname_display']);

    }
    public function processor(){
        return $this->belongsTo(User::class,'processor_id','id')->select(['id','username','email','fullname_display']);

    }

    public function txns()
    {
        return $this->morphOne(Txns::class, 'txnsable');
    }

    public static function boot()
    {
        parent::boot();
        ////set default auto add  scope to query
        static::addGlobalScope('global_scope', function (Builder $model) {
            $model->where('charge.shop_id', session('shop_id'));
        });
        static::saving(function ($model) {
            $model->shop_id = session('shop_id');
        });

    }

}
