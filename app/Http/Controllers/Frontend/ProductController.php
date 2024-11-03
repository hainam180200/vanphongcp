<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Favourite;
use App\Models\Group_Item_Index;
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
        $data_category = Group::where('status', '=', 1)
            ->where('module', '=', 'product-group')
            ->orderBy('order')->get();

        $data_agency =  Group::where('status', '=', 1)
            ->where('module', '=', 'product-agency')
            ->orderBy('order')->get();

        $data_field =  Group::where('status', '=', 1)
            ->where('module', '=', 'product-field')
            ->orderBy('order')->get();

        $items = Item::with(array('groups' => function($query){
            $query->where('module','product-category');
        }));
        $items = $items->where('module','product')
        ->whereHas('groups', function ($query) use ($data) {
            $query->where('group_id',$data->id);
        })
        ->where('status', '=', 1);
        // Loại văn bản
        if($request->filled('group')){
            $group_id = $request->get('group');
            $group = Group::where('id', $group_id)
                            ->where('module', '=', 'product-group')
                            ->first();
            $group_index = Group_Item_Index::where('group_id',$group->id)->pluck('item_id')->toArray();
            $items = $items->whereIn('id',$group_index);
        }
        // Cơ quan
        if($request->filled('agency')){
            $group_id = $request->get('agency');
            $group = Group::where('id', $group_id)
                            ->where('module', '=', 'product-agency')
                            ->first();
            $group_index = Group_Item_Index::where('group_id',$group->id)->pluck('item_id')->toArray();
            $items = $items->whereIn('id',$group_index);
        }
        // Lĩnh vực
        if($request->filled('field')){
            $group_id = $request->get('field');
            $group = Group::where('id', $group_id)
                            ->where('module', '=', 'product-field')
                            ->first();
            $group_index = Group_Item_Index::where('group_id',$group->id)->pluck('item_id')->toArray();
            $items = $items->whereIn('id',$group_index);
        }
        // nội dung
        if($request->filled('title')){
            $items = $items->where('title',$request->get('title'));
        }

//        if($request->filled('sort')){
//            switch ($request->get('price')) {
//                case "1":
//                    $items_prd = $items_prd->orderBy('created_at','desc');
//                    break;
//                case "2":
//                    $items_prd = $items_prd->orderBy('price','asc');
//                    break;
//                case "3":
//                    $items_prd = $items_prd->orderBy('price','desc');
//                    break;
//                case "4":
//                    $items_prd = $items_prd->orderBy('created_at','desc');
//                    break;
//                case "5":
//                    $items_prd = $items_prd->orderBy('totalviews','desc');
//                    break;
//                case "6":
//                    $items_prd = $items_prd->orderBy('totalviews','desc');
//                    break;
//                case "7":
//                    $items_prd = $items_prd->orderBy('totalviews','desc');
//                    break;
//                case "8":
//                    $items_prd = $items_prd->orderBy('totalviews','desc');
//                    break;
//                default :
//            }
//        }

        $items = $items->orderBy('id','desc')
        ->orderBy('order')
        ->select('id','title','image','order','url','slug','price','price_old','price_input','percent_sale','status','url_type','target','totalviews','description','content','promotion','pdf_file','created_at')
        ->paginate(10);
        if ($request->ajax()) {
            if($items && count($items) > 0){
                return view('frontend.pages.documents.func.load_item');
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
            return view('frontend.pages.documents.list')
                ->with('items',$items)
                ->with('data_agency',$data_agency)
                ->with('data_category',$data_category)
                ->with('data_field',$data_field)
                ->with('data',$data);
        }


    }
    public function getDetail($data){
		$items_prd = null;
        $data->totalviews = $data->totalviews + 1;
        $data->save();
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

        return view('frontend.pages.documents.detail')
            ->with('breadcumb',$breadcumb)
            ->with('currentCategory',$currentCategory)
            ->with('data',$data)
            ->with('items_prd',$items_prd);
    }

}
