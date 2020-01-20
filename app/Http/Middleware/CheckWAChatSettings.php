<?php

namespace App\Http\Middleware;

use Closure, Auth, Validator;
use App\Page;

class CheckWAChatSettings
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
        $wa_btn_text = $request->wa_btn_text;  
        $wa_header = $request->wa_header; 
        $uuid = $request->uuid;

        $temp_arr = array();
        $temp_arr['wa_btn_text'] = ['required', 'max:24' ];
        $temp_arr['wa_header'] = ['required','max:500' ];
        $temp_arr['uuid'] = ['required'];

         $messages = [
            'required' => 'Tidak berhasil disimpan, silahkan isi :attribute dahulu.',
            'max'    => 'Maksimal :attribute adalah :max karakter.',
        ];
        
        $validator = Validator::make($request->all(), $temp_arr, $messages); 

        $checkuid = Page::where([['uid','=',$uuid],['user_id','=',$userid]])->first();
    
        if($validator->fails()) {
          $arr['status'] = 'error';
          $arr['message'] = $validator->errors()->first();
          return response()->json($arr);
        }

        if(is_null($checkuid))
        {
          $arr['status'] = 'error';
          $arr['message'] = 'Silahkan login atau refresh browser anda';
          return response()->json($arr);
        }

        #--- VALIDATION WA CHAT MEMBERS ---

        $chat['name'] = $request->member_name;
        $chat['position'] = $request->position;
        $chat['wa_number'] = $request->wa_number;
        $chat['photo'] = $request->photo;

        #member_name
        if(!empty($chat['name']))
        {
          foreach($chat['name'] as $id=>$name)
          {
             #empty case
             if(empty($name))
             {
                $response['status'] = "error";
                $response['message'] = 'Perhatian! Nama tidak boleh kosong';
                return response()->json($response);
             }

             if(strlen($name) > 190)
             {
                $response['status'] = "error";
                $response['message'] = 'Perhatian! Panjang karakter tidak boleh melebihi 190 karakter';
                return response()->json($response);
             }
          }
        }

        #position
        if(!empty($chat['position']))
        {
          foreach($chat['position'] as $id=>$position)
          {
             #empty case
             if(empty($position))
             {
                $response['status'] = "error";
                $response['message'] = 'Perhatian! Kolom posisi / jabatan tidak boleh kosong';
                return response()->json($response);
             }

             if(strlen($position) > 190)
             {
                $response['status'] = "error";
                $response['message'] = 'Perhatian! Panjang karakter tidak boleh melebihi 190 karakter';
                return response()->json($response);
             }
          }
        } 

        #wa number
        if(!empty($chat['wa_number']))
        {
          foreach($chat['wa_number'] as $id=>$wa_number)
          {
             #empty case
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
          }
        }

        #photo
        if(!empty($chat['photo']))
        {
          $valid_ext = false;
          foreach($chat['photo'] as $id=>$photo)
          {
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
            
          }
        }

        return $next($request);
    }
}
