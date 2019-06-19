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
  DOMAIN_TYPE
  APP_URL
  SHORT_LINK
*/
if(env('DOMAIN_TYPE')=='main'){
  Route::get('/', 'HomeController@index');
  Route::get('logs-0312', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
  // Route::get('/use','UserController@index');
  // Route::post('/user/create','UserController@create');
  // Route::get('/use/{id}/edit','UserController@edit');
  // Route::post('/use/{id}/update','UserController@update');
  // Route::get('/use/{id}/delete','UserController@delete');
  Auth::routes();

  //redirect
  Route::get('click/{mode}/{id}', 'BiolinkController@click');

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
  Route::post('/check-kupon','OrderController@check_kupon');
  Route::post('/register-payment','OrderController@register');
  Route::post('/confirm-payment','OrderController@confirm_payment');
  Route::get('/thankyou','OrderController@thankyou');

Route::group(['middleware' => ['web','auth']], function () {
    //Edit Profile
    Route::get('/edit-profile','UserController@index_edit');
    Route::post('/edit-profile/edit','UserController@edit_profile');

    //Orders 
    Route::get('/orders','OrderController@index_order');
    Route::get('/orders/load-order','OrderController@load_order');
    Route::post('/orders/confirm-payment','OrderController@confirm_payment_order');

    //dashboard
    // Route::get('/',function(){
        // return view('user.dashboard.dash');
    // });
    Route::get('/','DashboardController@viewDashboard');
    Route::get('/dash/load-dashboard','DashboardController@loadDashboard');
    Route::get('/dash/load-chart','DashboardController@load_chart');
    Route::get('/dash/load-link','DashboardController@loadlink');
    Route::get('/dash/delete-pages','DashboardController@deletePage');
    Route::get('/pdf/{id}/biolinks/{bulan}/{tahun}','DashboardController@pdf_page');
    Route::get('/pdf/{pageid}/{id}/{mode}/{bulan}/{tahun}','DashboardController@pdf_single');
    Route::get('/dash-detail/{pageid}/{id}/{mode}/{bulan}/{tahun}','DashboardController@dashboard_detail');
    Route::get('/dash-detail/load-content','DashboardController@load_dash_detail');
    
    //makebio
    Route::get('/biolinks/','BiolinkController@newbio');
    Route::get('/biolinks/{names}','BiolinkController@viewpage');
    Route::get('/pixel/load-pixellink','BiolinkController@pixelink');
    Route::post('/save-template','BiolinkController@savetemp');
    Route::get('/banner/load-banner','BiolinkController@addBanner');
    Route::post('/save-link','BiolinkController@savelink');
    Route::get('/delete-photo','BiolinkController@delete_photo');
    Route::get('/load/pixelpage','BiolinkController@pixelpage');
    Route::get('/view/biolinks',function(){
        return view('user.link.link');
    });
    //make wa link creator
    Route::post('/save-walink','BiolinkController@savewa');
    Route::get('/walink/loadwalink','BiolinkController@loadwalink');
    Route::get('/walink/deletewalink','BiolinkController@deletewalink');

    //makepixel
    Route::post('/save-pixel','BiolinkController@savepixel');
    Route::get('/pixel/load-pixel','BiolinkController@loadpixel');
    Route::get('/pixel/deletepixel','BiolinkController@deletepixel');

    //makesinglelink
    Route::get('/singlelink','SinglelinkController@newsingle');
    Route::post('/save-singlelink','SinglelinkController@single');
    Route::get('/dash/newsingle/load-singlelink','SinglelinkController@loadsinglelink');
    Route::post('/save-singlepixel','SinglelinkController@singlepixel');
    Route::get('/pixel/load-singlepixel','SinglelinkController@loadsinglepixel');
    Route::get('/pixel/deletesinglepixel','SinglelinkController@deletesinglepixel');
    Route::get('/pixel/loadPixelLink','SinglelinkController@loadPixelLink');
    Route::get('/link/deletesinglelink','SinglelinkController@deletesinglelink');
    Route::get('/singlelinks/load-link-title','SinglelinkController@load_link_title');

    //premium ID
    Route::get('/premium-id-biolinks/tambah','PremiumIDController@premiumid_biolinks');
    Route::get('/premium-id-singlelinks/tambah','PremiumIDController@premiumid_singlelinks');    
  });


  Route::group(['middleware'=>['web','auth','thisadmin']],function(){
    //admin order
    Route::get('/list-order',function(){
      return view('admin.list-order.index');
    });
    Route::get('/list-order/load-order','OrderController@load_list_order');
    Route::get('/list-order/confirm','OrderController@confirm_order');

    //List Coupon
    Route::get('/list-coupon','CouponController@index');
    Route::get('/list-coupon/load-coupon','CouponController@load_coupon');
    Route::get('/list-coupon/add','CouponController@add_coupon');
    Route::get('/list-coupon/edit','CouponController@edit_coupon');
    Route::get('/list-coupon/delete','CouponController@delete_coupon');

    //List User 
    Route::get('/list-user','UserController@index');
    Route::get('/list-user/load-user','UserController@load_user');  
    Route::get('/list-user/add-user','UserController@add_user');
    Route::get('/list-user/edit-user','UserController@edit_user');
    Route::get('list-user/view-log','UserController@load_log');
    Route::post('/import-excel-user','UserController@import_excel_user');
  });
}

if((env('DOMAIN_TYPE')=='shortlink')||(env('APP_ENV')=='local')){
  //url
  // Route::get('/dash/new/omn.lkz/{names}','BiolinkController@link');
  // Route::get('/omn.lkz/{names}','BiolinkController@link');
  Route::get('/{names}','BiolinkController@link');
}
