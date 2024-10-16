<?php

namespace App\Models;


use Eloquent;

class Withdraw extends BaseModel
{

	protected $table = 'withdraw';
	protected $dates = [
		'updated_at',
		'deleted_at'
	];
	protected $fillable = [
		'user_id',
		'bank_title',
		'bank_type',
		'holder_name',
		'account_number',
		'account_vi',
		'bank_id',
		'brand',
		'amount',
		'fee',
		'amount_passed',
		'description',
		'admin_note',
		'processor_id',
		'status',
		'source_money',
		'source_bank',
		'txns_id',
	];



    public function bank(){
        return $this->belongsTo('App\Models\Bank');

    }

    //foreign key of user(user_id)
    public function user()
    {
        return $this->belongsTo(User::class)->select('id','username','email','fullname_display');
    }
    //one to one
    public function processor()
    {
        return $this->belongsTo(User::class,'processor_id','id')->select(['id','username','email']);;
    }

    public function txns()
    {
        return $this->morphOne(Txns::class, 'txnsable');
    }
}
