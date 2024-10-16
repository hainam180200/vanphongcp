<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Group_Item;
use App\Models\SubItem;
use App\Models\Item;
use ArrayObject;
use App\Library\HelpersDevice;

class BlogController extends Controller
{

    public function getSearch(Request $request){
        if($request->ajax()){

            if($request->news == ""){
                return response()->json([
                    'status' => '0',
                    'message' => 'Không có dữ liệu'
                ]);
            }
            $paginate = 6;

            $data = Item::where(function ($query) use ($request){
                    $query->where('title', 'LIKE', '%' . $request->news . '%');
                })
                ->where('module','article')
                ->where('status',1)
                ->orderBy('id','desc')
                ->get();

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
    public function index(Request $request){
        $allCategory = Group::where('status', '=', 1)
            ->where('module', '=', 'article-category')
            ->orderBy('order')->get();

        $items_prd = Item::with(array('groups' => function($query){
            $query->where('module','article-category');
        }));
        $items_prd = $items_prd->where('module','article')
            ->where('status', '=', 1);
        $items_prd = $items_prd->orderBy('id','desc')
            ->orderBy('order')
            ->select('id','title','image','order','url','slug','price','price_old','price_input','percent_sale','status','url_type','target','totalviews','description','content','promotion','created_at')
            ->paginate(8);
//        dd($items_prd);
        return view('frontend.pages.news')->with('items_prd',$items_prd);
    }
    public function getCategory(Request $request,$data){
        $data->totalviews = $data->totalviews + 1;
        $data->save();
        $currentCategory=$data;
        $breadcumb=null;
        $alltempParrentId = null;
        if($currentCategory){
            $breadcumb =new ArrayObject();
            $category=$currentCategory;
            $tempParrent=$category->parent_id;
            while(true){
                if($category->parent_id !=0){
                    $category = Group::where('module', '=','article-category')
                        ->where('status', '=', 1)
                        ->where('id', '=',$tempParrent)
                        ->first();
                    $alltempParrentId = Group::where('module', '=','article-category')
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
            $alltempParrentId = Group::where('module', '=','article-category')
                ->where('status', '=', 1)
                ->where('parent_id', '=',$data->id)
                ->get();
        }
        $allCategory = Group::where('status', '=', 1)
            ->where('module', '=', 'article-category')
            ->orderBy('order')->get();

        $items_prd = Item::with(array('groups' => function($query){
            $query->where('module','article-category');
        }));
        $items_prd =$items_prd->whereHas('groups', function ($query) use ($data) {
            $query->where('group_id',$data->id);
        });
        $items_prd = $items_prd->where('module','article')
            ->where('status', '=', 1);

        $items_prd = $items_prd->orderBy('id','desc')
            ->orderBy('order')
            ->select('id','title','image','order','url','slug','price','price_old','price_input','percent_sale','status','url_type','target','totalviews','description','content','promotion','created_at')
            ->paginate(8);
        $data_new = Item::with(array('groups' => function($query){
            $query->where('module','article-category');
        }))
        ->where('module','article')->where('status', '=', 1)
        ->inRandomOrder()
        ->orderBy('id','desc')
        ->limit(6)
        ->get();
            return view('frontend.pages.news_category')
                ->with('breadcumb',$breadcumb)
                ->with('currentCategory',$currentCategory)
                ->with('data_new',$data_new)
                ->with('items_prd',$items_prd)
                ->with('alltempParrentId',$alltempParrentId)
                ->with('data',$data);

    }

    public function getDetail($data){
        $data->totalviews = $data->totalviews + 1;
        $data->save();
        $data_involve = Item::with(array('groups' => function($query){
            $query->where('module','article-category');
        }))
        ->where('module','article')->where('status', '=', 1)
        ->inRandomOrder()
        ->limit(3)
        ->get();
        $data_new = Item::with(array('groups' => function($query){
            $query->where('module','article-category');
        }))
        ->where('module','article')->where('status', '=', 1)
        ->inRandomOrder()
        ->orderBy('id','desc')
        ->limit(10)
        ->get();
        return view('frontend.pages.news_detail')
        ->with('data_new',$data_new)
        ->with('data_involve',$data_involve)
        ->with('data',$data);
    }
}
