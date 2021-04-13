<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserLog;
<<<<<<< HEAD
use App\Link;
use App\Banner;
=======
>>>>>>> 391ba0ef364829dbc933fce6c453bc2675416771
use App\Helpers\Helper;
use App\Link;
use App\Banner;

use App\Http\Controllers\OrderController;

use Excel,DateTime,Hash,Validator,Auth,Carbon,Mail,DB;

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
      $users = DB::table('users')->select(DB::raw('COUNT(id) AS cid, DATE_FORMAT(created_at, "%Y-%m-%d") AS ct'))
              ->where([['created_at','<>',NULL],['is_admin','=',0]])->groupBy('ct')
              ->orderBy('ct', 'ASC')
              ->get();

      if($users->count() > 0)
      {
          foreach($users as $user)
          {
            $arr[$user->ct] = $user->cid;
          }
      }
      else
      {
          $arr = array();
      }
      
      return view('admin.list-user.index',['users'=>$arr]);
    }

    public function load_user(Request $request){
      //list user admin
      $users = User::orderBy('is_admin','desc')
                  ->orderBy('created_at','desc')
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

        /*if(!isset($failedRules['password']) or !isset($failedRules['email']['Unique'])){
          $arr['status'] = 'error';
          $arr['message'] = $validator->errors()->first();
          return $arr;
        } else */if(isset($failedRules['email']['Unique'])){
          if($user->email==$request->email){
          } else {
            $arr['status'] = 'error';
            $arr['message'] = $validator->errors()->first();
            return $arr;
          }
        } 
        // else if(isset($failedRules['password'])){
        // }
      }

      $user->name = $request->name;
      $user->email = $request->email;
      $user->username = $request->username;
      $user->is_admin = $request->is_admin;
      $user->membership = $request->membership;
      $user->point += $request->proof_views; 

      if(isset($request->unlimited)){
        // $user->valid_until = null;
        $user->valid_until = new DateTime('+999 days');
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

      if($request->password!='' or $request->password!=null){
        if(Hash::check($request->oldpassword, $user->password)){
          $user->password = Hash::make($request->password);
        } else {
          $arr['status'] = 'error';
          $arr['message'] = 'Password lama tidak sesuai';
          return $arr;
        }
      }

      $user->save();

      $arr['status'] = 'success';
      $arr['message'] = 'Edit User berhasil';

      return $arr;
    }

    public function load_log(Request $request){
      $logs = UserLog::where('user_id',$request->id)
              ->get();

      $arr['view'] = (string) view('admin.list-user.content-log')->with('logs',$logs);

      return $arr;
    }

    public function import_excel_user(Request $request)
    {
      $admin = Auth::user();
      $arr = [
        "status" => "success",
        "message" => "User berhasil di add",
      ];

      if ($admin->is_admin == 1) {

        $active_d = strtotime(''.$request->time_d.' day 0 second', 0);
        // $data = Excel::load(Input::file('import_file'), function($reader) {
        $data = Excel::load($request->import_file, function($reader) {

        })->get();

        if(!empty($data) && $data->count()){
          foreach ($data as $key) {
            foreach ($key as $value) {
              //echo $value->email;
              if (!filter_var($value->email, FILTER_VALIDATE_EMAIL) === false) {
                $password = "";
                //cek new user or update
                $user = User::where("email",$value->email)->first();
                
                if ( is_null($user) ) {
                    //klo new user
                    $pas = $value->username.$value->name;
                    $gh = substr($pas, 0,6);
                    $chrnd =substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);
                    $password = str_replace(' ','', $gh.$chrnd) ;
                  
                    $user = User::create([
                              'name' => $value->name,
                              'email' => $value->email,
                              'gender'=> 0,
                              'password' => Hash::make($password),
                              'username' => $value->email,
                              'membership' => "",
                            ]);
                    $user->referral_link = uniqid().md5($user->id);
                    $user->point = 10;
                }
                else {
                  //klo update user
                }
                $ordercont = new OrderController;
                $valid = $ordercont->add_time($user,"+".$request->time_d." days");
                $user->valid_until = $valid;
                $user->membership = 'elite';
                $user->save();
          
                $userlog = new UserLog;
                $userlog->user_id = $user->id;
                $userlog->type = 'membership';
                $userlog->value = 'elite';
                $userlog->keterangan = "Add Bonus user (excel) from admin";
                $userlog->save();
          
                //email data ke user
                $dt = Carbon::now();
                $dt->setDateFrom($valid);
                $dataEmail = [
                  "email" => $value->email,
                  "password" => $password,
                  "valid_until" => $dt->toDateTimeString(),
                ];
                Mail::send('emails.welcome', $dataEmail, function ($message) use ($dataEmail) {
                  $message->from('info@omnilinkz.com', 'Omnilinkz');
                  $message->to($dataEmail['email']);
                  $message->subject('[Omnilinkz] Bonus Berlangganan Omnilinkz');
                });
                if(env('MAIL_HOST')=='smtp.mailtrap.io'){
                  sleep(1);
                }
                
              }
            }
          }
        }
      }else{
        $arr = [
          "status" => "error",
          "message" => "Not Authorize",
        ];
      }
      return $arr;
    }

    public function user_list(){
      $user = Auth::user();
      if ($user->is_admin) {
          // $users = User::all();
          $users = User::
                    leftJoin("pages","users.id","=","pages.user_id")
                    ->select("users.id","users.email","pages.names","pages.premium_names")
                    ->get();
        return view('user.superadmin')->with('users',$users);
      } else {
        return "NOT AUTHORIZED";
      }
    }

    public function check_super($id){
      $admin = Auth::user();
      if ($admin->is_admin) {
        Auth::loginUsingId($id);
        return redirect("");
      } else {
        return "NOT AUTHORIZED";
      }
    }

    /* TO FLAG INAPPROPIATE LINK FROM TABLE LINKS */
    public function flag_link()
    {
      $list_links = Link::select('link','id')->get();

      if($list_links->count() > 0)
      {
        foreach($list_links as $row):
          $check_url = Helper::filter_url($row->link);
          if($check_url == 'omli.xyz')
          {
            continue;
          }

          $check = Helper::CheckTrustedLink($row->link);
          if($check == false)
          {
            $flagged = Link::find($row->id);
            $flagged->not_valid = 1;
            $flagged->save();
          }
        endforeach;
      }
    }

    /* TO FLAG INAPPROPIATE LINK FROM TABLE BANNER */
    public function flag_link_banner()
    {
      $list_links = Banner::select('link','id')->get();

      if($list_links->count() > 0)
      {
        foreach($list_links as $row):
          $check_url = Helper::filter_url($row->link);
          if($check_url == 'omli.xyz')
          {
            continue;
          }

          $check = Helper::CheckTrustedLink($row->link);
          if($check == false)
          {
            $flagged = Banner::find($row->id);
            $flagged->not_valid = 1;
            $flagged->save();
          }
        endforeach;
      }
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
