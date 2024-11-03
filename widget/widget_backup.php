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


View::composer('frontend.widget.test', function ($view) {

    $data = "ok";
    dd($data);
    return $view->with('data', $data);
});
View::composer('frontend.pages.desktop.advertise.__widget.__sliderhome', function ($view) {

    $data = Item::where('status', '=', 1)
        ->where('module', '=', config('module.advertise.key'))
        ->select('image','title','url')
        ->orderBy('id','desc')
        ->get();
    return $view->with('data', $data);

});
View::composer('layouts.desktop.header', function ($view) {

    $logo = Item::where('status', '=', 1)
        ->where('module', '=', config('module.advertise.key'))
        ->select('image','title','url')
        ->orderBy('id','desc')
        ->get();
    return $view->with('logo', $logo);

});

// slide trang chủ desktop
View::composer('frontend.widget.desktop._slide', function ($view) {
    $data = Item::where('status', '=', 1)
    ->where('module', '=', config('module.advertise.key'))
    ->where('position','=','SLIDE')
    ->select('id','image','title','target','url')
    ->where('status',1)
    ->orderBy('order')
    ->get();
    return $view->with('data', $data);
});

// slide trang chủ mobile
View::composer('frontend.widget.mobile._slide', function ($view) {
    $data = Item::where('status', '=', 1)
    ->where('module', '=', config('module.advertise.key'))
    ->where('position','=','SLIDE')
    ->select('image','title','target','url')
    ->where('status',1)
    ->orderBy('order')
    ->get();
    return $view->with('data', $data);
});


// menu top desktop

View::composer('frontend.widget.desktop._menu_top', function ($view) {
    $data = Group::where('status', '=', 1)
    ->where('module', '=', config('module.menutop-category.key'))
    ->select('image','title','target','url')
    ->where('status',1)
    ->orderBy('order')
    ->get();
    return $view->with('data', $data);
});
// menu top mobile

View::composer('frontend.widget.mobile._menu_top', function ($view) {
    $data = Group::where('status', '=', 1)
    ->where('module', '=', config('module.menutop-category.key'))
    ->select('image','title','target','url')
    ->where('status',1)
    ->orderBy('order')
    ->get();
    return $view->with('data', $data);
});

//  menu chính desktop

View::composer('frontend.widget.desktop._menu', function ($view) {
    $data = Group::where('status', '=', 1)
    ->where('module', '=', config('module.menu-category.key'))
    ->select('id','image','title','target','url','parent_id','slug')
    ->where('status',1)
    ->orderBy('order')
    ->get();
    return $view->with('data', $data);
});
//  menu chính mobile

View::composer('frontend.widget.mobile._menu', function ($view) {
    $data = Group::where('status', '=', 1)
    ->where('module', '=', config('module.menu-category.key'))
    ->select('id','image','title','target','url','parent_id','slug')
    ->where('status',1)
    ->orderBy('order')
    ->get();
    return $view->with('data', $data);
});
//  menu chính category mobile

View::composer('frontend.widget.mobile._menu_category', function ($view) {
    $data = Group::where('status', '=', 1)
    ->where('module', '=', config('module.menu-category.key'))
    ->select('id','image','title','target','url','parent_id','slug')
    ->where('status',1)
    ->orderBy('order')
    ->get();
    return $view->with('data', $data);
});


// banner sales desktop
View::composer('frontend.widget.desktop._banner_sales', function ($view) {
    $data = Item::where('status', '=', 1)
    ->where('module', '=', config('module.advertise.key'))
    ->where('position','=','BANNER_SALES')
    ->select('image','title','target','url')
    ->where('status',1)
    ->orderBy('order')
    ->get();
    return $view->with('data', $data);
});
// banner sales mobile
View::composer('frontend.widget.mobile._banner_sales', function ($view) {
    $data = Item::where('status', '=', 1)
    ->where('module', '=', config('module.advertise.key'))
    ->where('position','=','BANNER_SALES')
    ->select('image','title','target','url')
    ->where('status',1)
    ->orderBy('order')
    ->get();
    return $view->with('data', $data);
});


