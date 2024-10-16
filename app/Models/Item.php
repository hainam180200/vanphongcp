<?php

namespace App\Models;


use App\Traits\Metable;
use Illuminate\Database\Eloquent\Builder;
use DB;

class Item extends BaseModel
{
    use Metable;

    protected $table = 'items';

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
        'ended_at',
        'deleted_at'
    ];
    protected $attributes = [
        'locale' => 'vi'
    ];

    protected $casts = [
        'params' => 'object',
    ];


    protected $fillable = [
        'idkey',
        'shop_id',
        'module',
        'locale',
        'parent_id',
        'title',
        'slug',
        'is_slug_override',
        'duplicate',
        'description',
        'content',
        'image',
        'image_extension',
        'image_banner',
        'image_icon',
        'promotion',
        'insurance',
        'url',
        'url_type',
        'type',
        'author_id',
        'target',
        'price_input',
        'price_old',
        'price',
        'percent_sale',
        'order',
        'params',
        'totalitems',
        'totalviews',
        'position',
        'display_type',
        'sticky',
        'is_display',
        'seo_title',
        'seo_description',
        'seo_robots',
        'seo_keyword',
        'is_point',
        'number_point',
        'status',
        'is_installment',
        'created_at',
        'ended_at',

    ];

    public static function WithGroups()
    {
        $data=DB::table('items')
            ->join('groups_items', 'items.id', '=', 'groups_items.item_id')
            ->join('groups', 'groups.id', '=', 'groups_items.group_id');

        return $data;

    }

    public function groups(){
        return $this->belongsToMany(Group::class,'groups_items')->withPivot('order');
    }
    public function groups_items_index(){
        return $this->belongsToMany(Group::class,'groups_items_index')->withPivot('order');
    }


    public function subitem(){
        return $this->hasMany(SubItem::class,'item_id');
    }

    public function parrent() {
        return $this->belongsTo(static::class, 'parent_id');
    }

    //each category might have multiple children
    public function children() {
        return $this->hasMany(static::class, 'parent_id');
    }

    public function item_attributes()
    {
        return $this->hasMany(Item::class,'parent_id','id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class,'parent_id','id');
    }

    public function group_item()
    {
        return $this->belongsTo(Item::class,'parent_id','id');
    }

    public function author(){
        return $this->belongsTo(User::class,'author_id','id');
    }


    // public static function boot()
    // {
    //     parent::boot();

    //     //set default auto add  scope to query
    //     static::addGlobalScope('global_scope', function (Builder $model){
    //         $model->where('items.shop_id', session('shop_id'));
    //         $model->where('locale', session('locale'));
    //     });
    //     static::saving(function ($model) {
    //         $model->shop_id = session('shop_id');
    //         $model->locale = app()->getLocale();
    //     });
    //     //end set default auto add  scope to query

    //     static::deleting(function($model) {
    //         $model->groups()->sync([]);
    //         $model->subitem()->delete();
    //         return true;
    //     });
    // }


}
