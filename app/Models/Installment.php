<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    protected $table = 'installment';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $fillable = [
        'title',
        'image',
        'type',
        'papers',
        'fee',
        'ratio',
        'status',
        'value',
    ];
}
