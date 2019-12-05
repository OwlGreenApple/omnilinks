<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

use App\Helpers\Helper;

use App\Ads;
use App\Coupon;
use App\User;
use App\AdsHistory;

use Auth, DB, Validator; 

class ApiController extends Controller
{
  public function generate_coupon(Request $request)
  {
    $data = json_decode($request->getContent(),true);

    $user = User::where("wa_number",$data['wa_no'])->first();
    if (!is_null($user)) {
      do
      {
        $karakter= 'abcdefghjklmnpqrstuvwxyz123456789';
        $string = 'special-';
        for ($i = 0; $i < 7 ; $i++) {
          $pos = rand(0, strlen($karakter)-1);
          $string .= $karakter{$pos};
        }
        $coupon = Coupon::where("kodekupon","=",$string)->first();
      } while (!is_null($coupon));
      $coupon = new Coupon;
      $coupon->kodekupon = $string;
      $coupon->diskon_value = 0;
      $coupon->diskon_percent = 0;
      $coupon->valid_until = new DateTime('+2 days');
      $coupon->valid_to = $data['package'];
      $coupon->keterangan = "Kupon AutoGenerate Package User";
      $coupon->package_id = 4;
      $coupon->user_id = $user->id;
      $coupon->save();
    }
    else {
      $arr['coupon_code'] = "";
      $arr['is_error'] = 1;
      return json_encode($arr);
    }
    
    $arr['coupon_code'] = $string;
    $arr['is_error'] = 0;
    return json_encode($arr);
  }
}
