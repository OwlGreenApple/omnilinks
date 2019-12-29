@extends('layouts.app')
@section('content')
<script src="{{ asset('js/custom.js') }}"></script>


<!-- MAIN -->
<div class="col-lg-12 bg-kupon fix-col">
  <!-- banner promo -->
  <div class="col-lg-12 banner-promo fix-col">
      banner promo <br/> 1028 x 240
  </div>

  <!-- SEARCH BOX -->
  <div class="container searchbox">
    <div class="row">
      <div class="col-lg-6">
          <div class="input-group kupon-form-sel">
          <input type="text" class="form-control search-style" placeholder="Cari Kupon">
          <div class="input-group-append">
            <button class="btn btn-kupon-src" type="button">
				<img src="{{asset('image/kupon/search.png')}}" />
            </button>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="form-inline kupon-form-sel">
          <label>Urutkan :&nbsp;</label>
          <select class="form-control kupon-select" id="sel1" name="sellist1">
            <option>Terbaru</option>
          </select>
        </div>
      </div>
    </div>
   <div class="clearfix"></div>
  </div>
  <!-- END SEARCH BOX -->

  <!-- COUPON -->
  <div class="container fix-col">
	<div class="row fix-row">
	
			<!--- COUPON 1 --->
			<div class="col-lg-4 col-md-12 col-12">
			  <div class="col-box">
				<div class="col-box-shadow">
					<!-- Header / Board -->
				  <div class="col-md-12 kupon-board pro-fix" align="center">
					 <h3>BANNER PROMO</h3>
				  </div>

					<!-- Desc -->
				  <div class="col-md-12 kupon-desc">
					tingkatkan penjualan mu diawal tahun lebih hemat 50%
				  </div>

					<!-- Valid untill -->
				  <div class="col-md-12 mb-5">
					<div class="row kupon-valid">
					  <div class="kupon-image"><img src="{{asset('image/kupon/clock_green.png')}}"/></div>
					  <div class="kupon-exp">Berlaku Hingga<br/><span class="opb">1- 5 Januari 2020</span></div>
					  <div class="clearfix"></div>
					</div>
					<div class="row kupon-valid">
					  <div class="kupon-image"><img src="{{asset('image/kupon/kupon_green.png')}}"/></div>
					  <div class="kupon-exp">Kode Promo<br/> <span class="opb kupon-kode">makinlaris20</span></div>
					  <div class="kupon-paste"><a  class="btn btn-kupon-copy btn-sm">Salin Kode</a></div>
					  <div class="clearfix"></div>
					</div>
				  </div>
				  
					<!-- Button -->
				   <div class="col-md-12 mb-4 pb-3">
					  <a class="btn btn-block btn-kupon"> Lihat Detail</a>
				  </div>
			
				</div>
			  </div>
			</div> 
			
			<!--- COUPON 2 --->
			<div class="col-lg-4 col-md-12 col-12">
			  <div class="col-box">
				<div class="col-box-shadow">
					<!-- Header / Board -->
				  <div class="col-md-12 kupon-board pro-fix" align="center">
					 <h3>BANNER PROMO</h3>
				  </div>

					<!-- Desc -->
				  <div class="col-md-12 kupon-desc">
					tingkatkan penjualan mu diawal tahun lebih hemat 50%
				  </div>

					<!-- Valid untill -->
				  <div class="col-md-12 mb-5">
					<div class="row kupon-valid">
					  <div class="kupon-image"><img src="{{asset('image/kupon/clock_green.png')}}"/></div>
					  <div class="kupon-exp">Berlaku Hingga<br/>
							<div class="kupon-timer">
								12 : 40 : 29
							</div>
					  </div>
					</div>
					<div class="row kupon-valid">
					  <div class="kupon-image"><img src="{{asset('image/kupon/kupon_green.png')}}"/></div>
					  <div class="kupon-exp">Kode Promo<br/> <span class="opb kupon-kode">makinlaris20</span></div>
					  <div class="kupon-paste"><a  class="btn btn-kupon-copy btn-sm">Salin Kode</a></div>
					</div>
				  </div>
				  
					<!-- Button -->
				   <div class="col-md-12 mb-4 pb-3">
					  <a class="btn btn-block btn-kupon"> Lihat Detail</a>
				  </div>
			
				</div>
			  </div>
			</div> 
			
			<!--- COUPON 3 --->
			<div class="col-lg-4 col-md-12 col-12">
			  <div class="col-box">
				<div class="col-box-shadow">
					<!-- Header / Board -->
				  <div class="col-md-12 kupon-board pro-fix" align="center">
					 <h3>BANNER PROMO</h3>
				  </div>

					<!-- Desc -->
				  <div class="col-md-12 kupon-desc">
					tingkatkan penjualan mu diawal tahun lebih hemat 50%
				  </div>

					<!-- Valid untill -->
				  <div class="col-md-12 mb-5">
					<div class="row kupon-valid">
					  <div class="kupon-image"><img src="{{asset('image/kupon/clock_grey.png')}}"/></div>
					  <div class="kupon-exp">Berlaku Hingga<br/><span class="opb">1- 5 Januari 2020</span></div>
					</div>
					<div class="row kupon-valid">
					  <div class="kupon-image"><img src="{{asset('image/kupon/kupon_grey.png')}}"/></div>
					  <div class="kupon-exp">Kode Promo<br/> <span class="opb kupon-kode">makinlaris20</span></div>
					  <div class="kupon-paste"><a  class="btn btn-kupon-copy btn-sm">Salin Kode</a></div>
					</div>
				  </div>
				  
					<!-- Button -->
				   <div class="col-md-12 mb-4 pb-3">
					  <a class="btn btn-block btn-kupon"> Lihat Detail</a>
				  </div>
			
				</div>
			  </div>
			</div> 
			
			<!--- COUPON 4 --->
			<div class="col-lg-4 col-md-12 col-12">
			  <div class="col-box">
				<div class="col-box-shadow">
					<!-- Header / Board -->
				  <div class="col-md-12 kupon-board pro-fix" align="center">
					 <h3>BANNER PROMO</h3>
				  </div>

					<!-- Desc -->
				  <div class="col-md-12 kupon-desc">
					tingkatkan penjualan mu diawal tahun lebih hemat 50%
				  </div>

					<!-- Valid untill -->
				  <div class="col-md-12 mb-5">
					<div class="row kupon-valid">
					  <div class="kupon-image"><img src="{{asset('image/kupon/clock_green.png')}}"/></div>
					  <div class="kupon-exp">Berlaku Hingga<br/><span class="opb">1- 5 Januari 2020</span></div>
					  <div class="clearfix"></div>
					</div>
					<div class="row kupon-valid">
					  <div class="kupon-image"><img src="{{asset('image/kupon/kupon_green.png')}}"/></div>
					  <div class="kupon-exp">Kode Promo<br/> <span class="opb kupon-kode">makinlaris20</span></div>
					  <div class="kupon-paste"><a  class="btn btn-kupon-copy btn-sm">Salin Kode</a></div>
					  <div class="clearfix"></div>
					</div>
				  </div>
				  
					<!-- Button -->
				   <div class="col-md-12 mb-4 pb-3">
					  <a class="btn btn-block btn-kupon"> Lihat Detail</a>
				  </div>
			
				</div>
			  </div>
			</div> 
			
			<!--- COUPON 5 --->
			<div class="col-lg-4 col-md-12 col-12">
			  <div class="col-box">
				<div class="col-box-shadow">
					<!-- Header / Board -->
				  <div class="col-md-12 kupon-board pro-fix" align="center">
					 <h3>BANNER PROMO</h3>
				  </div>

					<!-- Desc -->
				  <div class="col-md-12 kupon-desc">
					tingkatkan penjualan mu diawal tahun lebih hemat 50%
				  </div>

					<!-- Valid untill -->
				  <div class="col-md-12 mb-5">
					<div class="row kupon-valid">
					  <div class="kupon-image"><img src="{{asset('image/kupon/clock_green.png')}}"/></div>
					  <div class="kupon-exp">Berlaku Hingga<br/>
							<div class="kupon-timer">
								12 : 40 : 29
							</div>
					  </div>
					</div>
					<div class="row kupon-valid">
					  <div class="kupon-image"><img src="{{asset('image/kupon/kupon_green.png')}}"/></div>
					  <div class="kupon-exp">Kode Promo<br/> <span class="opb kupon-kode">makinlaris20</span></div>
					  <div class="kupon-paste"><a  class="btn btn-kupon-copy btn-sm">Salin Kode</a></div>
					</div>
				  </div>
				  
					<!-- Button -->
				   <div class="col-md-12 mb-4 pb-3">
					  <a class="btn btn-block btn-kupon"> Lihat Detail</a>
				  </div>
			
				</div>
			  </div>
			</div> 
			
			<!--- COUPON 6 --->
			<div class="col-lg-4 col-md-12 col-12">
			  <div class="col-box">
				<div class="col-box-shadow">
					<!-- Header / Board -->
				  <div class="col-md-12 kupon-board pro-fix" align="center">
					 <h3>BANNER PROMO</h3>
				  </div>

					<!-- Desc -->
				  <div class="col-md-12 kupon-desc">
					tingkatkan penjualan mu diawal tahun lebih hemat 50%
				  </div>

					<!-- Valid untill -->
				  <div class="col-md-12 mb-5">
					<div class="row kupon-valid">
					  <div class="kupon-image"><img src="{{asset('image/kupon/clock_grey.png')}}"/></div>
					  <div class="kupon-exp">Berlaku Hingga<br/><span class="opb">1- 5 Januari 2020</span></div>
					</div>
					<div class="row kupon-valid">
					  <div class="kupon-image"><img src="{{asset('image/kupon/kupon_grey.png')}}"/></div>
					  <div class="kupon-exp">Kode Promo<br/> <span class="opb kupon-kode">makinlaris20</span></div>
					  <div class="kupon-paste"><a  class="btn btn-kupon-copy btn-sm">Salin Kode</a></div>
					</div>
				  </div>
				  
					<!-- Button -->
				   <div class="col-md-12 mb-4 pb-3">
					  <a class="btn btn-block btn-kupon"> Lihat Detail</a>
				  </div>
			
				</div>
			  </div>
			</div> 
	
	<!-- END ROW -->
	</div>
  </div>
  <!-- END COUPON -->

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