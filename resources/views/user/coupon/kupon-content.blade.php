<!--- COUPON --->
      @if(count($catalogs) > 0)
         @foreach($catalogs as $index=>$rows)
            <div class="col-lg-4 col-md-12 col-12">
              <div class="col-box">
              <div class="col-box-shadow">
                <!-- Header / Board -->
                <div class="col-md-12 kupon-board pro-fix" align="center">
                 <!--<h3>BANNER PROMO</h3>-->
                 <img src="{!! Storage::disk('s3')->url($rows['path']) !!}"/>
                </div>

                <!-- Desc -->
                <div class="col-md-12 kupon-desc">
                  {{$rows['desc']}}
                </div>

                <!-- Valid untill -->
                <div class="col-md-12 mb-5">
                <div class="row kupon-valid">
                  <div class="kupon-image"><img src="{{asset('image/kupon/clock_green.png')}}"/></div>
                  <div class="kupon-exp">Berlaku Hingga<br/>
                    <div id="timer-{{$index}}" class="kupon-timer">
                      {{$rows['valid_until']}}
                    </div>
                  </div>
                </div>
                <div class="row kupon-valid">
                  <div class="kupon-image"><img src="{{asset('image/kupon/kupon_green.png')}}"/></div>
                  <div class="kupon-exp">Kode Kupon<br/> <span class="opb kupon-kode">{{$rows['kodekupon']}}</span></div>
                  <div class="kupon-paste"><a data-link="{{$rows['kodekupon']}}" class="btn btn-kupon-copy btn-sm btn-copy">Salin Kode</a></div>
                </div>
                </div>
                
                <!-- Button -->
                 <div class="col-md-12 mb-4 pb-3">
                  @if($rows['type'] == 'other')
                    <a href="{{$rows['coupon_url']}}" class="btn btn-block btn-kupon">Gunakan Kupon</a>
                  @else
                    <a href="{{url('checkout')}}/{{$rows['kodekupon']}}" class="btn btn-block btn-kupon">Gunakan Kupon</a>
                  @endif
                </div>
            
              </div>
              </div>
            </div> 
         @endforeach
	   @else
		   <div class="alert alert-warning">Maaf, kode kupon tidak ada atau tidak terdaftar</div>
      @endif

  <!-- Modal Copy Link -->
  <div class="modal fade" id="copy-link" role="dialog">
    <div class="modal-dialog">
      
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modaltitle">
            Copy Link
          </h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          Copy link berhasil!
        </div>
        <div class="modal-footer" id="foot">
          <button class="btn btn-primary" data-dismiss="modal">
            OK
          </button>
        </div>
      </div>
        
    </div>
  </div>
	
			<!--- COUPON 1 
			<div class="col-lg-4 col-md-12 col-12">
			  <div class="col-box">
				<div class="col-box-shadow">
					<!-- Header / Board 
				  <div class="col-md-12 kupon-board pro-fix" align="center">
					 <h3>BANNER PROMO</h3>
				  </div>

					<!-- Desc 
				  <div class="col-md-12 kupon-desc">
					tingkatkan penjualan mu diawal tahun lebih hemat 50%
				  </div>

					<!-- Valid untill 
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
				  
					<!-- Button 
				   <div class="col-md-12 mb-4 pb-3">
					  <a class="btn btn-block btn-kupon"> Lihat Detail</a>
				  </div>
			
				</div>
			  </div>
			</div> -->
			
			<!--- COUPON 3 
			<div class="col-lg-4 col-md-12 col-12">
			  <div class="col-box">
				<div class="col-box-shadow">
					<!-- Header / Board
				  <div class="col-md-12 kupon-board pro-fix" align="center">
					 <h3>BANNER PROMO</h3>
				  </div>

					<!-- Desc 
				  <div class="col-md-12 kupon-desc">
					tingkatkan penjualan mu diawal tahun lebih hemat 50%
				  </div>

					<!-- Valid untill 
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
				  
					<!-- Button 
				   <div class="col-md-12 mb-4 pb-3">
					  <a class="btn btn-block btn-kupon"> Lihat Detail</a>
				  </div>
			
				</div>
			  </div>
			</div> -->
      
 <!-- jquery countdown timer -->
<script type="text/javascript">
  $(function(){
    var len = $(".kupon-timer").length;
    var x = 0;

    for(x=0;x<len;x++)
    {
      var time = $("#timer-"+x).text().split(':');
      var hour = parseInt(time[0],10);
      var min = parseInt(time[1],10);
      var sec = parseInt(time[2],10);
     
      $("#timer-"+x).countdowntimer({
          hours : hour,
          minutes :min,
          seconds : sec,
          size : "sm"
      }); 
    }
  });

  $(function(){
      $( "body" ).on( "click", ".btn-copy", function(e) 
      {
        e.preventDefault();
        e.stopPropagation();

        //var id = $(this).attr("data-id");
        var link = $(this).attr("data-link");

        var tempInput = document.createElement("input");
        tempInput.style = "position: absolute; left: -1000px; top: -1000px";
        tempInput.value = link;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        $('#copy-link').modal('show');
      });
  });

</script>