<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catalogs;

class CatalogsController extends Controller
{
    public function index(){
      return view('admin.list-catalog.index');
    }

    public function AddCatalog(Request $request){
      $file = $request->file('catalog_image');

      $catalog = new Catalogs;
      $catalog->label = $request->catalog_label;
      $catalog->coupon_id = $request->coupon_id;
      $catalog->type = $request->catalog_type;
      $catalog->path = $file;
      $catalog->desc = $request->deskripsi;
      $catalog->save();
    }
}
