<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubItem extends BaseModel
{
    use HasFactory;

    protected $table = 'subitems';
    protected $fillable = [
        'id',
        'shop_id',
        'module',
        'item_id',
        'attribute_id',
        'locale',
        'title',
        'content',
        'image',
        'email',
        'price',
        'quantity',
        'author_id',
        'url',
        'order',
        'note',
        'status',
        'created_at',
        'updated_at',
        'ended_at',
    ];

    public function subitem(){
        return $this->belongsTo(Item::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class,'item_id','id');
    }
    public function attribute()
    {
        return $this->belongsTo(Item::class,'attribute_id','id');
    }

    // public static function boot()
    // {
    //     parent::boot();

    //     //set default auto add  scope to query
    //     static::addGlobalScope('global_scope', function (Builder $model){
    //         $model->where('subitems.shop_id', session('shop_id',1));
    //         $model->where('locale', session('locale'));
    //     });
    //     static::saving(function ($model) {
    //         $model->shop_id = session('shop_id');
    //         $model->locale = app()->getLocale();
    //     });
    //     //end set default auto add  scope to query

    //     static::deleting(function($model) {
    //         $model->groups()->sync([]);
    //         return true;
    //     });
    // }
}
