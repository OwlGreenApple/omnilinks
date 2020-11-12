<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Crypt;

use App\Page;
use App\Link;
use App\Banner;
use App\ProofHistory;
use App\User;

use Validator, Auth, Carbon;

class ProofController extends Controller
{
    public function index()
    {
      $user = Auth::user();
      $data = array(
        'total_proof_credit'=>str_replace(',','.',number_format($user->point))
      );
     
      return view('user.proof.index',$data);
    }

    //mengurangi point page per user visit hlmn omli
    public function count_page_point(Request $request)
    {
      $auth = Auth::id();
      $updated = false;
      $page =  Page::where([['user_id',$request->user_id],['names',$request->page]])->orWhere('premium_names',$request->page)->first();

      $proof_history = ProofHistory::where([['user_id',$request->user_id],['page_name',$request->page],['ip_address',$request->ip]])->whereDate('created_at', Carbon::today())->get();

      if(is_null($page) || $auth == $request->user_id || $proof_history->count() >= 3)
      {
         exit();
      }

      $current_page_point = $page->point;
      if($current_page_point > 0)
      {
          $updated_page_point = $current_page_point - 1;
      }
      else
      {
          exit();
      }

      try
      {
        $page->point = $updated_page_point;
        $page->save();
        $updated = true;
      }
      catch(QueryException $e)
      {
        //$e->getMessage();
        exit();
      }

      if($updated == true)
      {
        $ph = new ProofHistory;
        $ph->user_id = $request->user_id;
        $ph->page_name = $request->page;
        $ph->ip_address = $request->ip;
        $ph->kredit = 1;

        try
        {
          $ph->save();
        }
        catch(QueryException $e)
        {
          //$e->getMessage();
        }
      }
      exit();
    }

    public function display_links()
    {
        $page = Page::where('user_id',Auth::id())->get();

        if($page->count() > 0)
        {
          foreach($page as $row):
            if($row->premium_names <> null || !empty($row->premium_names))
            {
                $names = $row->premium_names;
            }
            else
            {
                $names = $row->names;
            }

            $data[] = [
              'id'=>$row->id,
              'name'=>$names,
              'credit'=>$row->point
            ];
          endforeach;
        }
        return view('user.proof.content',['pages'=>$data]);
    }

    public function counting_point(Request $request)
    {
        $page_id = $request->id;
        $nominal = $request->nominal;
        $purpose = $request->purpose;

        $page = Page::find($page_id);
   
        //purpose 1 = add points
        if($purpose == 1)
        {
          try{
            $page->point += $nominal;
            $page->save();
            $res['err'] = 0;
          }
          catch(QueryException $e)
          {
            //$e->getMessage();
            $res['err'] = 1;
          }

          return response()->json($res);
        }

        //substract

        $diff = $page->point - $nominal;
        if($diff >= 0)
        {
          try{
            $page->point = $diff;
            $page->save();
            $res['err'] = 0;
          }
          catch(QueryException $e)
          {
            //$e->getMessage();
            $res['err'] = 1;
          }
        }
        else
        {
            $res['err'] = 2;
        }
        return response()->json($res);
  }

/* END CONTROLLER */
}
