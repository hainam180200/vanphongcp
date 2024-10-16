<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Comment extends BaseModel {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comment';

	/**
	 * The fillable fields for the model.
	 *
	 * @var    array
	 */

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
	protected $fillable = [

		'item_id',
		'author_id',
		'content',
		'comment_parent',
		'create_at',
		'status',
		'module',

	];



    //foreign key of user(user_id)
//    public function user()
//    {
//        return $this->belongsTo(User::class)->select('id','username','email');
//    }

    //foreign key of user(user_id)
    public function user()
    {
        return $this->belongsTo(User::class,'author_id','id')->select(['id','username','email','image']);
    }
    public function item()
    {
        return $this->belongsTo(Item::class,'item_id','id');
//        return $this->belongsTo(Item::class,'item_id')->select('slug','url','title','image');
    }

}
