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
use App\Page;
use App\Mail\SendMailActivWA;

use Auth, DB, Validator, DateTime, Mail, MailchimpMarketing, GuzzleHttp; 

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
            $string .= $karakter[$pos];
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

  //CONNECT ACTIVRESPON
  public function sendDataAPI(Request $request)
  {
    $url = "https://activrespon.com/dashboard/get_data_api";
    $pagename = strip_tags($request->pagename);
    $page = Page::where('names',$pagename)->first();

    if(is_null($page))
    {
      $err['error'] = 1;
      $err['db'] = 'Invalid Page!';
      return response()->json($err);
    }

    $api_key = $page->list_id;

    $data = array(
      "from_omnilinkz" => '$2y$10$JMoAeSl6aV0JCHmTNNafTOuNlMg/S7Yo8a6LUauEZe4Rcy.YdU37S',
      "api_key" => $api_key,
      "name" => $request->api_name,
      "email" => $request->api_email,
      "phone" => $request->api_phone,
    );

    $data_string = json_encode($data);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 360);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json'
    ));
    
    $res=curl_exec($ch);

    // dd($res);
    return $res;
  }

  //TO ADD VALIDATE OWNER MAILCHIMP API KEY
  public function mailchimp_valid_api($api_key,$server)
  //$api_key,$server_mailchimp,$audience_id
  {
    $mailchimp = new MailchimpMarketing\ApiClient();

    $mailchimp->setConfig([
      'apiKey' => $api_key,
      'server' => $server
    ]);

    try
    {
        $mailchimp->ping->get();
        return true;
    }
    catch(GuzzleHttp\Exception\ConnectException $e)
    {
        return false;
    }
    catch(GuzzleHttp\Exception\ClientException $e)
    {
        return false;
    }
    // $response = $mailchimp->lists->getAllLists();
  }

  //TO ADD CONTACTS / SUBSCRIBER INTO AUDIENCE/LIST ON MAILCHIMP 
  public function connect_mailchimp(Request $request)
  {
    // dd($request->all());
    $pagename = strip_tags($request->pagename);
    $page = Page::where('names',$pagename)->first();

    if(is_null($page))
    {
      $err['success'] = 2;
      $err['pagename'] = 'Invalid Page!';
      return response()->json($err);
    }

    $mailchimp = new MailchimpMarketing\ApiClient();
    $mailchimp->setConfig([
      'apiKey' => $page->api_key_mc,
      'server' => $page->server_mailchimp
    ]);

    $list_id = strip_tags($page->audience_id);
    $email = strip_tags($request->api_mc_email);
    $fname = strip_tags($request->api_mc_fname);
    $lname = strip_tags($request->api_mc_lname);

    try {
      $response = $mailchimp->lists->addListMember($list_id, [
          "email_address" => $email,
          "status" => "subscribed",
          "merge_fields" => [
            "FNAME" => $fname,
            "LNAME" => $lname
          ]
      ]);

      $err['success'] = 1;
    } catch (GuzzleHttp\Exception\ClientException $e) {
      $error = $e->getResponse()->getBody()->getContents();
      $err = json_decode($error,true);
      $err['success'] = 0;
    }
    return response()->json($err);
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

  // WA GENERATOR

  public function wa_generator()
  {
    return view('user.wagenerator.index');
  }

/* end class */
}
