<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallmentDetail extends Model
{
    protected $table = 'installment_detail';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $fillable = [
        'module',
        'order_id',
        'installment_id',
        'value',
    ];

    public function installment()
    {
        return $this->belongsTo(Installment::class,'installment_id','id')->select(['id','type','title','image','papers','fee','ratio','status']);
    }
}
