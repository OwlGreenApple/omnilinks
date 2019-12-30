<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catalogs;
use Storage;

class CatalogsController extends Controller
{

    public function index(){
      return view('admin.list-catalog.index');
    }

    public function AddCatalog(Request $request){
      $file = $request->file('catalog_image');
      $destination_path = storage_path('app/test/');

      $catalog = new Catalogs;
      $catalog->coupon_id = $request->coupon_id;
      $catalog->label = $request->catalog_label;
      $catalog->type = $request->catalog_type;
      $catalog->path = $destination_path.'/'.$file->getClientOriginalName();
      $catalog->desc = $request->deskripsi;
      $catalog->save();
      $file->move($destination_path,$file->getClientOriginalName());

      if($catalog->save()){
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

    public function EditCatalog(Request $request)
    {
      $file = $request->file('catalog_image');
      $destination_path = storage_path('app/test/');

      $data = array(
        'coupon_id'=>$request->coupon_id,
        'label' => $request->catalog_label,
        'type' => $request->catalog_type,
        'path' => $destination_path.'/'.$file->getClientOriginalName(),
        'desc' => $request->deskripsi,
      );
      $update = Catalogs::where('id','=',$request->id)->update($data);
    }

/* end controller */
}
