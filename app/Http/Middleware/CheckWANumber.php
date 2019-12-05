<?php

namespace App\Http\Middleware;

use Closure;

class CheckWANumber
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
        if(!is_numeric($request->wa_number)){
          return redirect("register")->with("error", " No WA harus angka");
        }
        
        if(!preg_match("/^628+[0-9]/i",$request->wa_number)){
          return redirect("register")->with("error", " No WA Tidak Valid");
        }
        return $next($request);
    }
}
