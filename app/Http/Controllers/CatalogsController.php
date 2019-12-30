<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catalogs;

class CatalogsController extends Controller
{
    public function index(){
      return view('admin.list-catalog.index');
    }
}
