<?php

namespace App\Models;


use Eloquent;
use Illuminate\Database\Eloquent\Builder;

class Order extends BaseModel
{

    protected $table = 'order';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'params' => 'object',
    ];

    protected $fillable = [
        'idkey',
        'shop_id',
        'bank_id',
        'module',
        'locale',
        'payment_type',
        'type',
        'title',
        'description',
        'content',
        'author_id',
        'price',
        'ratio',
        'gate_id',
        'real_received_price',
        'params',
        'ref_id',
        'order',
        'note',
        'processor_id',
        'tranid',
        'status',
        'status_confirm',
    ];

    //one to one
    public function author()
    {
        return $this->belongsTo(User::class,'author_id','id')->select(['id','username','fullname_display','email']);
    }

    //one to one
    public function processor()
    {
        return $this->belongsTo(User::class,'processor_id','id')->select(['id','username','email']);
    }

    public function user_ref()
    {
        return $this->belongsTo(User::class,'ref_id','id')->select(['id','username','email','fullname_display']);
    }

    public function item_ref()
    {
        return $this->belongsTo(Item::class,'ref_id','id')->select(['id','title']);
    }
    public function order_detail(){
        return $this->hasMany(OrderDetail::class,'order_id');
    }
    public function bank()
    {
        return $this->belongsTo(Bank::class,'bank_id','id')->select(['id','username','holder_name','key']);
    }


    public static function boot()
    {
        parent::boot();

        //set default auto add  scope to query
        static::addGlobalScope('global_scope', function (Builder $model){
            $model->where('order.shop_id', session('shop_id'));
        });
        static::saving(function ($model) {
            $model->shop_id = session('shop_id');
        });
        //end set default auto add  scope to query

        static::deleting(function($model) {

        });
    }





}
