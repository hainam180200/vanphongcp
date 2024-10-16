<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreTelecom extends Model
{
    protected $table = 'store_telecom';
    protected $fillable = [
        'title',
        'key',
        'image',
        'order',
        'status',
        'gate_id',
    ];
}
