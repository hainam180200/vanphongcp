<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends BaseModel
{
    protected $table = 'order_detail';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $fillable = [
        'idkey',
        'shop_id',
        'module',
        'order_id',
        'item_id',
        'quantity',
        'params',
        'value',
        'unit_price',
        'discount_percentage',
        'discount_price',
        'status'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class,'item_id','id')->select(['module','title','description','content','image','url','slug','price','price_old','params','promotion']);
    }
}
