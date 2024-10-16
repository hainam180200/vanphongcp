<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Favourite;
use App\Models\User;
use App\Models\UserAction;
use Auth;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Group_Item;
use App\Models\SubItem;
use App\Models\Item;
use App\Models\Installment;
use App\Models\InstallmentDetail;
use ArrayObject;
use App\Library\HelpersDevice;
use function Doctrine\Common\Cache\Psr6\get;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
    public function getSearch(Request $request){
        if($request->ajax()){
            if($request->q == ""){
                return response()->json([
                    'status' => '0',
                    'message' => 'Không có dữ liệu'
                ]);
            }
            $paginate = 6;
            $data = Item::where('module','product')
                ->where(function ($query) use ($request){
                    $query->where('title', 'LIKE', '%' . $request->q . '%');
                })
                ->where('status',1)
                ->orderBy('id','desc')
                ->select('title','image','slug','url','price','price_old')->get();

            return response()->json([
                'status' => '1',
                'data' => $data,
            ]);

        }
        else{
            return response()->json([
                'status' => '0',
                'message' => 'Bạn không có quyền truy cập !'
            ]);
        }
    }
    public function category(Request $request)
    {
        $search = $request->get('q');
        $items_prd = Item::with(array('groups' => function($query){
            $query->where('module','product-category');
        }));

        $items_prd = $items_prd->where('module','product')
            ->where('status', '=', 1);

        if(isset($search)){
            $items_prd = $items_prd->where('title', 'LIKE', '%' . $request->q . '%');
        }
        $items_prd = $items_prd->orderBy('id','desc')
            ->orderBy('order')
            ->select('id','title','image','order','url','slug','price','price_old','price_input','percent_sale','status','url_type','target','totalviews','description','content','promotion')
            ->paginate(20);
        if ($request->ajax()) {
            if($items_prd && count($items_prd) > 0){
                if(HelpersDevice::isMobile()) {
                    return view('frontend.pages.mobile.func.load_item_prd')
                        ->with('data',$items_prd);
                }
                else{
                    return view('frontend.pages.desktop.func.load_item_prd')
                        ->with('data',$items_prd);
                }
            }
            else{
                $res = [
                    'status' => 0,
                    'mess' => 'errror'
                ];
                return response()->json($res);
            }
        }
		else{
			if(HelpersDevice::isMobile()) {
				return view('frontend.pages.mobile.search')->with('items_prd',$items_prd);
			}
			else{
				return view('frontend.pages.desktop.search')->with('items_prd',$items_prd);
			}
		}


    }
    public function getCategory(Request $request, $data){
		$currentCategory=$data;
		$breadcumb=null;
		$alltempParrentId = null;
		if($currentCategory){
			$breadcumb =new ArrayObject();
			$category=$currentCategory;
			$tempParrent=$category->parent_id;
			while(true){
				if($category->parent_id !=0){
					$category = Group::where('module', '=','product-category')
						->where('status', '=', 1)
						->where('id', '=',$tempParrent)
						->first();
						$alltempParrentId = Group::where('module', '=','product-category')
						->where('status', '=', 1)
						->where('parent_id', '=',$tempParrent)
						->get();
						$tempParrent=$category->parent_id;
						$breadcumb->append($category);

					}
					else{
						break;
					}
				}
			}
			if(!$alltempParrentId){
				$alltempParrentId = Group::where('module', '=','product-category')
				->where('status', '=', 1)
				->where('parent_id', '=',$data->id)
				->get();
			}
		$allCategory = Group::where('status', '=', 1)
			->where('module', '=', 'product-category')
			->orderBy('order')->get();

			$items_prd = Item::with(array('groups' => function($query){
				$query->where('module','product-category');
			}));
			$items_prd = $items_prd->where('module','product')
			->whereHas('groups', function ($query) use ($data) {
				$query->where('group_id',$data->id);
			})
			->where('status', '=', 1);
			if($request->filled('price')){
				switch ($request->get('price')) {
					case "0-1000000":
						$items_prd = $items_prd->where('price','<=',1000000);
						break;
					case "1000000-3000000":
						$items_prd = $items_prd->where('price','>=',1000000)->where('price','<=',3000000);
						break;
					case "3000000-5000000":
						$items_prd = $items_prd->where('price','>=',3000000)->where('price','<=',5000000);
						break;
					case "5000000-10000000":
						$items_prd = $items_prd->where('price','>=',5000000)->where('price','<=',10000000);
						break;
					case "10000000-12000000":
						$items_prd = $items_prd->where('price','>=',10000000)->where('price','<=',12000000);
						break;
					case "12000000-15000000":
						$items_prd = $items_prd->where('price','>=',12000000)->where('price','<=',15000000);
						break;
					case "15000000-20000000":
						$items_prd = $items_prd->where('price','>=',15000000)->where('price','<=',20000000);
						break;
					case "20000000-50000000":
						$items_prd = $items_prd->where('price','>=',20000000)->where('price','<=',50000000);
						break;
					default :
				}
			}

			if($request->filled('sort')){
				switch ($request->get('price')) {
					case "1":
						$items_prd = $items_prd->orderBy('created_at','desc');
						break;
					case "2":
						$items_prd = $items_prd->orderBy('price','asc');
						break;
					case "3":
						$items_prd = $items_prd->orderBy('price','desc');
						break;
					case "4":
						$items_prd = $items_prd->orderBy('created_at','desc');
						break;
					case "5":
						$items_prd = $items_prd->orderBy('totalviews','desc');
						break;
					case "6":
						$items_prd = $items_prd->orderBy('totalviews','desc');
						break;
					case "7":
						$items_prd = $items_prd->orderBy('totalviews','desc');
						break;
					case "8":
						$items_prd = $items_prd->orderBy('totalviews','desc');
						break;
					default :
				}
			}
			$items_prd = $items_prd->orderBy('id','desc')
			->orderBy('order')
			->select('id','title','image','order','url','slug','price','price_old','price_input','percent_sale','status','url_type','target','totalviews','description','content','promotion')
			->paginate(10);
			if ($request->ajax()) {
				if($items_prd && count($items_prd) > 0){
					if(HelpersDevice::isMobile()) {
						return view('frontend.pages.mobile.func.load_item_prd')
						->with('data',$items_prd);
					}
					else{
						return view('frontend.pages.desktop.func.load_item_prd')
						->with('data',$items_prd);
					}
				}
				else{
					$res = [
						'status' => 0,
						'mess' => 'errror'
					];
				   return response()->json($res);
				}
			}
			else{
				$data->totalviews = $data->totalviews + 1;
				$data->save();
				if(HelpersDevice::isMobile()) {
					return view('frontend.pages.mobile.category')
					->with('breadcumb',$breadcumb)
					->with('currentCategory',$currentCategory)
					->with('items_prd',$items_prd)
					->with('alltempParrentId',$alltempParrentId)
					->with('data',$data);
				}
				else{
					return view('frontend.pages.desktop.category')
					->with('breadcumb',$breadcumb)
					->with('items_prd',$items_prd)
					->with('alltempParrentId',$alltempParrentId)
					->with('data',$data);
				}
			}


    }
    public function getDetail($data){
		$items_prd = null;
        $data->totalviews = $data->totalviews + 1;
        $data->save();
		// xử lí cookie sản phẩm đã xem
        $minutes = 14400;
        $cookieProductViewed = Cookie::get('product-viewed');
        if($cookieProductViewed==null){
            $cookie = Cookie::queue('product-viewed',$data->id, $minutes);
        }
        else{
            $cookieProductViewed = Cookie::get('product-viewed');
            $arrCookie=explode(',',$cookieProductViewed);
            $arrCookie=collect($arrCookie);
            if(count($arrCookie)>30){
                $arrCookie->shift();
            }
            if(!($arrCookie->contains($data->id))){
                $cookieProductViewed=$cookieProductViewed.",".$data->id;
            }

            Cookie::queue('product-viewed',$cookieProductViewed, $minutes);
        }
        $comment = Comment::where('item_id',$data->id)->where('module','comment')->where('status','1')->get();
		$id_attribute = [];
		$data_attribute = [];
		$attribute = $data->subitem;
		if(isset($attribute) && count($attribute) > 0){
			foreach($attribute as $item){
				$id_attribute[] = $item->attribute_id;
			}
			$obj_attribute = Item::where('module','=','product-attribute')->where('status',1)->whereIn('id',$id_attribute)->get();
			if(isset($obj_attribute) && count($obj_attribute) > 0){
				foreach($attribute as $item_at){
					foreach($obj_attribute as $item_obj){
						$content_at = [];
						if($item_at->attribute_id == $item_obj->id){
							if(isset($data_attribute[$item_at->attribute_id])){
								$content_at = $data_attribute[$item_at->attribute_id]['content'];
								$content_at[$item_at->id] = $item_at->content;
							}
							else{
								$content_at[$item_at->id] = $item_at->content;
							}
							$data_attribute[$item_at->attribute_id] = [
								'title' => $item_obj->title,
								'content' => $content_at,
								'type' => $item_obj->type,
							];
						}
					}
				}
			}
		}
        $favourite = 0;
        if(Auth::guard('frontend')->check()){
            $activeFavourite = Favourite::where('user_id',Auth::guard('frontend')->user()->id)->where('item_id',$data->id)->first();
            if($activeFavourite){
                if($activeFavourite->status == 1){
                    $favourite = 1;
                }
            }
        }
		$breadcumb = null;
        $currentCategory=Group::whereHas('items', function ($query) use ($data) {
			$query->where('item_id',$data->id);
		})
        ->where('status', '=', 1)
        ->where('module', '=', 'product-category')
        ->first();
        if($currentCategory){
			$breadcumb =new ArrayObject();
			$breadcumb->append($currentCategory);
			$category=$currentCategory;
			$tempParrent=$category->parent_id;
			while(true){
				if($category->parent_id !=0){

					$category = Group::where('module', '=', 'product-category')
						->where('status', '=', 1)
						->where('id', '=',$tempParrent)
						->first();
					$tempParrent=$category->parent_id;
					$breadcumb->append($category);
				}
				else{
					break;
				}
			}
			$items_prd = Item::with(array('groups' => function($query){
				$query->where('module','product-category');
			}));
			$items_prd = $items_prd->where('module','product')
			->whereHas('groups', function ($query) use ($currentCategory) {
				$query->where('group_id',$currentCategory->id);
			})
			->where('status', '=', 1)->inRandomOrder()->limit(5)->get();
		}

        $items_blog = Item::with(array('groups' => function($query){
            $query->where('module','article-category');
        }));
        $items_blog = $items_blog->where('module','article')
            ->where('status', '=', 1)->limit(3)->get();
        if(HelpersDevice::isMobile()) {
            return view('frontend.pages.mobile.detail')
                ->with('breadcumb',$breadcumb)
                ->with('data_attribute',$data_attribute)
                ->with('currentCategory',$currentCategory)
                ->with('data',$data)
                ->with('items_prd',$items_prd)
                ->with('items_blog',$items_blog)
                ->with('comment',$comment)
                ->with('favourite',$favourite);
        }
        else{
            return view('frontend.pages.desktop.detail')
			->with('breadcumb',$breadcumb)
			->with('data_attribute',$data_attribute)
			->with('currentCategory',$currentCategory)
			->with('data',$data)
            ->with('items_prd',$items_prd)
            ->with('items_blog',$items_blog)
            ->with('comment',$comment)
            ->with('favourite',$favourite);
        }
    }
    public function getCompare(Request $request, $slug){
        $item = explode('-voi-', $slug);
        $data = [];
        foreach ($item as $items){
            $data[] = Item::with('groups')->where('module','=','product')
                ->where(function ($query) use ($items){
                    $query->where('slug','=',$items);

                })
                ->where('status',1)
                ->first();

        }

        if(HelpersDevice::isMobile()) {
            return view('frontend.pages.mobile.compare',compact('data'));
        }
        else{
            return view('frontend.pages.desktop.compare',compact('data'));
        }
    }
	public function getInstallment(Request $request, $slug){

		$prepaid_percentage = null;
		$month = null;
		if($request->filled('prepaid_percentage')){
			$prepaid_percentage = $request->get('prepaid_percentage');
			$prepaid_percentage_arr = config('order.prepaid_percentage');
			if(!in_array($prepaid_percentage, $prepaid_percentage_arr)){
				$prepaid_percentage = null;
			}
		}
		if($request->filled('month')){
			$month = $request->get('month');
			$month_arr = config('order.month');
			if(!in_array($month, $month_arr)){
				$month = null;
			}
		}

		$data = Item::with('groups')->where('module','=','product')
        ->where(function ($query) use ($slug){
            $query->where('slug','=',$slug);
            $query->orWhere('url','=',$slug);
        })
		->where('is_installment',1)
        ->where('status',1)
        ->firstOrFail();

		$id_attribute = [];
		$data_attribute = [];
		$attribute = $data->subitem;
		if(isset($attribute) && count($attribute) > 0){
			foreach($attribute as $item){
				$id_attribute[] = $item->attribute_id;
			}
			$obj_attribute = Item::where('module','=','product-attribute')->where('status',1)->whereIn('id',$id_attribute)->get();
			if(isset($obj_attribute) && count($obj_attribute) > 0){
				foreach($attribute as $item_at){
					foreach($obj_attribute as $item_obj){
						$content_at = [];
						if($item_at->attribute_id == $item_obj->id){
							if(isset($data_attribute[$item_at->attribute_id])){
								$content_at = $data_attribute[$item_at->attribute_id]['content'];
								$content_at[$item_at->id] = $item_at->content;
							}
							else{
								$content_at[$item_at->id] = $item_at->content;
							}
							$data_attribute[$item_at->attribute_id] = [
								'title' => $item_obj->title,
								'content' => $content_at,
								'type' => $item_obj->type,
							];
						}
					}
				}
			}
		}
        $comment = Comment::where('item_id',$data->id)->where('module','comment')->where('status','1')->get();
		$installment = Installment::where('status',1)->get();
		// số tiền vay

		if(HelpersDevice::isMobile()) {
			return view('frontend.pages.mobile.installment',compact('data','data_attribute','installment','prepaid_percentage','month','comment'));
		}
		else{
			return view('frontend.pages.desktop.installment',compact('data','data_attribute','installment','prepaid_percentage','month','comment'));
		}
	}
    public function postComment(Request $request){


        if ($request->ajax()) {

            $data = [
                'item_id' =>$request->product_id,
                'author_id' =>$request->user_id,
                'content' =>$request->comment,
                'module' =>'comment',
                'status' =>1,
                'comment_parent'=>0
            ];

//            $comment = Comment::create([
//                'item_id' =>$request->product_id,
//                'author_id' =>$request->user_id,
//                'comment' =>$request->comment
//            ]);
          $user =  User::where('id',$request->user_id)->first();
          $username = $user->username;
            $userimage  =  $user->image;
            if ($comment = Comment::create($data)){
                $comment_name  = Comment::where('item_id',$request->product_id)->first();
                $comment_parent  = $comment_name->id;

                return response()->json([
                    'status' => 0,
                    'success'=>true,
                    'data'=>[
                        'author_id' => $request->user_id,
                        'author_name' => $username,
                        'author_img' => $userimage,
                        'item_id' => $request->product_id,
                        'content' => $request->comment,
                        'comment_parent' => $comment_parent,

                    ]
//                    'comment' => $request->comment,
                ]);
            }

        } else {
            return response()->json([
                'status' => 0,
                'success'=>true,
                'comment' => $request->comment,
            ]);
        }
    }
    public function postReplyComment(Request $request){
        if ($request->ajax()) {
            $data = [
                'item_id' =>$request->product_id,
                'author_id' =>$request->user_id,
                'content' =>$request->reply_comment,
                'comment_parent'=>$request->parent_id,
                'module' =>'comment',
                'status' =>'1',
            ];
//            $comment = Comment::create([
//                'item_id' =>$request->product_id,
//                'author_id' =>$request->user_id,
//                'comment' =>$request->comment
//            ]);
            $user =  User::where('id',$request->user_id)->first();
            $username = $user->username;
            $userimage  =  $user->image;
            if ($comment = Comment::create($data)){
                return response()->json([
                    'status' => 0,
                    'success'=>true,
                    'data'=>[
                        'author_id' => $request->user_id,
                        'author_name' => $username,
                        'author_img' => $userimage,
                        'item_id' => $request->product_id,
                        'content' => $request->reply_comment,
                        'comment_parent' => $request->parent_id,
                    ]
//                    'comment' => $request->comment,
                ]);
            }

        } else {
            return response()->json([
                'status' => 0,
                'success'=>true,
                'comment' => $request->reply_comment,
            ]);
        }
    }

	public function getProductSeen(Request $request){
		$data = null;
		$dataViewed = Cookie::get('product-viewed');
		if(isset($dataViewed)){
			$dataViewed = explode(',',$dataViewed);
			$data = Item::with(array('groups' => function($query){
				$query->where('module','product-category');
			}));
			$data = $data->where('module','product')
			->whereIn('id',$dataViewed)
			->where('status', '=', 1)
			->get();
		}
		if(HelpersDevice::isMobile()) {
			return view('frontend.pages.mobile.product_seen')
			->with('data',$data);
		}
		else{
			return view('frontend.pages.desktop.product_seen')
			->with('data',$data);
		}
	}
}
