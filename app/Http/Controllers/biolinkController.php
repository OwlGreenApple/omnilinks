<?php

namespace App\Http\Controllers;
use App\page;
use Illuminate\Http\Request;

class biolinkController extends Controller
{
    public function newbio()
    {
     return view('user.dashboard.biolinks');
    }
    public function savebio(Request $request)
    {

    }
}
