<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
       if($request->has('cari'))
       {
           $data_user=\App\uses::where('fullname','like','%'.$request->cari.'%')->get();
       }
       else
       {
        $data_user=\App\uses::latest()->paginate(3);
    }
        return view('user.index',['data_user'=>$data_user]);
    }
    public function create(Request $request)
    {
        \App\Uses::create( $request->all());
        return redirect('/use');
    }
    public function edit($id)
    {
        $edit=\App\uses::find($id);
        return view('user/edit',['edit_user'=>$edit]);
    }
    public function update(Request $request,$id)
    {
        $edit=\App\uses::find($id);
        $edit->update($request->all());
        return redirect('/use');
    }
    public function delete($id)
    {
        $delete=\App\uses::find($id);
        $delete->delete($delete);
        return redirect('/use');
    }
    }
