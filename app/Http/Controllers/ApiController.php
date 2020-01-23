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
use App\Mail\SendMailActivWA;

use Auth, DB, Validator, DateTime, Mail; 

class ApiController extends Controller
{
  public function generate_coupon(Request $request)
  {
    $data = json_decode($request->getContent(),true);

    $user = User::where("email",$data['email'])->first();
    if (!is_null($user)) {
      /*$coupon = Coupon::
                where("user_id",$user->id)
                ->where("valid_to",$data['package'])
                ->first();
      if (!is_null($coupon)) {
        $arr['coupon_code'] = $coupon->kodekupon;
        $arr['is_error'] = 0;
        return json_encode($arr);
      }
      else {*/
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
        $coupon->package_id = 0;
        $coupon->user_id = $user->id;
        $coupon->save();
      // }
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

  public function sendmailfromactivwa(Request $request)
  {
      $data = json_decode($request->getContent(),true);
      Mail::to($data['mail'])->queue(new SendMailActivWA($data['emaildata'],$data['subject']));
  }

  public function testmail()
  {
        $curl = curl_init();
        $data = array(
            'mail'=>'Papercut@user.com',
            'emaildata'=>'package-elite-6',
            'subject'=>'package-omnilinkz',
        );
        $url = 'http://localhost/omnilinkz/sendmailfromactivwa';

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTREDIR => 3,
          CURLOPT_POSTFIELDS => json_encode($data),
          CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo $response;
          //return json_decode($response,true);
        }
  }

/* end class */
}
