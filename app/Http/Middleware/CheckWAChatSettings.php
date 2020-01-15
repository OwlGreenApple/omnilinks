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
        $temp_arr['wa_btn_text'] = ['required', 'max:190' ];
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

        return $next($request);
    }
}
