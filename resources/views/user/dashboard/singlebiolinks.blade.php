@extends('layouts.app')

@section('content')
<script type="text/javascript">
	var currentPageLink="";
	var currentPagePixel="";
	var groupTab="link";
	function loadSinglePixel()
  {	
  	if(currentPagePixel=="")
  	{
  		currentPagePixel="<?php echo url('/pixel/load-singlepixel'); ?>";
  	}

    $.ajax({
      type : 'GET',
      data :{
      	cari:$('.cari').val(),
      },
      url :currentPagePixel,
      dataType: 'text',
      success: function (result)
      {
        var data=jQuery.parseJSON(result);
         $('#contentpixel').html(data.view);
          $('#pager').html(data.pager);
      }
    });
  }
  function loadSingleLinks()
  {
  	if(currentPageLink=="")
  	{
  		currentPageLink="<?php echo url('/dash/newsingle/load-singlelink')?>";
  	}
  	$.ajax({
  		type : 'GET',
  		data :{
  			carilink:$('.carilink').val(),
  		},
  		url :currentPageLink,
  		dataType: 'text',
  		success:function (result)
  		{
  			var data=jQuery.parseJSON(result);
  			$('#contentlink').html(data.view);
        $('#pageer').html(data.pager);
  		}	
  	});
  }
  function deleteSinglePixel(idpixel)
  {
  	$.ajax({
  		type : 'GET',
  		data :{
  			idpixel:idpixel,
  		},
  		url  : "<?php echo url('/pixel/deletesinglepixel');?>",
  		dataType: 'text',
  		success:function (result)
  		{
  			var data=jQuery.parseJSON(result);
  			if(data.status=="success")
  			{
  				loadSinglePixel();
  			}
  		}
  	});
  }
  function tambahLink()
  {
  	$.ajax({
  		type : 'POST',
		headers: {
	       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	     },
  		url: "<?php echo url('/save-singlelink')?>",
  		data :$("#formlink").serialize(),
  		dataType: 'text',
  		success :function(result)
  		{
  			$('#titlelink').val("");
  			$('#urllink').val("");
  			 loadSingleLinks();
  		}
  	});
  }
  function tambahPixel()
  {
  	$.ajax({
  		type : 'POST',
  		headers:{
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		},
  		url :"<?php echo url('/save-singlepixel') ?>",
  		data:$("#formpixel").serialize(),
  		dataType:'text',
  		success:function(result)
  		{
  			$('#titlepixel').val("");
  			$('#script').val("");
  			loadSinglePixel();
  		}
  	});
  }

$(document).ready(function(){
    loadSinglePixel();
    loadSingleLinks();
  });
</script>
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
		    <a class="nav-link active" href=".links" role="tab" data-toggle="tab" id="link-tab">Link</a>
		  </li>
	  <li class="nav-item">
	    <a class="nav-link" href=".pixels" role="tab" data-toggle="tab" id="pixel-tab">Pixel</a>
	  </li>
	</ul>

<!-- Tab panes -->
	<div class="tab-content">

			<!--Tab Link-->
	<div role="tabpanel" class="tab-pane fade in active show links" id="link">
		 <form method="post" id="formlink" novalidate>
      		{{ csrf_field() }}
 				<div class="form-group row" style="padding-top: 40px;">
     			<label for="title">Your title
          </label>
         		<input id="titlelink"  type="text" class="col-md-6 col-6 form-control formin" name="title"  placeholder=""  required>
        </div>

		  <div class="form-group row" style="padding-top: 40px;">
     			<label for="url">Url
          </label>
         <input type="text" class="col-md-6 col-6 form-control formin" name="url"  placeholder="" required id="urllink">
       </div>

         <div class="form-group row">
         	<label for="password-confirm">Pixel
          </label>
           <select name="idpixel" id="idpixel" class="col-md-6 col-6 form-control formin">
           <option value="">--Pilih--</option>
            @foreach($data_pixel as $pixel)
           <option value="{{$pixel->id}}">{{$pixel->title}}</option>
            	@endforeach
           </select>
         </div>
          <button type="button" id="submitlink" class="btn btn-primary">GENERATE</button>
	     </form>
		 </div>


		  <!--Tab Pixel-->
		  <div role="tabpanel" class="tab-pane fade pixels" id="pixel">
		  	<form method="post" id="formpixel" novalidate>
      		{{ csrf_field() }}
 		<div class="form-group row" style="padding-top: 40px;">
     	<label for="password-confirm">Your title
             </label>
             <input id="titlepixel" type="text" class="col-md-6 col-6 form-control formin" name="titlepixel"  placeholder=""  required>
            </div>
		  <div class="form-group row" style="padding-top: 40px;">
     	<label for="password-confirm">Pixel
             </label>
      <textarea name="script" id="script" class="col-md-6 col-6 form-control formin" required=""></textarea>
      </div>
    <input type="text" id="hiddenid" hidden="" name="hiddenid">
      <button type="reset" class="btn btn-warning">RESET</button>
        <button id="submitpixel" type="button" class="btn btn-primary">CREATE</button>
	      </form>	
		  </div>

		</div>

	  </div>
	 </div>

