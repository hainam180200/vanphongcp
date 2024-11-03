<?php
use App\Models\Group;
use App\Models\Group_Item_Index;
use App\Models\Group_Item;
use App\Models\Item;
use App\Models\Meta;
use App\Models\Order;
use App\Models\TotalTopList;
use App\Models\User;
use App\Models\Wards;
use App\Models\Districts;
use App\Models\Provinces;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


View::composer('frontend.widget._slide', function ($view) {

    $data = Item::where('status', '=', 1)
        ->where('module', '=', 'article')
        ->select('image','title','url','slug','target')
        ->orderBy('id','desc')
        ->limit(6)
        ->get();
    return $view->with('data', $data);

});
View::composer('frontend.widget._document', function ($view) {
    $data = Item::where('status', '=', 1)
        ->where('module', '=', 'product')
        ->select('id','image','title','url','slug','target','updated_at')
        ->orderBy('id','desc')
        ->limit(10)
        ->get();
    return $view->with('data', $data);

});
View::composer('frontend.widget._article', function ($view) {
    $data = Item::where('status', '=', 1)
        ->where('module', '=', 'product')
        ->select('id','image','title','url','slug','target','updated_at')
        ->orderBy('id','desc')
        ->limit(10)
        ->get();
    return $view->with('data', $data);

});
View::composer('frontend.widget._article_index_1', function ($view) {
    try{
        $data = null;
        $category = null;
        $id = setting('sys_widget_article_1');
        if(isset($id) && is_int((int)$id)){
            $category = Group::where('module', 'article-category')->where('id',$id)->first();
            $data = Group_Item::with('item')
                ->with('group')
                ->where('group_id',$category->id)
                ->orderBy('id','desc')
                ->orderBy('order','asc')
                ->limit(5)
                ->get();
        }
    }
    catch(\Exception $e){
        $data = null;
    }
    return $view->with('data', $data)->with('category', $category);
});

View::composer('frontend.widget._article_index_2', function ($view) {
    try{
        $data = null;
        $category = null;
        $id = setting('sys_widget_article_2');
        if(isset($id) && is_int((int)$id)){
            $category = Group::where('module', 'article-category')->where('id',$id)->first();
            $data = Group_Item::with('item')
                ->with('group')
                ->where('group_id',$category->id)
                ->orderBy('id','desc')
                ->orderBy('order','asc')
                ->limit(5)
                ->get();
        }
    }
    catch(\Exception $e){
        $data = null;
    }
    return $view->with('data', $data)->with('category', $category);
});
View::composer('frontend.widget._article_index_3', function ($view) {
    try{
        $data = null;
        $category = null;
        $id = setting('sys_widget_article_3');
        if(isset($id) && is_int((int)$id)){
            $category = Group::where('module', 'article-category')->where('id',$id)->first();
            $data = Group_Item::with('item')
                ->with('group')
                ->where('group_id',$category->id)
                ->orderBy('id','desc')
                ->orderBy('order','asc')
                ->limit(5)
                ->get();
        }
    }
    catch(\Exception $e){
        $data = null;
    }
    return $view->with('data', $data)->with('category', $category);
});
View::composer('frontend.widget._article_index_4', function ($view) {
    try{
        $data = null;
        $category = null;
        $id = setting('sys_widget_article_4');
        if(isset($id) && is_int((int)$id)){
            $category = Group::where('module', 'article-category')->where('id',$id)->first();
            $data = Group_Item::with('item')
                ->with('group')
                ->where('group_id',$category->id)
                ->orderBy('id','desc')
                ->orderBy('order','asc')
                ->limit(5)
                ->get();
        }
    }
    catch(\Exception $e){
        $data = null;
    }
    return $view->with('data', $data)->with('category', $category);
});
View::composer('frontend.widget._article_index_image', function ($view) {
    try{
        $category = Group::where('module', 'article-category')->where('slug','hinh-anh')->first();
        $data = Group_Item::with('item')
            ->with('group')
            ->where('group_id',$category->id)
            ->orderBy('id','desc')
            ->orderBy('order','asc')
            ->limit(5)
            ->get();
    }
    catch(\Exception $e){
        $data = null;
    }
    return $view->with('data', $data)->with('category', $category);
});
View::composer('frontend.widget._article_index_video', function ($view) {
    try{
        $category = Group::where('module', 'article-category')->where('slug','video')->first();
        $data = Group_Item::with('item')
            ->with('group')
            ->where('group_id',$category->id)
            ->orderBy('id','desc')
            ->orderBy('order','asc')
            ->limit(5)
            ->get();
    }
    catch(\Exception $e){
        $data = null;
    }
    return $view->with('data', $data)->with('category', $category);
});

