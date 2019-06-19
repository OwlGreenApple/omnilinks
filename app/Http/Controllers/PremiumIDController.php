<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\PremiumID;
use App\Page;

use Auth, Validator; 

class PremiumIDController extends Controller
{ 
    protected function validator_pages(array $data)
    {
      return Validator::make($data, [
        'custom_id' => ['required', 'string','unique:pages,premium_names','unique:pages,names',
        ],
      ]);
    }

    protected function validator_links(array $data)
    {
      return Validator::make($data, [
        'custom_id' => ['required', 'string','unique:links,premium_names','unique:links,names',
        ],
      ]);
    }

    public function check_membership(){
      $arr['status'] = 'success';
      $arr['message'] = '';

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
    }

    public function premiumid_biolinks(Request $request){
      $arr = $this->check_membership();

      if($arr['status']=='error'){
        return $arr;
      }

      $validator = $this->validator_pages($request->all());

      if(!$validator->fails()){
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
        $arr['message'] = 'Premium ID berhasil dibuat. Letakkan link berikut di Bio Instagram <a href="https://'.env('SHORT_LINK').'/'. $page->premium_names.'">'.env('SHORT_LINK').'/'. $page->premium_names.'</a>';
      } else {
        $arr['status'] = 'error';
        $arr['message'] = $validator->errors()->first();
      }
      
      return $arr;
    }

    public function premiumid_singlelinks(Request $request){
      $arr = $this->check_membership();

      if($arr['status']=='error'){
        return $arr;
      }

      $validator = $this->validator_links($request->all());

      if(!$validator->fails()){
        $link = Link::find($request->id);

        $premiumid = PremiumID::where('user_id',Auth::user()->id)
                    ->where('link_id',$link->id)
                    ->where('type','biolinks')
                    ->first();

        if(is_null($premiumid)){
          $premiumid = new PremiumID;
        }
        
        $premiumid->link_id = $link->id;
        $premiumid->user_id = Auth::user()->id;
        $premiumid->type = 'singlelinks';
        $premiumid->links = $request->custom_id;
        $premiumid->save();

        $page->premium_id = $premiumid->id;
        $page->premium_names = $request->custom_id;
        $page->save();

        $arr['status'] = 'success';
        $arr['message'] = 'Premium ID berhasil dibuat. Letakkan link berikut di Bio Instagram <a href="https://'.env('SHORT_LINK').'/'. $link->premium_names.'">'.env('SHORT_LINK').'/'. $link->premium_names.'</a>';
      } else {
        $arr['status'] = 'error';
        $arr['message'] = $validator->errors()->first();
      }
      
      return $arr;
    }
}
