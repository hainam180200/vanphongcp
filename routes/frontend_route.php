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
    if(HelpersDevice::isMobile()) {
        return view('frontend.pages.mobile.index');
    }
    else{
        return view('frontend.pages.desktop.index');
    }
})->name('index');
Route::get('/sitemap.xml', 'Frontend\SiteMapController@index');
Route::get('/so-sanh',function(){
    if(HelpersDevice::isMobile()) {
        return view('frontend.pages.mobile.installment');
    }
    else{
        return view('frontend.pages.desktop.compare');
    }
});
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
    Route::group(['middleware' => 'auth_frontend'], function () {
        Route::post('/user/favourite/{id}','UserController@postUserFavourite');
        Route::get('account/info',[\App\Http\Controllers\Frontend\UserController::class,'getProfile'])->name('getProfile');
        Route::get('account/index',[\App\Http\Controllers\Frontend\UserController::class,'getInfo'])->name('getInfo');
        Route::post('/profile',[\App\Http\Controllers\Frontend\UserController::class,'postProfile']);
        Route::post('/order','OrderController@postOrder');
        Route::post('/order-now/{id}','OrderController@postOrderNow');
        Route::post('/order-installment/{id}','OrderController@postOrderInstallment');
        Route::get('/order/success/{id}','OrderController@orderSuccess');
        Route::get('/check-out/{id}','OrderController@getCheckout');
        Route::post('/check-out/{id}','OrderController@postCheckout');
        Route::post('/order/{id}/confirm','OrderController@postConfirmOrder');
        Route::post('/postComment',[\App\Http\Controllers\Frontend\ProductController::class,'postComment']);
        Route::post('/postReplyComment',[\App\Http\Controllers\Frontend\ProductController::class,'postReplyComment']);
        Route::get('/account/order/{id}',[\App\Http\Controllers\Frontend\UserController::class,'getOrderDetail']);
        Route::get('/account/order','UserController@getOrder');
        Route::get('/account/wishlist','UserController@getFavorite');
        Route::post('/postimageProfile',[\App\Http\Controllers\Frontend\UserController::class,'postImage']);
    });
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
    $data = Group::where('module','=','product-category')
    ->where(function ($query) use ($slug){
        $query->where('slug','=',$slug);
        $query->orWhere('url','=',$slug);
    })
    ->where('status',1)
    ->first();
    if(!$data){
        $data = Item::with('groups')->where('module','=','product')
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
            default :
                abort(404);
        }
    }
    else{
        abort(404);
    }
});
Route::get('/blog/{slug}',function(Request $request, $slug){
    $app = null;
    $data = Group::where('module','=','article-category')
        ->where(function ($query) use ($slug){
            $query->where('slug','=',$slug);
            $query->orWhere('url','=',$slug);
        })
        ->where('status',1)
        ->first();
    if(!$data){
        $data = Item::with('groups')->with('author')->where('module','=','article')
            ->where(function ($query) use ($slug){
                $query->where('slug','=',$slug);
                $query->orWhere('url','=',$slug);
            })
            ->where('status',1)
            ->first();
    }
    if($data){
        switch (strtolower($data->module)) {
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
