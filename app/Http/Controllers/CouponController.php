<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Coupon;
use App\Catalogs;
use Validator;
use Carbon;

class CouponController extends Controller
{
    protected function validator(array $data){
      return Validator::make($data, [
        'kodekupon' => ['required','string','unique:coupons'],
        'diskon_value' => ['required','integer','min:0'],
        'diskon_percent' => ['required','integer','min:0','max:100'],
        'valid_until' => ['required','date','after:today'],
      ]);
    }

    public function index(){
      //halaman list kupon admin
      return view('admin.list-coupon.index');
    }

    public function load_coupon(Request $request){
      //halaman list kupon admin
      $coupons = Coupon::where("user_id",0)->get();

      $arr['view'] = (string) view('admin.list-coupon.content')
              ->with('coupons',$coupons);  
      return $arr;
    }

    public function add_coupon(Request $request){
      //tambah kupon
      $validator = $this->validator($request->all());

      if(!$validator->fails()){
        $coupon = new Coupon;
        $coupon->kodekupon = $request->kodekupon;
        $coupon->diskon_value = $request->diskon_value;
        $coupon->diskon_percent = $request->diskon_percent;
        $coupon->valid_until = $request->valid_until;
        $coupon->valid_to = $request->valid_to;
        $coupon->keterangan = $request->keterangan;
        $coupon->package_id = $request->package_id;
        $coupon->save();

        $arr['status'] = 'success';
        $arr['message'] = 'Kupon berhasil ditambahkan';
      } else {
        $arr['status'] = 'error';
        $arr['message'] = $validator->errors()->first();
      }

      return $arr;
    }

    public function edit_coupon(Request $request){
      //edit kupon
      $validator = $this->validator($request->all());

      if($validator->fails()){
        $failedRules = $validator->failed();

        if(isset($failedRules['kodekupon']['Unique'])){
        } else {
          $arr['status'] = 'error';
          $arr['message'] = $validator->errors()->first();
          return $arr;
        }
      }

      $coupon = Coupon::find($request->id_edit);
      $coupon->kodekupon = $request->kodekupon;
      $coupon->diskon_value = $request->diskon_value;
      $coupon->diskon_percent = $request->diskon_percent;
      $coupon->valid_until = $request->valid_until;
      $coupon->valid_to = $request->valid_to;
      $coupon->keterangan = $request->keterangan;
      $coupon->package_id = $request->package_id;
      $coupon->save();

      $arr['status'] = 'success';
      $arr['message'] = 'Kupon berhasil diedit';
      return $arr;
    }

    public function delete_coupon(Request $request){
      //hapus kupon
      $coupon = Coupon::find($request->id)
                  ->delete();

      $arr['status'] = 'success';
      $arr['message'] = 'Delete kupon berhasil';

      return $arr;
    }

    public function coupon_available(Request $request){
      return view('user.coupon.index');
    }

    #DASHBOARD
    public function kupon() {
		 $banner = Catalogs::where('type','=','main')->first();
		$banner = $banner->path;
		return view('user.coupon.kupon',['banner'=>$banner]);
    }
	
	public function kupon_content(Request $request)
    {
    $data = array();
	  $value = $request->value;
    $now = Carbon::now();
	  
	  if($value == null) {
		 $catalogs = Catalogs::where([['catalogs.type','<>','main'],['coupons.valid_until','>=',$now]])
                ->join('coupons','coupons.id','=','catalogs.coupon_id')
                ->select('catalogs.*','coupons.valid_until','coupons.kodekupon')
                ->get();
	  } else {
		   $catalogs = Catalogs::where([['coupons.kodekupon','LIKE','%'.$value.'%'],['coupons.valid_until','>=',$now]])
                ->join('coupons','coupons.id','=','catalogs.coupon_id')
                ->select('catalogs.*','coupons.valid_until','coupons.kodekupon')
                ->get();
	  }

    if($catalogs->count() > 0)
    {
      foreach($catalogs as $rows)
      {
        $valid_until = Carbon::parse($rows->valid_until);
        $totalDuration = $now->diffInSeconds($valid_until,false);

        if($totalDuration <= 0) {
          $zerotime = 0;
          $end_period = gmdate('H:i:s',$zerotime);
        }
        else {
          $end_period = gmdate('H:i:s', $totalDuration);
        }

        $data[] = array(
          'path'=>$rows->path,
          'desc'=>$rows->desc,
          'valid_until'=>$end_period,
          'kodekupon'=>$rows->kodekupon
        );
      }
    }
	  
    return view('user.coupon.kupon-content',['catalogs'=>$data]);
      
    }
}
