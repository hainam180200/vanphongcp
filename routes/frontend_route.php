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
use App\Models\ActivityLog;

Route::group(array('middleware' => ['tracking']), function () {
    Route::get('/',function(){
        $onlineVisitors = ActivityLog::query()
            ->where('created_at','<=', now()->startOfWeek())
            ->where('method', 'ACCESS')
            ->where('prefix', 'frontend')
            ->distinct('ip')
            ->count();
        $todayVisits = ActivityLog::query()
            ->whereDate('created_at', today())
            ->where('method', 'ACCESS')
            ->where('prefix', 'frontend')
            ->distinct('ip')
            ->count();
        $weekVisits = ActivityLog::query()
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->where('method', 'ACCESS')
            ->where('prefix', 'frontend')
            ->distinct('ip')
            ->count();
        return view('frontend.pages.index', compact('onlineVisitors', 'todayVisits', 'weekVisits'));
    })->name('index');
    Route::get('/lien-he',function(){
        return view('frontend.pages.contact');
    })->name('article-list');
    Route::get('/sitemap.xml', 'Frontend\SiteMapController@index');
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
        Route::resource('lien-he','CommentController');

    });
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
