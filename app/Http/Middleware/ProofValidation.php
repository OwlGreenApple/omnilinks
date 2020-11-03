<?php

namespace App\Http\Middleware;

use Closure, Validator;

class ProofValidation
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
          'proof_name'=> ['required','min:4','max:17'],
          'proof_text'=> ['required','min:4','max:60'],
          'proof_stars'=> ['required','min:1','max:5','numeric']
        ];

        if($request->status == 0)
        {
            $rules['proof_image'] = ['required','mimes:jpeg,jpg,png','max:500'];
        }
        else
        {
            $rules['proof_image'] = ['mimes:jpeg,jpg,png','max:500'];
        }

        $message = [
          'required'=>'Data tidak boleh kosong',
          'min'=>'Data minimal :min',
          'max'=>'Data maximal :max',
          'numeric'=>'Data harus berupda angka',
          'mimes'=>'File harus dalam bentuk : jpeg,jpg,png',
        ];

        $valid = Validator::make($request->all(),$rules,$message);
        if($valid->fails() == true)
        {
            $err = $valid->errors();
            $errors = array(
              'error'=>1,
              'proof_name'=>$err->first('proof_name'),
              'proof_text'=>$err->first('proof_text'),
              'proof_stars'=>$err->first('proof_stars'),
              'proof_image'=>$err->first('proof_image'),
            );

          return response()->json($errors);
        }
        return $next($request);
    }
}
