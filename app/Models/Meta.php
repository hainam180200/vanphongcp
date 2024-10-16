<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Meta extends Model
{
    public $timestamps = false;

    protected $table = 'meta';

    protected $fillable = [
        'metable_id',
        'metable_type',
        'key',
        'value',
    ];

    protected $attributes = [
        'value' => '',
    ];

    public function metable(): MorphTo
    {
        return $this->morphTo();
    }
    public function user()
    {
        return $this->belongsTo(User::class,'metable_id','id');
    }
}
