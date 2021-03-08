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
  #Route::get('testresize', 'BiolinkController@testresize');

  Route::get('/', 'HomeController@index');
  Route::get('migrate-to-activwa', 'HomeController@migrate_to_activwa');
  Route::get('logs-0312', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
  Route::get('test-shell-0312', 'HomeController@test_shell');
  // Route::get('/use','UserController@index');
  // Route::post('/user/create','UserController@create');
  // Route::get('/use/{id}/edit','UserController@edit');
  // Route::post('/use/{id}/update','UserController@update');
  // Route::get('/use/{id}/delete','UserController@delete');
  Auth::routes();
  
  Route::get('click/{mode}/{id}', 'BiolinkController@click');
  Route::get('/click-ads/{id}','AdsController@click_ads');

  //API 
  //Route::get('testmail','ApiController@testmail');
  Route::post('generate-coupon', 'ApiController@generate_coupon');
  Route::post('sendmailfromactivwa', 'ApiController@sendmailfromactivwa');

  //information
  Route::get('/about',function(){
    return view('aboutus');
  });
  /*Route::get('/faq',function(){
    return view('faq');
  });*/
  Route::get('/helps',function(){
    return view('term and policy');
  });

  Route::get('register',function(){
     return redirect('https://omnilinkz.com/');
  });

  //auth
  Route::post('post-register', 'Auth\RegisterController@post_register');
  Route::post('register-save', 'Auth\RegisterController@register')->middleware('checkwa');
  // Route::get('/verifyemail/{cryptedcode}','HomeController@verifyemail');
  Route::get('/thankyou-register','OrderController@thankyou_register');
  Route::get('/thankyou-confirm-payment','OrderController@thankyou_confirm_payment');
  // Route::get('/home', 'HomeController@index')->name('home');

  //pricing
  Route::get('/pricing',function(){
    return view('pricing.pricing');
  });
  Route::get('/checkout/{id}','OrderController@checkout');
  Route::post('/check-kupon','OrderController@check_kupon');
  Route::post('/register-payment','OrderController@register');
  Route::post('/confirm-payment','OrderController@confirm_payment');
  Route::get('/thankyou','OrderController@thankyou');

  //Test
  Route::get('/tes','BiolinkController@test');

  Route::group(['middleware' => ['web','auth']], function () {
    Route::get('/verifyemail/{cryptedcode}','HomeController@verifyemail');
    //coupon 
    Route::get('/coupon-available','CouponController@coupon_available');
	
    //Kupon
    Route::get('kupon','CouponController@kupon')->name('kupon');
    Route::get('catalog-content','CouponController@kupon_content');
    
    //Ads Pricing 
    Route::get('/ads-pricing','AdsController@ads_pricing');
    Route::get('/ads-pricing/{id}','AdsController@ads_checkout');

    //Ads 
    Route::get('/ads-manager','AdsController@ads_manager');
    Route::get('/save-ads','AdsController@save_ads');
    Route::get('/load-credit-history','AdsController@load_credit_history');

    //Edit Profile
    Route::get('/edit-profile','UserController@index_edit');
    Route::post('/edit-profile/edit','UserController@edit_profile');

    //Orders 
    Route::get('/orders','OrderController@index_order');
    Route::get('/orders/load-order','OrderController@load_order');
    Route::post('order-confirm-payment','OrderController@confirm_payment_order')->name('order-confirm-payment');

    //dashboard
    // Route::get('/',function(){
        // return view('user.dashboard.dash');
    // });
    Route::get('/','DashboardController@viewDashboard');
    Route::get('/tutorial','DashboardController@viewTutorial');
    Route::get('/dash/load-dashboard','DashboardController@loadDashboard');
    Route::get('/dash/load-chart','DashboardController@load_chart');
    Route::get('/dash/load-link','DashboardController@loadlink');
    Route::get('/dash/delete-pages','DashboardController@deletePage');
    Route::get('/dash/delete-link','DashboardController@deleteLink');
    Route::get('/dash/edit-link','DashboardController@editLink');
    Route::get('/resend-confirmation-email','DashboardController@resend_confirmation_email');

    Route::get('/pdf/{id}/biolinks/{bulan}/{tahun}','DashboardController@pdf_page');
    Route::get('/pdf/{pageid}/{id}/{mode}/{bulan}/{tahun}','DashboardController@pdf_single');
    Route::get('/dash-detail/{pageid}/{bulan}/{tahun}','DashboardController@dashboard_detail_all');
    Route::get('/dash-detail/{pageid}/{id}/{mode}/{bulan}/{tahun}','DashboardController@dashboard_detail');
    Route::get('/dash-detail/load-content','DashboardController@load_dash_detail');
    Route::get('/dash-detail/load-content-all','DashboardController@load_dash_detail_all');
    
    //makebio
    Route::get('/biolinks/','BiolinkController@newbio');
    Route::get('/biolinks/{names}/{mod?}','BiolinkController@viewpage');
    Route::get('/pixel/load-pixellink','BiolinkController@pixelink');
    Route::post('/save-template','BiolinkController@savetemp');
    Route::get('/banner/load-banner','BiolinkController@addBanner');
    Route::post('/save-link','BiolinkController@savelink');
    Route::post('/savewachat','BiolinkController@savewaChat')->middleware('wachat')->name('savewachat');
    Route::post('savewachatmember','BiolinkController@savewaChatMember')->middleware('wamember')->name('savewachatmember');
    Route::get('getwachat','BiolinkController@loadWAChatMembers')->name('getwachat');
    Route::get('delwachatmember','BiolinkController@delWAChatMembers')->name('delwachatmember');
    Route::get('wachatpixel','BiolinkController@wachatpixelpage')->name('wachatpixel');
    Route::get('/delete-photo','BiolinkController@delete_photo');
    Route::get('/load-pixel-page','BiolinkController@pixelpage');
    Route::get('/link-bio','BiolinkController@loadLinkBio');
    Route::get('/view/biolinks',function(){
        return view('user.link.link');
    });
    //make wa link creator
    Route::post('/save-walink','BiolinkController@savewa');
    Route::get('/load-wa-link','BiolinkController@loadwalink');
    Route::get('/walink/deletewalink','BiolinkController@deletewalink');

    //makepixel
    Route::post('/save-pixel','BiolinkController@savepixel');
    Route::get('/load-pixel','BiolinkController@loadpixel');
    Route::get('/pixel/deletepixel','BiolinkController@deletepixel');

    //proof
    Route::post('save-proof','BiolinkController@saveProof')->middleware('proof');
    Route::get('load-proof','BiolinkController@loadProof');
    Route::get('delete-proof','BiolinkController@delProof');
    Route::get('proof_settings','BiolinkController@settingProof');

    //makesinglelink
    Route::get('/singlelink','SingleLinkController@newsingle');
    Route::post('/save-singlelink','SingleLinkController@single');
    Route::get('/dash/newsingle/load-singlelink','SingleLinkController@loadsinglelink');
    Route::post('/save-singlepixel','SingleLinkController@singlepixel');
    Route::get('/pixel/load-singlepixel','SingleLinkController@loadsinglepixel');
    Route::get('/pixel/deletesinglepixel','SingleLinkController@deletesinglepixel');
    Route::get('/pixel/loadPixelLink','SingleLinkController@loadPixelLink');
    Route::get('/link/deletesinglelink','SingleLinkController@deletesinglelink');
    Route::get('/singlelinks/load-link-title','SingleLinkController@load_link_title');

    //Custom Link
    Route::get('/premium-id-biolinks/tambah','PremiumIDController@premiumid_biolinks');
    Route::get('/premium-id-singlelinks/tambah','PremiumIDController@premiumid_singlelinks');    
  });


  Route::group(['middleware'=>['web','auth','thisadmin']],function(){

    /* TO FLAGGING INAPPROPIATE LINK */
    Route::get('flag-link', 'UserController@flag_link');

    /* Super Admin page */
    Route::get('super-admin', 'UserController@user_list');
    Route::get('check-super/{id}', 'UserController@check_super');
  
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

    //List Catalogs
    Route::get('/list-catalog','CatalogsController@index');
    Route::post('/add-catalog','CatalogsController@AddCatalog')->middleware('catalogvalid')->name('add_catalog');
    Route::get('/list-catalog-data','CatalogsController@DataCatalog')->name('datacatalog');
    Route::get('/del-catalog','CatalogsController@DeleteCatalog');

    //List Page
    Route::get('/list-page','PageController@index');
    Route::get('/list-page/load-page','PageController@load_page');
    Route::get('/list-page/calc','PageController@calc_total_counter_on_pages');
    
    //List User 
    Route::get('/list-user','UserController@index');
    Route::get('/list-user/load-user','UserController@load_user');  
    Route::get('/list-user/add-user','UserController@add_user');
    Route::get('/list-user/edit-user','UserController@edit_user');
    Route::get('list-user/view-log','UserController@load_log');
    Route::post('/import-excel-user','UserController@import_excel_user');
    
    //List Ads 
    Route::get('/list-ads','AdsController@index');
    Route::get('/list-ads/load-ads','AdsController@load_ads');  
    Route::get('/list-ads/view-log','AdsController@view_log');  
  });
}

if((env('DOMAIN_TYPE')=='shortlink')||(env('APP_ENV')=='local')){
  Route::get('logs-8877', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
  Route::get('click/{mode}/{id}', 'BiolinkController@click');
  Route::get('/click-ads/{id}','AdsController@click_ads');
  //url
  // Route::get('/dash/new/omn.lkz/{names}','BiolinkController@link');
  // Route::get('/omn.lkz/{names}','BiolinkController@link');
  Route::get('/{names}','BiolinkController@link'); // -> routes ini harus paling bawah karena harus cek dulu yang paling atas
}
