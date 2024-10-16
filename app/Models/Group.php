<?php

namespace App\Models;


use App\Traits\Metable;
use Illuminate\Database\Eloquent\Builder;

class Group extends BaseModel
{
    use Metable;

    protected $table = 'groups';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'params' => 'object',
    ];


    protected $fillable = [
        'id',
        'idkey',
        'shop_id',
        'module',
        'module',
        'locale',
        'parent_id',
        'title',
        'slug',
        'is_slug_override',
        'duplicate',
        'description',
        'content',
        'attribute',
        'image',
        'image_extension',
        'image_banner',
        'image_icon',
        'url',
        'type_url',
        'author_id',
        'target',
        'price',
        'params',
        'totalitems',
        'totalviews',
        'order',
        'position',
        'display_type',
        'sticky',
        'is_display',
        'seo_title',
        'seo_description',
        'seo_robots',
        'status',
        'started_at',
        'ended_at',
        'published_at',
        'created_at',
    ];

    protected $attributes = [
        'locale' => 'vi',
    ];

    public function children() {
        return $this->hasMany(static::class, 'parent_id');
    }


    public function items(){

        return $this->belongsToMany(Item::class,'groups_items')->withPivot('order');

    }
    public function items_index(){

        return $this->belongsToMany(Item::class,'groups_items_index')->withPivot('order');

    }

    public function author(){
        return $this->belongsTo(User::class,'id','author_id');
    }


    public static function boot()
    {
        parent::boot();
        //set default auto add  scope to query
        static::addGlobalScope('global_scope', function (Builder $model) {
            $model->where('groups.shop_id', session('shop_id'));
            // $model->where('locale', session('locale'));
        });
        static::saving(function ($model) {
            $model->shop_id = session('shop_id');
            $model->locale = app()->getLocale();
        });
        //end set default auto add  scope to query

        static::deleting(function($group) {
            $group->items()->sync([]);

        });
    }


}
