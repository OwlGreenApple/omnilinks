<?php

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

Route::get('/', 'HomeController@index');
// Route::get('/use','UserController@index');
// Route::post('/user/create','UserController@create');
// Route::get('/use/{id}/edit','UserController@edit');
// Route::post('/use/{id}/update','UserController@update');
// Route::get('/use/{id}/delete','UserController@delete');

Auth::routes();

//information
    Route::get('/about',function(){
    return view('aboutus');
    });
    Route::get('/faq',function(){
    return view('faq');
    });
    Route::get('/helps',function(){
    return view('term and policy');
    });
//auth
    Route::post('post-register', 'Auth\RegisterController@post_register');
    Route::get('/verifyemail/{cryptedcode}','Auth\LoginController@verifyemail');
    Route::get('/home', 'HomeController@index')->name('home');
//pricing
    Route::get('/pricing',function(){
    return view('pricing.pricing');
    });

    Route::get('/checkout/{id}','OrderController@checkout');
    Route::get('/register-payment','OrderController@register');
    Route::post('/confirm-payment','OrderController@confirm_payment');

    Route::group(['middleware' => ['web','auth']], function () {
    Route::get('/orders','OrderController@index_order');
    Route::get('/orders/load-order','OrderController@load_order');
    Route::post('/orders/confirm-payment','OrderController@confirm_payment_order');

    //dashboard
    Route::get('/dash',function(){
        return view('user.dashboard.dash');
    });
    Route::get('/dash/load-dashboard','DashboardController@loadDashboard');
    Route::get('/dash/load-link','DashboardController@loadlink');
    Route::get('/dash/delete-pages','DashboardController@deletePage');

    //makebio
    Route::get('/dash/new/','BiolinkController@newbio');
    Route::get('/dash/new/{names}','BiolinkController@viewpage');
    Route::get('/pixel/load-pixellink','BiolinkController@pixelink');
    Route::post('/save-template','BiolinkController@savetemp');
    Route::get('/banner/load-banner','BiolinkController@addBanner');
    Route::post('/save-link','BiolinkController@savelink');

    //make wa link creator
    Route::post('/save-walink','BiolinkController@savewa');
    Route::get('/walink/loadwalink','BiolinkController@loadwalink');
    Route::get('/walink/deletewalink','BiolinkController@deletewalink');

    //makepixel
    Route::post('/save-pixel','BiolinkController@savepixel');
    Route::get('/pixel/load-pixel','BiolinkController@loadpixel');
    Route::get('/pixel/deletepixel','BiolinkController@deletepixel');

    //makesinglelink
     Route::get('/dash/newsingle','SinglelinkController@newsingle');
     Route::post('/save-singlelink','SinglelinkController@single');
     Route::get('/dash/newsingle/load-singlelink','SinglelinkController@loadsinglelink');

     Route::post('/save-singlepixel','SinglelinkController@singlepixel');
     Route::get('/pixel/load-singlepixel','SinglelinkController@loadsinglepixel');
     Route::get('/pixel/deletesinglepixel','SinglelinkController@deletesinglepixel');
     Route::get('/link/deletesinglelink','SinglelinkController@deletesinglelink');
     //url
     Route::get('/dash/new/omn.lkz/{names}','BiolinkController@link');
     Route::get('/omn.lkz/{names}','BiolinkController@link');
});


    Route::group(['middleware'=>['web','auth','thisadmin']],function(){
    //admin order
    Route::get('/list-order/load-order','OrderController@load_list_order');
    Route::get('/list-order',function(){
    return view('admin.list-order.index');
    });
    Route::get('/list-order/confirm','OrderController@confirm_order');
});