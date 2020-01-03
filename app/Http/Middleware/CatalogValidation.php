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
        $idcatalog = (int) $request->id_catalog;
        $file = $request->file('catalog_image');
        $catalog = null;

        if(empty($request->catalog_label))
        {
          $error['status'] = false;
          $error['message'] = 'Label tidak boleh kosong';
          return response()->json($error);
        }

        if(empty($file) && empty($request->id_catalog))
        {
          $error['status'] = false;
          $error['message'] = 'File image tidak boleh kosong';
          return response()->json($error);
        }

        $catalog_id = null;
        if($type == 'main' || $type == 'auto-generate'){
          $catalog = Catalogs::where('type','=',$type)->first();
        } 

        if(!is_null($catalog))
        {
          $catalog_id = $catalog->id;
        }

        if($catalog_id <> $idcatalog){
          $valid_id = false;
        } else {
          $valid_id = true;
        }

        if(!is_null($catalog) && $valid_id == false) {
          $error['status'] = false;
          $error['message'] = 'Catalog dengan tipe <strong>'.$type.'</strong> hanya boleh dibuat 1 kali saja';
          return response()->json($error);
        }

        return $next($request);
    }
}
