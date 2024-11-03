<?php

use App\Http\Controllers\Frontend\BlogController;
use App\Library\HelpersDevice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Group;
use App\Models\Group_Item;
use App\Models\Item;
use App\Http\Controllers\Frontend\ProductController ;
use Illuminate\Http\Request;


Route::get('/',function(){
    return view('frontend.pages.index');
})->name('index');
Route::get('/lien-he',function(){
    return view('frontend.pages.contact');
})->name('article-list');
Route::get('/tin-tuc-detail',function(){
    return view('frontend.pages.article.detail');
})->name('article-detail');
Route::get('/van-ban',function(){
    return view('frontend.pages.documents.list');
})->name('documents-list');
Route::get('/van-ban-detail',function(){
    return view('frontend.pages.documents.detail');
})->name('documents-detail');
Route::get('/sitemap.xml', 'Frontend\SiteMapController@index');

Route::get('/account/order',function(){
        return view('frontend.pages.account.order');
});


// route cần auth

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login');
    Route::get('/logout', 'Auth\LoginController@logout');
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm');
    Route::post('/register', 'Auth\RegisterController@register');
    Route::get('callback/{provider}', 'Auth\LoginController@CallbackSocial');
    Route::get('/item-list',[\App\Http\Controllers\Frontend\ProductController::class,'category']);
    Route::get('/tim-kiem','ProductController@getSearch');
    Route::get('/tim-kiem-bai-viet','BlogController@getSearch');
});
Route::get('/blog','Frontend\BlogController@index');

Route::get('/tra-gop/{slug}','Frontend\ProductController@getInstallment');

Route::get('/cart','Frontend\CartController@getCart');
Route::post('/cart/add/{id}','Frontend\CartController@addCart');
Route::post('/cart/update/{rowId}','Frontend\CartController@updateCart');
Route::post('/cart/delete/{rowId}','Frontend\CartController@deleteCart');

Route::get('/get-districts','Frontend\CartController@getDistricts')->middleware(['throttle:10,1']);





Route::get('/so-sanh/{slug}',function(Request $request, $slug){
    $app = new ProductController();
    return $app->getCompare($request, $slug);
});

Route::get('/san-pham-da-xem','Frontend\ProductController@getProductSeen');

Route::get('/{slug}',function(Request $request, $slug){
    $app = null;
    $data = Group::query()
    ->where(function ($query) use ($slug){
        $query->where('module','=','product-category');
        $query->orWhere('module','=','article-category');
    })
    ->where(function ($query) use ($slug){
        $query->where('slug','=',$slug);
        $query->orWhere('url','=',$slug);
    })
    ->where('status',1)
    ->first();
    if(!$data){
        $data = Item::with('groups')
        ->where(function ($query) use ($slug){
            $query->where('module','=','product');
            $query->orWhere('module','=','article');
        })
        ->where(function ($query) use ($slug){
            $query->where('slug','=',$slug);
            $query->orWhere('url','=',$slug);
        })
        ->where('status',1)
        ->first();
    }
    if($data){
        switch (strtolower($data->module)) {
            case "product-category":
                $app = new ProductController();
                return $app->getCategory($request, $data);
            case "product":
                $app = new ProductController();
                return $app->getDetail($data);
            case "article-category":
                $app = new BlogController();
                return $app->getCategory($request, $data);
            case "article":
                $app = new BlogController();
                return $app->getDetail($data);
            default :
                abort(404);
        }
    }
    else{
        abort(404);
    }
});
//Route::get('/{slug}',function(Request $request, $slug){
//    $app = null;
//    $data = Group::where('module','=','product-category')
//    ->where(function ($query) use ($slug){
//        $query->where('slug','=',$slug);
//        $query->orWhere('url','=',$slug);
//    })
//    ->where('status',1)
//    ->first();
//    if(!$data){
//        $data = Item::with('groups')->where('module','=','product')
//        ->where(function ($query) use ($slug){
//            $query->where('slug','=',$slug);
//            $query->orWhere('url','=',$slug);
//        })
//        ->where('status',1)
//        ->first();
//    }
//    if($data){
//        switch (strtolower($data->module)) {
//            case "product-category":
//                $app = new ProductController();
//                return $app->getCategory($request, $data);
//            case "product":
//                $app = new ProductController();
//                return $app->getDetail($data);
//            default :
//                abort(404);
//        }
//    }
//    else{
//        abort(404);
//    }
//});
//Route::get('/thong-tin/{slug}',function(Request $request, $slug){
//    $app = null;
//    $data = Group::where('module','=','article-category')
//        ->where(function ($query) use ($slug){
//            $query->where('slug','=',$slug);
//            $query->orWhere('url','=',$slug);
//        })
//        ->where('status',1)
//        ->first();
//    if(!$data){
//        $data = Item::with('groups')->with('author')->where('module','=','article')
//            ->where(function ($query) use ($slug){
//                $query->where('slug','=',$slug);
//                $query->orWhere('url','=',$slug);
//            })
//            ->where('status',1)
//            ->first();
//    }
//    if($data){
//        switch (strtolower($data->module)) {
//            case "article-category":
//                $app = new BlogController();
//                return $app->getCategory($request, $data);
//            case "article":
//                $app = new BlogController();
//                return $app->getDetail($data);
//            default :
//                abort(404);
//        }
//    }
//    else{
//        abort(404);
//    }
//});