<div id="search-link" style="margin-bottom: 20px;">
  <span style="font-size: 20px; color: blue; ">Recent</span>
  <div style="float: right;">
   <input type="search" name="carilink" placeholder="Search Link" class="carilink" arial-label="Search"  style="">
    <button class="btn btn-success" id="carilink" type="button">Search</button>
    </div>
</div>

<div id="search-pixel" style="margin-bottom: 20px; display: none;" class="hidden">
  <span style="font-size: 20px; color: blue;">Recent</span>
  <div style="float: right;">
 <input type="search" name="cari" placeholder="Search Pixel" class="cari" arial-label="Search">
  <button class="btn btn-success" id="caripixel" type="button">Search</button>
  </div>
</div>

   <div class="card">
    <div class="card-body">
      <!--table link-->
      <div id="table-link"> 
       
          <table class="table">
          <thead align="center">
          <th class="">
             title
          </th>
            <th class="">
             pixel
            </th>
            <th class="">
              link
            </th>
          </thead>
          <tbody id="contentlink">
            
          </tbody>
         </table>
         <div id="pageer">
          
         </div>
      </div>

      <div id="table-pixel" class="hidden" style="display: none;"> 
       
          <table class="table">
          <thead align="center">
          <th class="">
             title
            </th>
            <th class="">
             Last Modified
            </th>
            <th class="">
              Action
            </th>
          </thead>
          <tbody id="contentpixel"></tbody>
         </table>
         <div id="pager"></div>
      </div>
    </div>
   </div>

	 </div>
	</div>
</div>

<script type="text/javascript">
	$("body").on("click","#caripixel",function(){
		loadSinglePixel();
	});

	$("body").on("click","#carilink",function(){
		loadSingleLinks();
	});

	$("body").on("click",".btn-deletepixelsingle",function(){
		var idpixel =$(this).attr('dataid');
		deleteSinglePixel(idpixel);
	});

	$("body").on("click","#submitlink",function(){
		tambahLink();
	});

	$("body").on("click","#submitpixel",function(){	
		tambahPixel();
	});

	$("body").on("click",".btn-editpixel",function(){
		var ideditpixel=$(this).attr('dataeditid');
		var title=$(this).attr('datatitle');
		var script=$(this).attr('datascript');
		console.log(ideditpixel);
		$('#hiddenid').val(ideditpixel);
		$('#titlepixel').val(title);
	  $('#script').val(script);	
	});
	$(document).on('click','#link-tab',function(){
		groupTab="link";
    $('#table-pixel').hide();
    $('table-pixel').addClass('hidden');
    $("#table-link").show();
    $("#table-link").removeClass('hidden');
    $('#search-pixel').hide();
    $('search-pixel').addClass('hidden');
    $("#search-link").show();
    $("#search-link").removeClass('hidden');
    return false;
	});
	$(document).on('click','#pixel-tab',function(){
		groupTab="pixel";
      $('#table-link').hide();
      $('table-link').addClass('hidden');
      $("#table-pixel").show();
      $("#table-pixel").removeClass('hidden');
      $('#search-link').hide();
      $('#search-link').addClass('hidden');
      $("#search-pixel").show();
      $("#search-pixel").removeClass('hidden');
      return false;
	});
	$(document).on('click', '.pagination a', function (e) {
   	e.preventDefault();
  
   	if(groupTab=="link")
   	{ 	
   		currentPageLink = $(this).attr('href');
   		loadSingleLinks();
   	}
   	else
   	{
   		currentPagePixel= $(this).attr('href');
   		loadSinglePixel();
   	}
 	});

	
 	
</script>
@endsection
