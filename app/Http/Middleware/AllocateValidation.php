<?php

namespace App\Http\Middleware;

use Closure, Validator;
use App\Rules\CheckValidPageID;
use App\Rules\CheckPageName;

class AllocateValidation
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
        $rules = [
          'id'=>['required','numeric',new CheckValidPageID],
          'nominal'=>['required','numeric','min:0'],
          'page'=>['required',new CheckPageName],
        ];

        $message = [
          'required'=>'Kolom tidak boleh kosong',
          'numeric'=>'Data harus berupa angka',
          'min'=>'Jumlah credit minimal :min',
        ];

        $validator = Validator::make($request->all(),$rules,$message);

        if($validator->fails() == true)
        {
          $err = $validator->errors();
          $errors = [
            'err'=>4,
            'id'=>$err->first('id'),
            'nominal'=>$err->first('nominal'),
            'page'=>$err->first('page')
          ];

          return response()->json($errors);
        }
        return $next($request);
    }
}
