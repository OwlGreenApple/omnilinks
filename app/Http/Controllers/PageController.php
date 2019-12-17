<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Page;

use Validator;

class PageController extends Controller
{
    protected function validator(array $data)
    {
      return Validator::make($data, [
        'kodekupon' => ['required','string','unique:coupons'],
        'diskon_value' => ['required','integer','min:0'],
        'diskon_percent' => ['required','integer','min:0','max:100'],
        'valid_until' => ['required','date','after:today'],
      ]);
    }

    public function index(){
      //halaman list kupon admin
      return view('admin.list-page.index');
    }

    public function load_page(Request $request){
      //halaman list kupon admin
      $pages = Page::where("user_id",0)->get();

      $arr['view'] = (string) view('admin.list-page.content')
              ->with('pages',$pages);  
      return $arr;
    }

}
