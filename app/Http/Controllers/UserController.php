<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use DateTime,Hash,Validator,Auth;

class UserController extends Controller
{ 
    protected function validator(array $data){
      $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users|max:255',
        'username' => 'required|string|max:255',
        'valid_until' => 'date|after:today',
        'password' => 'required|string|min:6|confirmed',
      ];

      return Validator::make($data, $rules);
    }

    public function index(){
      //list user admin
      return view('admin.list-user.index');
    }

    public function load_user(Request $request){
      //list user admin
      $users = User::orderBy('is_admin','descend')
                  ->orderBy('created_at','descend')
                  ->get();

      $arr['view'] = (string) view('admin.list-user.content')
                        ->with('users',$users);
    
      return $arr;
    }

    public function add_user(Request $request){
      //add user via admin
      $validator = $this->validator($request->all());

      if(!$validator->fails()) {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->is_admin = $request->is_admin;
        $user->membership = $request->membership;

        if(isset($request->unlimited)){
          $user->valid_until = null;
        } else {
          if($request->valid_until==''){
            $arr['status'] = 'error';
            $arr['message'] = 'The valid until is required (or checked the unlimited instead)';
            return $arr;
          } else {
            $user->valid_until = new DateTime($request->valid_until);
          }
        }

        $user->password = Hash::make($request->password);
        $user->save();

        $arr['status'] = 'success';
        $arr['message'] = 'Add User berhasil';
      } else {
        $arr['status'] = 'error';
        $arr['message'] = $validator->errors()->first();
      }

      return $arr;
    }

    public function edit_user(Request $request){
      //edit user via admin
      $user = User::find($request->id_edit);

      $validator = $this->validator($request->all());

      if($validator->fails()){
        $failedRules = $validator->failed();

        if(!isset($failedRules['password']) or !isset($failedRules['email']['Unique'])){
          $arr['status'] = 'error';
          $arr['message'] = $validator->errors()->first();
          return $arr;
        } else if(isset($failedRules['email']['Unique'])){
          if($user->email==$request->email){
          } else {
            $arr['status'] = 'error';
            $arr['message'] = $validator->errors()->first();
            return $arr;
          }
        } else if(isset($failedRules['password'])){
        }
      }

      $user->name = $request->name;
      $user->email = $request->email;
      $user->username = $request->username;
      $user->is_admin = $request->is_admin;
      $user->membership = $request->membership;

      if(isset($request->unlimited)){
        $user->valid_until = null;
      } else {
        if($request->valid_until==''){
          $arr['status'] = 'error';
          $arr['message'] = 'The valid until is required (or checked the unlimited instead)';
          return $arr;
        } else {
          $user->valid_until = new DateTime($request->valid_until);
        }
      }

      $user->save();

      $arr['status'] = 'success';
      $arr['message'] = 'Edit User berhasil';

      return $arr;
    }

    public function index_edit(){
      //halaman edit profile user
      $user = Auth::user();
      return view('user.edit-profile.index')
              ->with('user',$user); 
    }

    public function edit_profile(Request $request){
      //edit profile via user
      $user = User::find(Auth::user()->id);

      $validator = $this->validator($request->all());

      if($validator->fails()){
        $failedRules = $validator->failed();
        
        if(isset($failedRules['email']['Unique'])){
          if($user->email==$request->email){
            if(isset($failedRules['password'])){
              if($request->password=='' or $request->password==null){
              } else {
                $arr['status'] = 'error';
                $arr['message'] = $validator->errors()->first();
                return $arr;
              }    
            }
          } else {
            $arr['status'] = 'error';
            $arr['message'] = $validator->errors()->first();
            return $arr;
          }
        } else if(isset($failedRules['password'])){
          if($request->password=='' or $request->password==null){
          } else {
            $arr['status'] = 'error';
            $arr['message'] = $validator->errors()->first();
            return $arr;
          }
        } else if(!isset($failedRules['password']) or !isset($failedRules['email']['Unique'])){
          $arr['status'] = 'error';
          $arr['message'] = $validator->errors()->first();
          return $arr;
        }
      }

      $user->name = $request->name;
      $user->username = $request->username;
      $user->email = $request->email;

      if($request->password=='' or $request->password!=null){
        $user->password = Hash::make($request->password);
      }

      $user->save();

      $arr['status'] = 'success';
      $arr['message'] = 'Edit User berhasil';

      return $arr;
    }


    /*public function index(Request $request)
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
        \App\Uses::create($request->all());
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
    }*/
}
