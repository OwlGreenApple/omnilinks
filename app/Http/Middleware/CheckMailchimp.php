<?php

namespace App\Http\Middleware;

use Closure, Validator;

class CheckMailchimp
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
          'api_mc_email'=>['required','email','max:190'],
          'api_mc_fname'=>['required','min:4','max:190'],
          'api_mc_lname'=>['max:190'],
        ];

        $check = Validator::make($request->all(),$rules);

        if($check->fails() == true)
        {
          $err = $check->errors();
          $errors = [
            'success'=>2,
            'api_mc_fname'=>$err->first('api_mc_fname'),
            'api_mc_lname'=>$err->first('api_mc_lname'),
            'api_mc_email'=>$err->first('api_mc_email')
          ];

          return response()->json($errors);
        }

        return $next($request);
    }
}
