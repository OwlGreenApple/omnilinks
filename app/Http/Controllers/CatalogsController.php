<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catalogs;
use App\Coupon;
use Storage;
use Carbon;
use DB;

class CatalogsController extends Controller
{

    public function index(){
      $now = Carbon::now();
      $coupon_global = Coupon::where([['user_id',0],['valid_until','>=',$now]])->get();
      return view('admin.list-catalog.index',['coupons'=>$coupon_global]);
    }

    public function AddCatalog(Request $request){
      $file = $request->file('catalog_image');
      $destination_path = storage_path('app/test/');
      $catalog = $update = null;
      $check_catalog_id = Catalogs::where('id','=',$request->id_catalog)->first();

      if(!is_null($check_catalog_id))
      {
        $oldpath = $check_catalog_id->path;
      }
      
      $statement = DB::select("SHOW TABLE STATUS LIKE 'catalogs'");
      $nextId = $statement[0]->Auto_increment;

      if(!is_null($check_catalog_id) && !empty($file))
      {
        $files = explode('.',$file->getClientOriginalName());
        $source = file_get_contents($file);

        #STORAGE
        $filename = $files[0].'-'.$nextId.'.'. $files[1];

        if(env('APP_ENV') == 'local')
        {
          $path = "catalogs/test/".$filename;
        }
        else
        {
          $path = "catalogs/real/".$filename;
        }
      }

      /*INSERT CATALOG*/
      if(is_null($check_catalog_id))
      {
          $catalog = new Catalogs;
          $catalog->coupon_id = $request->coupon_id;
          $catalog->label = $request->catalog_label;
          $catalog->type = $request->catalog_type;
          $catalog->path = $path;
          $catalog->coupon_url = $request->coupon_link;
          $catalog->kodekupon = $request->coupon_code;
          $catalog->valid_until = $request->valid_until;
          $catalog->desc = $request->deskripsi;
          $catalog->save();
          Storage::disk('s3')->put($path,$source,'public');
      }
      else
      {
           $data = array(
            'coupon_id'=>$request->coupon_id,
            'label' => $request->catalog_label,
            'type' => $request->catalog_type,
            'coupon_url'=> $request->coupon_link,
            'kodekupon'=> $request->coupon_code,
            'valid_until'=> $request->valid_until,
            'desc' => $request->deskripsi,
          );

          if(!is_null($check_catalog_id) && !empty($file))
          {
            Storage::disk('s3')->delete($oldpath);
            $filename = $files[0].'-'.$request->id_catalog.'.'. $files[1];
            if(env('APP_ENV') == 'local')
            {
              $path = "catalogs/test/".$filename;
            }
            else
            {
              $path = "catalogs/real/".$filename;
            }

            $data['path'] = $path;
            Storage::disk('s3')->put($path,$source,'public');
          }
         
          /*UPDATE CATALOG*/
          try {
              $update = Catalogs::where('id','=',$request->id_catalog)->update($data);
              $err['status'] = 'success';
              $err['message'] = 'Data catalog telah diubah';
              return response()->json($err);  
          } catch (\Illuminate\Database\QueryException $e) {
              $err['status'] = FALSE;
              $err['message'] = 'Data catalog gagal diubah';
              return response()->json($err);
          }
         
      }
     
      /*INSERT CATALOG*/
      if($catalog <> null && is_null($check_catalog_id)){
        $err['ins'] = 1;
        $err['status'] = 'success';
        $err['message'] = 'Data catalog telah disimpan';  
      }
      else {
        $err['status'] = FALSE;
        $err['message'] = 'Data catalog gagal disimpan';
      }
      return response()->json($err);
    }

    public function DataCatalog()
    {
      $catalogs = Catalogs::all();
      return view('admin.list-catalog.content',['data'=>$catalogs]);
    }

    public function DeleteCatalog(Request $request)
    {
        $id = $request->id;
        $catalog = Catalogs::where('id',$id)->first();
        $file_path = $catalog->path;
        $del = false;

        try{
          Catalogs::where('id',$id)->delete();
          $del = true;
          $err['status'] = 'success';
          $err['message'] = 'Data catalog telah dihapus';  
        }catch(\Illuminate\Database\QueryException $e){
          $err['status'] = FALSE;
          $err['message'] = 'Data catalog gagal dihapus';
        }

        if($del == true)
        {
          Storage::disk('s3')->delete($file_path);
        }

        return response()->json($err);
    }

/* end controller */
}
