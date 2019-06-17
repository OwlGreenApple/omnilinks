<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PremiumID;
use App\Page;

use Auth; 

class PremiumIDController extends Controller
{
    public function tambah_premiumid(Request $request){
      if(Auth::user()->membership=='free'){
        $arr['status'] = 'error';
        $arr['message'] = 'Silahkan upgrade akun terlebih dahulu untuk dapat menggunakan Premium ID.';
        return $arr;
      } else {
        $premiumid = PremiumID::where('user_id',Auth::user()->id)->get();
        if($premiumid->count()>=3 and Auth::user()->membership=='basic'){
          $arr['status'] = 'error';
          $arr['message'] = 'Premium ID telah mencapai batas maksimal. Silahkan upgrade akun terlebih dahulu untuk menambah jumlah Premium ID.';
          return $arr;
        } else if($premiumid->count()>=10 and Auth::user()->membership=='elite'){
          $arr['status'] = 'error';
          $arr['message'] = 'Premium ID telah mencapai batas maksimal.';
          return $arr;
        }
      }

      $page = Page::find($request->id);

      $premiumid = PremiumID::where('user_id',Auth::user()->id)
                  ->where('link_id',$page->id)
                  ->where('type','biolinks')
                  ->first();

      if(is_null($premiumid)){
        $premiumid = new PremiumID;
      }
      
      $premiumid->link_id = $page->id;
      $premiumid->user_id = Auth::user()->id;
      $premiumid->type = 'biolinks';
      $premiumid->links = $request->custom_id;
      $premiumid->save();

      $page->premium_id = $premiumid->id;
      $page->premium_names = $request->custom_id;
      $page->save();

      $arr['status'] = 'success';
      $arr['message'] = 'Premium ID berhasil dibuat. Letakkan link berikut di Bio Instagram <a href="https://'.env('SHORT_LINK').'/'.$page->names.'">'.env('SHORT_LINK').'/'.$page->names.'</a>';

      return $arr;
    }
}