// banner ads 1 desktop
View::composer('frontend.widget.desktop._ads_1', function ($view) {
    $data = Item::where('status', '=', 1)
    ->where('module', '=', config('module.advertise.key'))
    ->where('position','=','BANNER_ADS_1')
    ->select('image','title','target','url')
    ->where('status',1)
    ->orderBy('id','desc')
    ->orderBy('order')
    ->first();
    return $view->with('data', $data);
});
// banner ads 2 desktop
View::composer('frontend.widget.desktop._ads_2', function ($view) {
    $data = Item::where('status', '=', 1)
    ->where('module', '=', config('module.advertise.key'))
    ->where('position','=','BANNER_ADS_2')
    ->select('image','title','target','url')
    ->where('status',1)
    ->orderBy('id','desc')
    ->orderBy('order')
    ->first();
    return $view->with('data', $data);
});
// banner ads 3 desktop
View::composer('frontend.widget.desktop._ads_3', function ($view) {
    $data = Item::where('status', '=', 1)
    ->where('module', '=', config('module.advertise.key'))
    ->where('position','=','BANNER_ADS_3')
    ->select('image','title','target','url')
    ->where('status',1)
    ->orderBy('id','desc')
    ->orderBy('order')
    ->first();
    return $view->with('data', $data);
});
// banner ads 4 desktop
View::composer('frontend.widget.desktop._ads_4', function ($view) {
    $data = Item::where('status', '=', 1)
    ->where('module', '=', config('module.advertise.key'))
    ->where('position','=','BANNER_ADS_4')
    ->select('image','title','target','url')
    ->where('status',1)
    ->orderBy('id','desc')
    ->orderBy('order')
    ->first();
    return $view->with('data', $data);
});

// _flash_sales desktop

View::composer('frontend.widget.desktop._flash_sales', function ($view) {
    try{
        $data = null;
        $id = setting('sys_widget_flash_sale');
        if(isset($id) && is_int((int)$id)){
            $data = Group_Item_Index::with('item')
            ->where('group_id',$id)
            ->orderBy('id','desc')
            ->orderBy('order','asc')
            ->get();
        }
    }
    catch(\Exception $e){
        $data = null;
    }
    return $view->with('data', $data);
});

// _flash_sales mobile

View::composer('frontend.widget.mobile._flash_sales', function ($view) {

    try{
        $data = null;
        $id = setting('sys_widget_flash_sale');
        if(isset($id) && is_int((int)$id)){
            $data = Group_Item_Index::with('item')
            ->where('group_id',$id)
            ->orderBy('id','desc')
            ->orderBy('order','asc')
            ->get();
        }
    }
    catch(\Exception $e){
        $data = null;
    }
    return $view->with('data', $data);
});
// section_widget_1 desktop

View::composer('frontend.widget.desktop._section_widget_1', function ($view) {

    try{
        $data = null;
        $id = setting('sys_id_widget_1');
        if(isset($id) && is_int((int)$id)){
            $data = Group_Item_Index::with('item')
            ->where('group_id',$id)
            ->orderBy('id','desc')
            ->orderBy('order','asc')
            ->get();
        }
    }
    catch(\Exception $e){
        $data = null;
    }
    return $view->with('data', $data);
});
// section_widget_1 mobile

View::composer('frontend.widget.mobile._section_widget_1', function ($view) {

    try{
        $data = null;
        $id = setting('sys_id_widget_1');
        if(isset($id) && is_int((int)$id)){
            $data = Group_Item_Index::with('item')
            ->where('group_id',$id)
            ->orderBy('id','desc')
            ->orderBy('order','asc')
            ->get();
        }
    }
    catch(\Exception $e){
        $data = null;
    }
    return $view->with('data', $data);
});
// section_widget_2 desktop

View::composer('frontend.widget.desktop._section_widget_2', function ($view) {

    try{
        $data = null;
        $id = setting('sys_id_widget_2');
        if(isset($id) && is_int((int)$id)){
            $data = Group_Item_Index::with('item')
            ->where('group_id',$id)
            ->orderBy('id','desc')
            ->orderBy('order','asc')
            ->get();
        }
    }
    catch(\Exception $e){
        $data = null;
    }
    return $view->with('data', $data);
});

