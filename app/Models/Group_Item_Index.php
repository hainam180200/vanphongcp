<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group_Item_Index extends BaseModel
{
    protected $table = 'groups_items_index';
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'shop_id',
        'group_id',
        'item_id',
        'order',
    ];

    public static function  MappingTable(){
		return parent::leftJoin('groups','groups.id','=','groups_items_index.group_id')
			->leftJoin('items','items.id','=','groups_items_index.item_id');
	}

    public static function boot()
	{
		parent::boot();
		static::deleting(function($group) {
			$group->items()->sync([]);
			return true;
		});
	}
	public function parent() {
		return $this->belongsToOne(static::class, 'parrent_id');
	}
	public function children() {
		return $this->hasMany(static::class, 'parrent_id');
	}

    public function group()
    {
        return $this->belongsTo(Group::class,'group_id','id');
    }
    public function item()
    {
        return $this->belongsTo(Item::class,'item_id','id')->select('id','title','image','order','url','slug','price','price_old','price_input','percent_sale','status','url_type','target','totalviews','description','content','promotion','is_point','number_point');
    }
}
