<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});*/

/*front end rooting*/
Route::get('/', 'IndexController@index');

Route::post('/send_mail_refer_friend', 'IndexController@send_mail_refer_friend');
//Social Login
Route::get('social/login/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('social/login/callback/{provider}', 'Auth\AuthController@handleProviderCallback');

Route::get('login', 'IndexController@login');
Route::post('login', 'IndexController@postLogin');
Route::get('register', 'IndexController@register');
Route::post('register', 'IndexController@postRegister');
Route::get('/confirm/{confirm}', 'IndexController@confirmRegister');

/*all pages */
Route::get('/top-offers', 'IndexController@top_offers'); 
Route::get('/pages/{slug}', 'IndexController@pages_list'); 
Route::get('about', 'IndexController@about_us');
Route::get('how-it-work', 'IndexController@how_it_work');
Route::get('how-to-earn', 'IndexController@how_to_earn');
Route::get('contact', 'IndexController@contact_us');
Route::post('contact_send', 'IndexController@contact_send');
Route::get('termsandconditions', 'IndexController@termsandconditions');
Route::get('privacypolicy', 'IndexController@privacypolicy');
Route::get('help', 'IndexController@help');
Route::get('cookies_policy', 'IndexController@cookies_policy');
Route::get('/faq', 'IndexController@faq_page');

Route::post('comment/add','CommentController@store');
Route::get('blog','PostController@blog');
Route::get('blog/{slug}',['as' => 'post', 'uses' => 'PostController@show'])->where('slug', '[A-Za-z0-9-_]+');
/* by stores and categories */

Route::get('/stores/{store_id}/{store_slug}', 'CategoriesController@stores');
Route::get('stores/', 'CategoriesController@allstores');

Route::get('/category/{category_id}/{category_slug}/', 'CategoriesController@categories');
Route::get('/categories', 'CategoriesController@allcategories');

Route::get('finddb', 'SearchController@find_db');
Route::get('/search/', 'SearchController@search_listings');
Route::get('/multi-search/', 'SearchController@multi_search_listings');
/* by stores and categories */
Route::post('search/filters', 'SearchController@search_filter');

//Route::get('/recent-activity',function(){return view('pages.recent_activity'); }); 
Route::get('recent-activity', 'CategoriesController@recent_activity');


Route::get('ajax/savecupon', 'IndexController@savecupon');

/*front end rooting*/
Route::post('submit-newsletter', 'IndexController@submit_newsletter');
//Route::get('/', 'IndexController@index');
 
// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
Route::post('password/reset', 'Auth\PasswordController@postReset');
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');

/*rating*/
Route::get('/rating', 'IndexController@rating');



Route::get('ajax_subcategories/{id}', 'ListingsUserController@ajax_subcategories');

/****call ajax data ****/
Route::get('ajax/watchlist', 'IndexController@watchlist');
/****call ajax data ****/
Route::get('/ajax/get-stores/', 'IndexController@get_stores');


/* user dashboard rooting*/ 
Route::get('dashboard', 'IndexController@dashboard');
Route::get('account-settings', 'IndexController@account_settings');
Route::get('dashboard/notification', 'IndexController@notification');
Route::get('dashboard/customer-support', 'IndexController@customer_support');
Route::post('dashboard/customer-support', 'IndexController@submit_support');
Route::post('dashboard/update-info', 'IndexController@editprofile');
Route::get('user-Report', 'IndexController@Affiliate_Report');
Route::get('dashboard/favourite-stores', 'IndexController@favourite_stores');	
Route::get('dashboard/favourite-coupon', 'IndexController@favourite_coupon');
Route::post('dashboard/payment-info', 'IndexController@user_payment_info');
Route::get('change_pass', 'IndexController@change_password');
Route::post('change_pass', 'IndexController@edit_password');
Route::get('logout', 'IndexController@logout');	
Route::get('/refer-friend',function(){return view('pages.refer'); }); 
Route::get('dashboard/recommend-delete/{id}', 'IndexController@recommend_delete');
Route::get('dashboard/couponsave/delete/{id}', 'IndexController@savecoupon_delete');
Route::post('/dashboard/coupon_save', 'IndexController@custom_coupon_save');
Route::get('/dashboard/coupon_save/{id}', 'IndexController@custom_coupon_edit');
Route::get('dashboard/coupon_save/delete/{id}', 'IndexController@custom_coupon_delete');
Route::get('dashboard/my-cashback', 'IndexController@my_cashback');
Route::post('/dashboard/missing_cashback/save', 'IndexController@missing_cashback_save');
Route::post('/dashboard/redeem_payment/request', 'IndexController@redeem_payment_request');
Route::get('cupowallet', 'IndexController@cupowallet');
Route::get('expired-coupons', 'IndexController@expired_coupons');
Route::get('recommended-coupons', 'IndexController@recommended_coupons');
Route::get('/custum_coupons','IndexController@custum_coupons');
/* user dashboard rooting*/

Route::get('/{email}/unsubscribe', 'IndexController@unsubscribe');
/*Route::get('home', ['as' => 'home', 'uses' => function() {
	return view('home');
}]);*/


 