// section_widget_2 mobile

View::composer('frontend.widget.mobile._section_widget_2', function ($view) {

    try{
        $data = null;
        $id = setting('sys_id_widget_2');
        if(isset($id) && is_int((int)$id)){
            $data = Group_Item_Index::with('item')
            ->where('group_id',$id)
            ->orderBy('id','desc')
            ->orderBy('order','asc')
            ->get();
        }
    }
    catch(\Exception $e){
        $data = null;
    }
    return $view->with('data', $data);
});

// section_widget_3 desktop

View::composer('frontend.widget.desktop._section_widget_3', function ($view) {

    try{
        $data = null;
        $id = setting('sys_id_widget_3');
        if(isset($id) && is_int((int)$id)){
            $data = Group_Item_Index::with('item')
            ->where('group_id',$id)
            ->orderBy('id','desc')
            ->orderBy('order','asc')
            ->get();
        }
    }
    catch(\Exception $e){
        $data = null;
    }
    return $view->with('data', $data);
});

// section_widget_3 mobile

View::composer('frontend.widget.mobile._section_widget_3', function ($view) {
    try{
        $data = null;
        $id = setting('sys_id_widget_3');
        if(isset($id) && is_int((int)$id)){
            $data = Group_Item_Index::with('item')
            ->where('group_id',$id)
            ->orderBy('id','desc')
            ->orderBy('order','asc')
            ->get();
        }
    }
    catch(\Exception $e){
        $data = null;
    }
    return $view->with('data', $data);
});

// section_widget_category desktop
View::composer('frontend.widget.desktop._section_widget_category', function ($view) {
    try{
        $data = null;
        $group_id = [];
        $sys_widget_flash_sale = setting('sys_widget_flash_sale');
        $sys_id_widget_1 = setting('sys_id_widget_1');
        $sys_id_widget_2 = setting('sys_id_widget_2');
        $sys_id_widget_3 = setting('sys_id_widget_3');
        if(isset($sys_widget_flash_sale) && is_int((int)$sys_widget_flash_sale)){
            $group_id[] = $sys_widget_flash_sale;
        }
        if(isset($sys_id_widget_1) && is_int((int)$sys_id_widget_1)){
            $group_id[] = $sys_id_widget_1;
        }
        if(isset($sys_id_widget_2) && is_int((int)$sys_id_widget_2)){
            $group_id[] = $sys_id_widget_2;
        }
        if(isset($sys_id_widget_3) && is_int((int)$sys_id_widget_3)){
            $group_id[] = $sys_id_widget_3;
        }
        $data = Group::with('items_index')->where('module','=','product-group')->whereNotIn('id',$group_id)->where('status',1)->get();
    }
    catch(\Exception $e){
        $data = null;
    }
    return $view->with('data', $data);
});