// slide đầu trang
View::composer('frontend.widget._section_widget_slide_banner', function ($view) {
    $data = Item::where('status', '=', 1)
        ->where('module', '=', config('module.advertise.key'))
        ->where('position','=','SLIDES_ADS_1')
        ->select('image','title','target','url','image', 'content','slug')
        ->where('status',1)
        ->orderBy('id','desc')
        ->orderBy('order')
        ->limit(4)
        ->get();
    return $view->with('data', $data);
});
View::composer('frontend.widget._section_widget_slide_ads', function ($view) {
    $data = Item::where('status', '=', 1)
        ->where('module', '=', config('module.advertise.key'))
        ->where('position','=','SLIDES_ADS_2')
        ->select('image','title','target','url','image', 'content','slug')
        ->where('status',1)
        ->orderBy('id','desc')
        ->orderBy('order')
        ->limit(4)
        ->get();

    return $view->with('data', $data);
});

View::composer('frontend.widget._section_widget_banner_right_1', function ($view) {
    $data = Item::where('status', '=', 1)
        ->where('module', '=', config('module.advertise.key'))
        ->where('position','=','BANNER_RIGHT_ADS_1')
        ->select('image','title','target','url','image', 'content','slug')
        ->where('status',1)
        ->orderBy('id','desc')
        ->orderBy('order')
        ->limit(4)
        ->get();
    return $view->with('data', $data);
});
View::composer('frontend.widget._section_widget_banner_right_2', function ($view) {
    $data = Item::where('status', '=', 1)
        ->where('module', '=', config('module.advertise.key'))
        ->where('position','=','BANNER_RIGHT_ADS_2')
        ->select('image','title','target','url','image', 'content','slug')
        ->where('status',1)
        ->orderBy('id','desc')
        ->orderBy('order')
        ->limit(4)
        ->get();
    return $view->with('data', $data);
});

View::composer('frontend.widget._section_widget_banner_left_1', function ($view) {
    $data = Item::where('status', '=', 1)
        ->where('module', '=', config('module.advertise.key'))
        ->where('position','=','BANNER_LEFT_ADS_1')
        ->select('image','title','target','url','image', 'content','slug')
        ->where('status',1)
        ->orderBy('id','desc')
        ->orderBy('order')
        ->limit(4)
        ->get();
    return $view->with('data', $data);
});
View::composer('frontend.widget._section_widget_banner_left_2', function ($view) {
    $data = Item::where('status', '=', 1)
        ->where('module', '=', config('module.advertise.key'))
        ->where('position','=','BANNER_LEFT_ADS_2')
        ->select('image','title','target','url','image', 'content','slug')
        ->where('status',1)
        ->orderBy('id','desc')
        ->orderBy('order')
        ->limit(4)
        ->get();
    return $view->with('data', $data);
});
View::composer('frontend.widget._section_widget_iframe_right_1', function ($view) {
    $data = Item::where('status', '=', 1)
        ->where('module', '=', config('module.advertise.key'))
        ->where('position','=','IFRAME_ADS_1')
        ->select('image','title','target','url','image', 'content','slug')
        ->where('status',1)
        ->orderBy('id','desc')
        ->orderBy('order')
        ->limit(4)
        ->get();
    return $view->with('data', $data);
});
View::composer('frontend.widget._section_widget_iframe_right_2', function ($view) {
    $data = Item::where('status', '=', 1)
        ->where('module', '=', config('module.advertise.key'))
        ->where('position','=','IFRAME_ADS_2')
        ->select('image','title','target','url','image', 'content','slug')
        ->where('status',1)
        ->orderBy('id','desc')
        ->orderBy('order')
        ->limit(4)
        ->get();
    return $view->with('data', $data);
});
View::composer('frontend.widget._menu', function ($view) {
    $data = Group::where('status', '=', 1)
        ->where('module', '=', config('module.menu-category.key'))
        ->select('id','image','title','target','url','parent_id','slug')
        ->where('status',1)
        ->orderBy('order')
        ->get();
    return $view->with('data', $data);
});
View::composer('frontend.widget._agency', function ($view) {
    $data = Group::where('status', '=', 1)
        ->where('module', '=', 'product-agency')
        ->orderBy('order')->get();
    return $view->with('data', $data);
});
View::composer('frontend.widget._field', function ($view) {
    $data = Group::where('status', '=', 1)
        ->where('module', '=', 'product-field')
        ->orderBy('order')->get();
    return $view->with('data', $data);
});
View::composer('frontend.widget._category', function ($view) {
    $data = Group::where('status', '=', 1)
        ->where('module', '=', 'product-category')
        ->orderBy('order')->get();
    return $view->with('data', $data);
});
//View::composer('frontend.widget._slide', function ($view) {
//
//    $data = Item::where('status', '=', 1)
//        ->where('module', '=', config('module.advertise.key'))
//        ->select('image','title','url')
//        ->orderBy('id','desc')
//        ->get();
//    return $view->with('data', $data);
//
//});
