@extends('layouts.app')

@section('content')
<style type="text/css">
	.formin{
		margin-left: 20px;
		padding-left:20px ; 
	}
</style>
	<link rel="stylesheet" href="{{asset('css/dash.css')}}">
	<div class="notification container notif">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>Masa trial anda akan berakhir dalam 5 hari. <span style="color:blue;">Subscribe</span>
        untuk terus menggunakan Omnilinks
       </div>
    </div>
     @if (session('ok') )
   <div class="notification container notif">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>{{session('ok')}}
       </div>
    </div>
    @endif 
    
<div class="container">
  <div class="row">
    <div class="col-md-12">
   		<div class="card" style="margin-bottom:20px;">
    		<div class="card-body">
    <ul class="nav nav-tabs" role="tablist">
		  <li class="nav-item">
		    <a class="nav-link active" href="#link" role="tab" data-toggle="tab">Link</a>
		  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="#pixel" role="tab" data-toggle="tab">Pixel</a>
	  </li>
	</ul>

<!-- Tab panes -->
		<div class="tab-content">
			<!--Tab Link-->
		 <div role="tabpanel" class="tab-pane fade in active" id="link">
		  <form method="post" action="{{url('save-singlelink')}}" novalidate>
      		{{ csrf_field() }}
 		<div class="form-group row" style="padding-top: 40px;">
     	<label for="password-confirm">Your title
             </label>
             <input id="password-confirm" type="text" class="col-md-6 col-6 form-control formin" name="title"  placeholder=""  required>
            </div>
		  <div class="form-group row" style="padding-top: 40px;">
     	<label for="password-confirm">Url
             </label>
             <input  type="text" class="col-md-6 col-6 form-control formin" name="url"  placeholder=""  required>
            </div>
            <div class="form-group row">
            <label for="password-confirm">Pixel
             </label>
            <select name="idpixel" class="col-md-6 col-6 form-control formin">
            	<option value="">--Pilih--</option>
            	@foreach($data_pixel as $pixel)
            	<option value="{{$pixel->id}}">{{$pixel->title}}</option>
            	@endforeach
            </select>
            </div>
            <button type="submit" class="btn btn-primary">GENERATE</button>
	      </form>
		  </div>
		  <!--Tab Pixel-->
		  <div role="tabpanel" class="tab-pane fade" id="pixel">
		  	<form method="post" action="{{url('save-singlepixel')}}" novalidate>
      		{{ csrf_field() }}
 		<div class="form-group row" style="padding-top: 40px;">
     	<label for="password-confirm">Your title
             </label>
             <input id="password-confirm" type="text" class="col-md-6 col-6 form-control formin" name="titlepixel"  placeholder=""  required>
            </div>
		  <div class="form-group row" style="padding-top: 40px;">
     	<label for="password-confirm">Pixel
             </label>
             <textarea name="script" class="col-md-6 col-6 form-control formin"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">CREATE</button>
	      </form>
		  </div>
		  
		</div>
	   </div>
	   </div>
	  </div>
	</div>
</div>
	@endsection
