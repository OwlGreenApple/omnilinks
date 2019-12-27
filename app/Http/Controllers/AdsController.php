<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

use App\Helpers\Helper;

use App\Ads;
use App\AdsHistory;

use Auth, DB, Validator, Carbon; 

class AdsController extends Controller
{
		protected function validator(array $data) {
	    return Validator::make($data, [
	      'headline' => ['required', 'string', 'max:100'],
	      'description' => ['required', 'string', 'max:100'],
	      'redirect' => ['required', 'string', 'active_url'],
	    ]);
	  }

    public function ads_pricing(Request $request){
    	$ads = Ads::where('user_id',Auth::user()->id)->first();
    	if(is_null($ads)){
    		return 'Buat Ads terlebih dahulu sebelum melakukan Top Up';
    	} else {
    		return view('user.ads.ads-pricing');	
    	}
    }

   	public function ads_manager(Request $request){
      $user = Auth::user();
   		$ads = Ads::where('user_id',$user->id)->first();

   		return view('user.ads.ads-manager')
   						->with([
              'ads'=>$ads,
              'user'=>$user
              ]);	
   	}

   	public function paginate($items, $perPage = 15, $page = null, $options = [])
		{
			$page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
			$items = $items instanceof Collection ? $items : Collection::make($items);
			return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
		}

   	public function load_credit_history(Request $request){
   		$history1 = AdsHistory::where('user_id',Auth::user()->id)
   								//->where('ads_id',$request->id)
   								->whereMonth('created_at', '=', $request->bulan)
   								->whereYear('created_at', '=', $request->tahun)
   								->where('description','not like','%top up%')
   								->select(DB::raw('sum(jml_credit)*-1 as selisih'),DB::raw('DATE(created_at) as date'), DB::raw('sum(is_click) as click'), DB::raw('sum(is_view) as view'),DB::raw('count(*) as description'))
      						->groupBy('date')
   								->get();

   		$history2 = AdsHistory::where('user_id',Auth::user()->id)
   								//->where('ads_id',$request->id)
   								->whereMonth('created_at', '=', $request->bulan)
   								->whereYear('created_at', '=', $request->tahun)
   								->where('description','like','%top up%')
   								->select(DB::raw('jml_credit as selisih'),DB::raw('DATE(created_at) as date'), DB::raw('is_click as click'), DB::raw('is_view as view'),'description')
   								->get();

   		$histories = $history1->toBase()->merge($history2);

   		if($request->status=='not-sort'){
	      $histories = $histories->sortByDesc('date');
	    } else {
	      $histories = Helper::sorting($histories,$request->status,$request->act);
	    }

   		$histories = $this->paginate($histories);

	    $arr['view'] = (string) view('user.ads.credit-history')
	                    ->with('histories',$histories);
	    $arr['pager'] = (string) view('user.ads.credit-history-pagination')
                    	->with('histories',$histories);
	  
	    return $arr;
   	}

   	public function save_ads(Request $request){
   		$validator = $this->validator($request->all());

   		if(!$validator->fails()) {
   			$ads = Ads::where('user_id',Auth::user()->id)->first();
	   		if(is_null($ads)){
	   			$ads = new Ads;
	   		}

	   		$ads->user_id = Auth::user()->id;
	   		$ads->headline = $request->headline;
	   		$ads->description = $request->description;
	   		$ads->link = $request->redirect;
	   		$ads->save();

	   		$arr['status'] = 'success';
	   		$arr['ads'] = $ads;
	   		$arr['message'] = 'Save ads berhasil';
	   		return $arr;
   		} else {
   			$arr['status'] = 'error';
   			$arr['ads'] = null;
        $arr['message'] = $validator->errors()->first();
        return $arr;
   		}
   	}

   	public function click_ads($id){
   		$ads = Ads::find($id);

   		if(!is_null($ads)){
   			$adshistory = new AdsHistory;
        $adshistory->user_id = $ads->user_id;
        $adshistory->ads_id = $ads->id;
        $adshistory->credit_before = $ads->credit;
        $adshistory->credit_after = $ads->credit - 2;
        $adshistory->jml_credit = 2;
        $adshistory->is_click = 1;
        $adshistory->description = 'click';
        $adshistory->save();

        $ads->credit = $ads->credit-2;
        $ads->save();
   		}

   		return redirect($ads->link);
   	}

   	public function ads_checkout($id){
   		//halaman checkout
    	return view('pricing.checkout')->with(array(
              'id'=>$id,
              'type'=>'ads-package',
            ));
   	}

    public function index(){
      //list user admin
      return view('admin.list-ads.index');
    }

    public function load_ads(Request $request){
      //list user admin
      $ads = Ads::orderBy('created_at','descend')
                  ->get();

      $arr['view'] = (string) view('admin.list-ads.content')
                        ->with('ads',$ads);
    
      return $arr;
    }

    public function view_log(Request $request){
      $adsHistory = AdsHistory::where('user_id',$request->id)
              ->get();

      $arr['view'] = (string) view('admin.list-ads.content-log')->with('adsHistory',$adsHistory);

      return $arr;
    }

}