// section_widget_category mobile
View::composer('frontend.widget.mobile._section_widget_category', function ($view) {
    try{
        $data = null;
        $group_id = [];
        $sys_widget_flash_sale = setting('sys_widget_flash_sale');
        $sys_id_widget_1 = setting('sys_id_widget_1');
        $sys_id_widget_2 = setting('sys_id_widget_2');
        $sys_id_widget_3 = setting('sys_id_widget_3');
        if(isset($sys_widget_flash_sale) && is_int((int)$sys_widget_flash_sale)){
            $group_id[] = $sys_widget_flash_sale;
        }
        if(isset($sys_id_widget_1) && is_int((int)$sys_id_widget_1)){
            $group_id[] = $sys_id_widget_1;
        }
        if(isset($sys_id_widget_2) && is_int((int)$sys_id_widget_2)){
            $group_id[] = $sys_id_widget_2;
        }
        if(isset($sys_id_widget_3) && is_int((int)$sys_id_widget_3)){
            $group_id[] = $sys_id_widget_3;
        }
        $data = Group::with('items_index')->where('module','=','product-group')->whereNotIn('id',$group_id)->where('status',1)->get();
    }
    catch(\Exception $e){
        $data = null;
    }
    return $view->with('data', $data);
});
// _section_widget_article desktop
View::composer('frontend.widget.desktop._section_widget_article', function ($view) {
    try{
        $data = null;
        $sys_id_widget_article = setting('sys_id_widget_article');
        if(isset($sys_id_widget_article)){
            $group_id = explode(',',$sys_id_widget_article);
            $data = Group::with('items_index')->where('module','=','article-category')->whereIn('id',$group_id)->where('status',1)->get();
        }
    }
    catch(\Exception $e){
        $data = null;
    }
    return $view->with('data', $data);
});
// _section_widget_article mobile
View::composer('frontend.widget.blog.banner', function ($view) {
    try{
//        $data = Item::where('module','=','article')->where('status',1)->orderBy('id', 'DESC')->get();

        $data = Item::with(array('groups' => function($query){
            $query->where('module','article-category');
        }));
        $data = $data->where('module','article')
            ->where('status', '=', 1);
        $data = $data->orderBy('id','desc')
            ->orderBy('order')
            ->select('id','title','image','order','url','slug','price','price_old','price_input','percent_sale','status','url_type','target','totalviews','description','content','promotion','created_at')
            ->limit(1)->get();

    }
    catch(\Exception $e){
        $data = null;
    }
    return $view->with('data', $data);
});
View::composer('frontend.widget.blog._section_widget_1', function ($view) {
    try{

        $data = Item::with(array('groups' => function($query){
            $query->where('module','article-category');
        }));
        $data = $data->where('module','article')
            ->where('status', '=', 1);
        $data = $data->orderBy('id','desc')
            ->orderBy('order')
            ->select('id','title','image','order','url','slug','price','price_old','price_input','percent_sale','status','url_type','target','totalviews','description','content','promotion','created_at')
           ->limit(2) ->get();
    }
    catch(\Exception $e){
        $data = null;
    }
    return $view->with('data', $data);
});
View::composer('frontend.widget.blog._section_widget_2', function ($view) {
    try{

        $data = Item::with(array('groups' => function($query){
            $query->where('module','article-category');
        }));
        $data = $data->where('module','article')
            ->where('status', '=', 1);
        $data = $data->orderBy('id','desc')
            ->orderBy('order')
            ->select('id','title','image','order','url','slug','price','price_old','price_input','percent_sale','status','url_type','target','totalviews','description','content','promotion','created_at')
            ->limit(5)->get();
    }
    catch(\Exception $e){
        $data = null;
    }
    return $view->with('data', $data);
});





// banner dịch vụ desktop
View::composer('frontend.widget.desktop._section_widget_banner_nature', function ($view) {
    $data = Item::where('status', '=', 1)
    ->where('module', '=', config('module.advertise.key'))
    ->where('position','=','BANNER_NATURE')
    ->select('image','title','target','url')
    ->where('status',1)
    ->orderBy('id','desc')
    ->orderBy('order')
    ->limit(4)
    ->get();
    return $view->with('data', $data);
});
// banner dịch vụ mobile
View::composer('frontend.widget.mobile._section_widget_banner_nature', function ($view) {
    $data = Item::where('status', '=', 1)
    ->where('module', '=', config('module.advertise.key'))
    ->where('position','=','BANNER_NATURE')
    ->select('image','title','target','url')
    ->where('status',1)
    ->orderBy('id','desc')
    ->orderBy('order')
    ->limit(4)
    ->get();
    return $view->with('data', $data);
});
// địa chỉ
View::composer('frontend.widget.desktop._system_address_provinces', function ($view) {
    $data = Provinces::with('districts')->get();
    return $view->with('data', $data);
});
View::composer('frontend.widget.blog._menu', function ($view) {
    $data = Group::where('status', '=', 1)
    ->where('module', '=', config('module.menublog-category.key'))
//    ->select('id','image','title','target','url')
    ->where('status',1)
    ->orderBy('order')
    ->get();
    return $view->with('data', $data);
});

View::composer('frontend.widget.blog._menu_mobile', function ($view) {
    $data = Group::where('status', '=', 1)
        ->where('module', '=', config('module.menublog-category.key'))
//    ->select('id','image','title','target','url')
        ->where('status',1)
        ->orderBy('order')
        ->get();
    return $view->with('data', $data);
});
