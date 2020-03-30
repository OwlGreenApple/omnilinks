<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\PremiumID;
use App\Page;
use App\Link;

use Auth, Validator; 

class PremiumIDController extends Controller
{ 
    protected function validator_pages(array $data)
    {
      return Validator::make($data, [
        'custom_id' => ['required', 'string','unique:premium_id,links','unique:pages,names',
        ],
      ]);
    }

    protected function validator_links(array $data)
    {
      return Validator::make($data, [
        'custom_id' => ['required', 'string','unique:premium_id,links','unique:links,names',
        ],
      ]);
    }

    public function check_membership(){
      $arr['status'] = 'success';
      $arr['message'] = '';
      $user = Auth::user();

      if($user->membership=='free'){
        $arr['status'] = 'error';
        $arr['message'] = 'Silahkan upgrade akun terlebih dahulu untuk dapat menggunakan Custom Link.';
        return $arr;
      } else {
        $premiumid = PremiumID::where('user_id',$user->id)->get();
        if ($user->email<>"it.axiapro@gmail.com"){
          if($premiumid->count()>=3 and ($user->membership=='pro' or $user->membership=='popular')){
            $arr['status'] = 'error';
            $arr['message'] = 'Custom Link telah mencapai batas maksimal. Silahkan upgrade akun terlebih dahulu untuk menambah jumlah Custom Link.';
            return $arr;
          } else if($premiumid->count()>=10 and ($user->membership=='elite' or $user->membership=='super')){
            $arr['status'] = 'error';
            $arr['message'] = 'Custom Link telah mencapai batas maksimal.';
            return $arr;
          }
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
        $arr['customLink'] = 'https://'.env('SHORT_LINK').'/'. $page->premium_names;
        // $arr['message'] = 'Custom Link berhasil dibuat. Letakkan link berikut di Bio Instagram <a href="https://'.env('SHORT_LINK').'/'. $page->premium_names.'">'.env('SHORT_LINK').'/'. $page->premium_names.'</a>';
        $arr['message'] = 'Update berhasil, silahkan copy link di bawah ini';
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
        if($request->id_title==0){
          $arr['status'] = 'error';
          $arr['message'] = 'Pilih link terlebih dahulu';
          return $arr;
        }

        $link = Link::find($request->id_title);

        $premiumid = PremiumID::where('user_id',Auth::user()->id)
                    ->where('link_id',$link->id)
                    ->where('type','singlelinks')
                    ->first();

        if(is_null($premiumid)){
          $premiumid = new PremiumID;
        }
        
        $premiumid->link_id = $link->id;
        $premiumid->user_id = Auth::user()->id;
        $premiumid->type = 'singlelinks';
        $premiumid->links = $request->custom_id;
        $premiumid->save();

        $link->premium_id = $premiumid->id;
        $link->premium_names = $request->custom_id;
        $link->save();

        $arr['status'] = 'success';
        $arr['message'] = 'Custom Link berhasil dibuat. Letakkan link berikut di Bio Instagram <a href="https://'.env('SHORT_LINK').'/'. $link->premium_names.'">'.env('SHORT_LINK').'/'. $link->premium_names.'</a>';
      } else {
        $arr['status'] = 'error';
        $arr['message'] = $validator->errors()->first();
      }
      
      return $arr;
    }
}
