@extends('layouts.app')
@section('content')
<script src="{{ asset('js/custom.js') }}"></script>

<!-- MAIN -->
<div class="col-lg-12 bg-kupon fix-col">
  <!-- banner promo -->
  <div class="col-lg-12 banner-promo fix-col">
      <!--banner promo <br/> 1028 x 240-->
      <img src="{!! Storage::disk('s3')->url($banner) !!}"/>
  </div>

  <!-- SEARCH BOX -->
  <div class="container searchbox">
    <div class="row">
      <div class="col-lg-6">
          <div class="input-group kupon-form-sel">
			  <input id="kupon-search" type="text" class="form-control search-style" placeholder="Cari Kupon">
			  <div class="input-group-append">
					<button class="btn btn-kupon-src" type="button">
						<img src="{{asset('image/kupon/search.png')}}" />
					</button>
			  </div>
        </div>
      </div>
	 <!-- END SEARCH BOX -->

	  <!-- SORT BOX -->
      <div class="col-lg-6">
        <div class="form-inline kupon-form-sel">
          <label>Urutkan :&nbsp;</label>
          <select class="form-control kupon-select">
            <option>Pilih</option>
            <option value="1">Terbaru</option>
            <option value="2">Terlama</option>
          </select>
        </div>
      </div>
    </div>
   <div class="clearfix"></div>
  </div>
  <!-- END SORT BOX -->

  <div class="container fix-col">
  	<div id="catalog" class="row fix-row">
  		<!-- content -->
  	</div>
  </div>

  <!-- end main bg -->
</div>

<!-- FAQ -->
<div class="col-lg-12 bg-kupon-faq">
  <div class="container">
   <!-- SUPPORT -->
    <div class="col-lg-12 support-kupon">
      <h3>Butuh Bantuan <b>Tim Support</b> kami? <a onclick="window.location.href='mailto:info@omnilinkz.com';" class="btn btn-support-kupon"><b>Hubungi Kami Segera</b></a></h3>
    </div>
  </div>
</div>

<!---- JAVASCRIPT ---->
<script type="text/javascript">

$(document).ready(function(){
	display_content();
	search_kupon();
	sort_content();
});

function search_kupon() {
	$(".btn-kupon-src").click(function(){
		display_content();
	});
}

function sort_content(){
	$(".kupon-select").change(function(){
		var val = $(this).val();
		alert(val);
	});
} 

function display_content() {
	var vals = $("#kupon-search").val();
	$.ajax({
      type : 'GET',
      url : "{{url('catalog-content')}}",
	  data : {'value' : vals},
      dataType: 'html',
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');
        $('#catalog').html(result);
      }
    });
}
</script>


@if ( env('APP_ENV') !== "local" ) 
<!-- Provely Conversions App Display Code -->
<script>(function(w,n) {
if (typeof(w[n]) == 'undefined'){ob=n+'Obj';w[ob]=[];w[n]=function(){w[ob].push(arguments);};
d=document.createElement('script');d.type = 'text/javascript';d.async=1;
d.src='https://s3.amazonaws.com/provely-public/w/provely-2.0.js';x=document.getElementsByTagName('script')[0];x.parentNode.insertBefore(d,x);}
})(window, 'provelys', '');
provelys('config', 'baseUrl', 'app.provely.io');
provelys('config', 'https', 1);
provelys('data', 'campaignId', '16446');
provelys('config', 'widget', 1);
</script>
<!-- End Provely Conversions App Display Code -->
@endif
@endsection