<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Account;
use App\HistorySearch;
use App\User;
use App\Group;
use App\Save;
use App\Order;
use App\UserLog;
use App\Notification;
use App\Mail\ConfirmOrderMail;

use App\Helpers\Helper;
use Carbon, Crypt;
use Auth,Mail,Validator,Storage,DateTime;

class OrderController extends Controller
{
    public function register(Request $request) 
    {
        return view('auth.register')->with(array(
			"price"=>$request->price,
			"namapaket"=>$request->namapaket,
		));
    }
    public function index_order()
    {
      return view('order.index');
    }
    public function load_order(Request $request)
    {
      $orders = Order::where('userid',Auth::user()->id)
                  ->orderBy('created_at','descend')
                  ->paginate(15);
                  //->get();
      $arr['view'] = (string) view('order.content')
                        ->with('orders',$orders);
      $arr['pager'] = (string) view('order.pagination')
                        ->with('orders',$orders); 
      return $arr;
    }
    public function load_list_order(Request $request)
    {
      $orders = Order::join('users','orders.userid','users.id')  
                  ->select('orders.*','users.email')
                  ->orderBy('created_at','descend')
                  ->get();
      $arr['view'] = (string) view('admin.list-order.content')
                        ->with('orders',$orders);
      /*$arr['pager'] = (string) view('admin.list-order.pagination')
                        ->with('orders',$orders); */
      return $arr;
    }
  
    public function confirm_payment_order(Request $request)
    {
        $order = Order::find($request->id_confirm);
        $folder = Auth::user()->email.'/buktibayar';
  
        if($order->status==0){
          $order->status = 1;
  
          if($request->hasFile('buktibayar')){
            $path = Storage::putFile('bukti',$request->file('buktibayar'));
            $order->bukti_bayar = $path;
            
          } else {
            $arr['status'] = 'error';
            $arr['message'] = 'Upload file buktibayar terlebih dahulu';
            return $arr;
          }  
          $order->keterangan = $request->keterangan;
          $order->save();
  
          $arr['status'] = 'success';
          $arr['message'] = 'Konfirmasi pembayaran berhasil';
        } else {
          $arr['status'] = 'error';
          $arr['message'] = 'Order telah atau sedang dikonfirmasi oleh admin';
        }
  
        return $arr;
    }
    public function confirm_payment(Request $request){
        $user = Auth::user();
        $dt = Carbon::now();
        $order = new Order;
        $str = 'OMNILI'.$dt->format('ymdHi');
        $order_number = Helper::autoGenerateID($order, 'no_order', $str, 3, '0');
        $order->no_order = $order_number;
        $order->userid = $user->id;
        $order->package =$request->namapaket;
        //$order->jmlpoin = 0;
        $order->coupon=0;
        $order->total = $request->price;
        $order->discount = 0;
        $order->status = 0;
        $order->bukti_bayar = "";
        $order->keterangan = "";
        $order->save();
        //mail order to user 
        $emaildata = [
            'order' => $order,
            'user' => $user,
            'nama_paket' => $request->namapaket,
            'no_order' => $order_number,
        ];
        Mail::send('emails.order', $emaildata, function ($message) use ($user,$order_number) {
          $message->from('no-reply@omnilinks.com', 'Omnilinks');
          $message->to($user->email);
          $message->subject('[Omnilinks] Order Nomor '.$order_number);
        });
    
        return view('pricing.thankyou');
      }
      public function checkout($id){
        return view('pricing.checkout')->with(array(
                'id'=>$id,		
            ));
      }
      
}
