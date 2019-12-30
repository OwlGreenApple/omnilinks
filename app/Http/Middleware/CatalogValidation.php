<?php

namespace App\Http\Middleware;

use Closure;
use App\Catalogs;
use Illuminate\Http\Response;

class CatalogValidation
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
        $type = $request->catalog_type;
        $file = $request->file('catalog_image');
        $catalog = null;

        if(empty($file))
        {
          $error['status'] = false;
          $error['message'] = 'File image tidak boleh kosong';
          return response()->json($error);
        }

        if($type == 'main'){
          $catalog = Catalogs::where('type','=',$type)->first();
        } 

        if(!is_null($catalog)){
          $error['status'] = false;
          $error['message'] = 'Catalog dengan tipe <strong>main</strong> hanya boleh dibuat 1 kali saja';
          return response()->json($error);
        }

        return $next($request);
    }
}
