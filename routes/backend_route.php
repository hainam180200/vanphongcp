<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(array('as' => 'admin.','prefix' => 'admin'),function(){
    Route::get('/login-system', 'Admin\Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login-system', 'Admin\Auth\LoginController@login');
    Route::post('/logout', 'Admin\Auth\LoginController@logout')->name('logout');
});
Route::group(array('as' => 'admin.','prefix' => 'admin','middleware' => ['auth','activity_log']),function(){
    Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')->name('ckfinder_connector');
    Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')->name('ckfinder_browser');
    Route::any('/ckfinder/product-acc-connector/{id}', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')->name('ckfinder_connector_acc')->middleware('ckfinder');
    Route::any('/ckfinder/product-acc-browser/{id}', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')->name('ckfinder_browser_acc')->middleware('ckfinder');
    Route::get('/test', 'Admin\TestController@index');
    //    dashboard
    Route::get('/dashboard', 'Admin\IndexController@index')->name('index');
    Route::get('/growth/user','Admin\IndexController@GrowthUser')->name('growth.user');
    Route::get('/growth/order','Admin\IndexController@GrowthOrder')->name('growth.order');
    Route::get('/growth/order-price','Admin\IndexController@GrowthPrice')->name('growth.order-price');
    //    profile
    Route::get('/profile', 'Admin\ProfileController@profile')->name('profile');
    Route::post('/profile', 'Admin\ProfileController@postChangeCurrentPassword');
    Route::post('permission/order', 'Admin\PermissionController@order')->name('permission.order');
    Route::resource('permission','Admin\PermissionController');
    Route::post('role/order', 'Admin\RoleController@order')->name('role.order');
    Route::resource('role','Admin\RoleController');
    Route::get('setting', 'Admin\SettingController@index')->name('setting.index');
    Route::post('setting', 'Admin\SettingController@store')->name('setting.store');
    Route::resource('activity-log', 'Admin\ActivityLogController');
    Route::get('/view-profile', 'Admin\UserQTVController@view_profile')->name('view-profile');
    Route::post('user-qtv/lock', 'Admin\UserQTVController@lock')->name('user-qtv.lock');
    Route::post('user-qtv/unlock', 'Admin\UserQTVController@unlock')->name('user-qtv.unlock');
    Route::resource('user-qtv','Admin\UserQTVController');
    Route::get('money', 'Admin\UserQTVController@getMoney')->name('get_money');
    Route::get('user-to-money', 'Admin\UserQTVController@getUserToMoney')->name('get_user_to_money');
    Route::post('money', 'Admin\UserQTVController@postMoney')->name('post_money');
    Route::get('user-qtv/{id}/set-permission', 'Admin\UserQTVController@set_permission')->name('user-qtv.set_permission');
    Route::post('user-qtv/set-permission/{id}', 'Admin\UserQTVController@post_set_permission')->name('user-qtv.post_set_permission');
    Route::post('user/lock', 'Admin\UserController@lock')->name('user.lock');
    Route::post('user/unlock', 'Admin\UserController@unlock')->name('user.unlock');
    Route::resource('user','Admin\UserController');
    Route::resource('otp','Admin\OtpController');
    Route::post('/otp-post', 'Admin\OtpController@postOtp');
    Route::get('user/buff/{id}','Admin\UserController@getBuffIdol')->name('user.buff');
    Route::post('user/buff/{id}','Admin\UserController@postBuffIdol')->name('user.buff');
    Route::resource('deposit-bank-setting','Admin\DepositBank\SettingController');
    Route::resource('deposit-bank-report','Admin\DepositBank\ReportController');
    Route::get('txns-report/{id}/show', 'Admin\Txns\ReportController@show')->name('txns-report.show');
    Route::get('txns-report', 'Admin\Txns\ReportController@index')->name('txns-report.index');
    Route::get('plusmoney-report', 'Admin\PlusMoney\ReportController@index')->name('plusmoney-report.index');

    // danh mục bài viết
    Route::post('article-category/order', 'Admin\Module\CategoryController@order')->name('article-category.order');
    Route::resource('article-category','Admin\Module\CategoryController');
    Route::get('article-group/{id}/duplicate', 'Admin\Module\GroupController@duplicate')->name('article-group.duplicate');
    Route::get('article-group/search', 'Admin\Module\GroupController@search')->name('article-group.search');
    Route::get('article-group/show-item','Admin\Module\GroupController@showItemGroup')->name('article-group.show-item');
    Route::get('article-group/update-item','Admin\Module\GroupController@updateItemGroup')->name('article-group.update-item');
    Route::post('article-group/delete-item','Admin\Module\GroupController@deleteItemGroup')->name('article-group.delete-item');
    Route::resource('article-group','Admin\Module\GroupController');

    // bài viết
    Route::get('article/{id}/duplicate', 'Admin\Module\ItemController@duplicate')->name('article.duplicate');
    Route::resource('article','Admin\Module\ItemController');

    // quảng cáo
    Route::post('advertise-category/order', 'Admin\Module\CategoryController@order')->name('advertise-category.order');
    Route::resource('advertise-category','Admin\Module\CategoryController');
    Route::get('advertise/{id}/duplicate', 'Admin\Module\ItemController@duplicate')->name('advertise.duplicate');
    Route::resource('advertise','Admin\Module\ItemController');
    Route::post('advertise-category/order', 'Admin\Module\CategoryController@order')->name('advertise-category.order');
    Route::resource('advertise-category','Admin\Module\CategoryController');

    // product group - Loại văn bản
    Route::get('product-group/show-item','Admin\Product\GroupController@showItemGroup')->name('product-group.show-item');
    Route::post('product-group/order', 'Admin\Product\GroupController@order')->name('product-group.order');
    Route::get('product-group/{id}/duplicate', 'Admin\Product\GroupController@duplicate')->name('product-group.duplicate');
    Route::get('product-group/search', 'Admin\Product\GroupController@search')->name('product-group.search');
    Route::get('product-group/update-item','Admin\Product\GroupController@updateItemGroup')->name('product-group.update-item');
    Route::post('product-group/delete-item','Admin\Product\GroupController@deleteItemGroup')->name('product-group.delete-item');
    Route::post('product-group/delete','Admin\Product\GroupController@delete')->name('product-group.delete');
    Route::resource('product-group','Admin\Product\GroupController');

    // product field - Lĩnh vực
    Route::get('product-field/show-item','Admin\Product\FieldController@showItemGroup')->name('product-field.show-item');
    Route::post('product-field/order', 'Admin\Product\FieldController@order')->name('product-field.order');
    Route::get('product-field/{id}/duplicate', 'Admin\Product\FieldController@duplicate')->name('product-field.duplicate');
    Route::get('product-field/search', 'Admin\Product\FieldController@search')->name('product-field.search');
    Route::get('product-field/update-item','Admin\Product\FieldController@updateItemGroup')->name('product-field.update-item');
    Route::post('product-field/delete-item','Admin\Product\FieldController@deleteItemGroup')->name('product-field.delete-item');
    Route::post('product-field/delete','Admin\Product\FieldController@delete')->name('product-field.delete');
    Route::resource('product-field','Admin\Product\FieldController');

    // product field - Cơ quan ban hành
    Route::get('product-agency/show-item','Admin\Product\AgencyController@showItemGroup')->name('product-agency.show-item');
    Route::post('product-agency/order', 'Admin\Product\AgencyController@order')->name('product-agency.order');
    Route::get('product-agency/{id}/duplicate', 'Admin\Product\AgencyController@duplicate')->name('product-agency.duplicate');
    Route::get('product-agency/search', 'Admin\Product\AgencyController@search')->name('product-agency.search');
    Route::get('product-agency/update-item','Admin\Product\AgencyController@updateItemGroup')->name('product-agency.update-item');
    Route::post('product-agency/delete-item','Admin\Product\AgencyController@deleteItemGroup')->name('product-agency.delete-item');
    Route::post('product-agency/delete','Admin\Product\AgencyController@delete')->name('product-agency.delete');
    Route::resource('product-agency','Admin\Product\AgencyController');

    // product category - Danh muc văn bản
    Route::post('product-category/order', 'Admin\Product\CategoryController@order')->name('product-category.order');
    Route::resource('product-category','Admin\Product\CategoryController');
    // product - Văn bản
    Route::get('product/{id}/duplicate', 'Admin\Product\ItemController@duplicate')->name('product.duplicate');
    Route::resource('product','Admin\Product\ItemController');
    Route::post('product-attribute/order', 'Admin\Product\AttributeController@order')->name('product-attribute.order');
    Route::resource('product-attribute','Admin\Product\AttributeController');
    //    bình luận
    Route::resource('comment','Admin\Comment\CommentController');
    Route::get('comment/{id}/duplicate', 'Admin\Comment\CommentController@duplicate')->name('comment.duplicate');
    Route::post('comment/update-item/{id}', 'Admin\Comment\CommentController@updateComment')->name('comment.update-item');
    Route::post('order/update-item/{id}', 'Admin\Order\ItemController@updateOrder')->name('order.update-item');
    Route::resource('order','Admin\Order\ItemController');
    Route::resource('installment','Admin\Installment\ItemController');
    Route::post('installment-report/update-item/{id}', 'Admin\Installment\ReportController@updateOrder')->name('installment-report.update-item');
    Route::resource('installment-report','Admin\Installment\ReportController');
    Route::post('menutop-category/order', 'Admin\Module\CategoryController@order')->name('menutop-category.order');
    Route::resource('menutop-category','Admin\Module\CategoryController');
    Route::post('menu-category/order', 'Admin\Module\CategoryController@order')->name('menu-category.order');
    Route::resource('menu-category','Admin\Module\CategoryController');
    Route::post('menublog-category/order', 'Admin\Module\CategoryController@order')->name('menublog-category.order');
    Route::resource('menublog-category','Admin\Module\CategoryController');
    Route::get('clear-cache',function(){
        \Cache::flush();
        return redirect()->back()->with('success',__('Xóa cache thành công !'));
    })->name('clear-cache');

});
