<?php

namespace App\Http\Middleware;

use Closure, Auth, Validator;
use App\Page;

class CheckWAMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userid = Auth::id();
        $wa_number = $request->chat_member_number;
        $uuid = $request->uuid;
        $pageid = $request->pageid;
        $photo = $request->file('chat_member_photo');
        $is_update = (int)$request->wa_id;

        $temp_arr = array();
        $temp_arr['chat_member_name'] = ['required', 'max:190' ];
        $temp_arr['chat_member_position'] = ['required','max:190' ];
        $temp_arr['uuid'] = ['required'];
        $temp_arr['pageid'] = ['required'];

         $messages = [
            'required' => 'Tidak berhasil disimpan, silahkan isi :attribute dahulu.',
            'max'    => 'Maksimal :attribute adalah :max karakter.',
        ];
        
        $validator = Validator::make($request->all(), $temp_arr, $messages); 

        if($validator->fails()) {
          $arr['status'] = 'error';
          $arr['message'] = $validator->errors()->first();
          return response()->json($arr);
        }

        $checkuid = Page::where([['uid','=',$uuid],['user_id','=',$userid]])->first();

        if(is_null($checkuid))
        {
          $arr['status'] = 'error';
          $arr['message'] = 'Silahkan login atau refresh browser anda';
          return response()->json($arr);
        }

        #wa number
         if(empty($wa_number))
         {
            $response['status'] = "error";
            $response['message'] = 'Perhatian! Kolom no WA tidak boleh kosong';
            return response()->json($response);
         }

         if(strlen($wa_number) > 16)
         {
            $response['status'] = "error";
            $response['message'] = 'Perhatian! Panjang karakter tidak boleh melebihi 16 karakter';
            return response()->json($response);
         } 

         if(!preg_match('/^[+][0-9]*$/',$wa_number))
         {
            $response['status'] = "error";
            $response['message'] = 'Perhatian! No Wa harus diawali tanda + dan berupa angka';
            return response()->json($response);
         }

         #photo
         if(empty($photo) && empty($is_update))
         {
            $response['status'] = "error";
            $response['message'] = 'Perhatian! Foto harus di upload';
            return response()->json($response);
         }

         $valid_ext = false;
         if(!empty($photo))
          {
              $arr_size = getimagesize($photo);
              $imagewidth = $arr_size[0];
              $imageheight = $arr_size[1];
              $ext = $photo->getClientOriginalExtension();

              if($imagewidth <> $imageheight)
              {
                  $response['status'] = "error";
                  $response['message'] = 'Perhatian! Ukuran foto harus 1 : 1';
                  return response()->json($response);
              }

              if($ext =='jpg' || $ext =='png' || $ext =='gif')
              {
                  $valid_ext = true;
              }

              if($valid_ext == false)
              {
                  $response['status'] = "error";
                  $response['message'] = 'Perhatian! Foto hanya boleh menggunakkan extension : jpg,png dan gif';
                  return response()->json($response);
              }
          }

        return $next($request);
    }
}
