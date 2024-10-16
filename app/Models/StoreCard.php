<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreCard extends Model
{
    protected $table = 'store_card';
    protected $fillable = [
        'key',
        'title',
        'amount',
        'serial',
        'pin',
        'user_id',
        'buy_at',
        'ratio',
        'order_id',
        'status',
        'email',
        'expiryDate'
    ];
    public function user(){
        return $this->belongsTo(User::class)->select(['id','fullname_display','email']);

    }
}
