<script>
  $(document).ready(function() {
    $('.tooltipstered').tooltipster({
      contentAsHTML: true,
      trigger: 'ontouchstart' in window || navigator.maxTouchPoints ? 'click' : 'hover',
    });
  });
</script>

<style>
  .tooltipstered > a {
    color: #505050;
  }  
  .big-icon {
    color: #BFBFBF;
    font-size: 55px;
    display: inline-block;
  }
</style>

@if($page->count())
   			<!--banner-->
        @if($banners->count())
        	<div class="col-md-12">
            <hr class="">
          </div>

          <span>BANNER</span><br>

        	@foreach($banners as $banner)
          	<div class="row mb-1">
            	<div class="col-lg-6 col-md-5 col-6">
                <span class="tooltipstered" title="Click To View Details">
                  <a class="single-report" href="{{url('dash-detail/'.$page->id.'/'.$banner->id.'/banner/'.$bulan.'/'.$tahun)}}" data-url="{{url('dash-detail/'.$page->id.'/'.$banner->id.'/banner/'.$bulan.'/'.$tahun)}}">
                    <i class="fab fa-font-awesome-flag"></i>
                    <span> {{$banner->title}}</span>
                  </a>
                </span>
              </div>

	            <div class="col-md-2 col-4 text-md-center text-right">
	              <div class="bd-highlight">
	                <span>
	                  {{$arr[$banner->title]}} clicks
	                </span>
	              </div>
	            </div>

	            <div class="col-lg-3 col-md-4 menu-nomobile">
	              <div class="bd-highlight menu-nomobile text-right">
	                <input type="text" name="" value="{{$banner->link}}" readonly="" style="margin-bottom: 2px;">
	              </div>       
	            </div> 

	            <div class="col-md-1 col-2">
	            	<button class="btn btn-sm btn-danger btn-delete-link" data-id="{{$banner->id}}" data-title="{{$banner->title}}" data-mode="banner">
	                <i class="fas fa-trash-alt"></i>
	              </button>
		          </div> 
          	</div>
          @endforeach
        @endif
        
        <!--Mesengers-->
        <div class="col-md-12">
          <hr class="">
        </div>

        <span>MESSENGERS</span><br>

        <div class="row mb-1">
   				@if($page->wa_pixel_id!=0 and !is_null($page->wa_pixel_id))
          	<div class="col-lg-6 col-md-5 col-6">
              <span class="tooltipstered" title="Click To View Details">
                <a class="single-report" href="{{url('dash-detail/'.$page->id.'/0/wa/'.$bulan.'/'.$tahun)}}" data-url="{{url('dash-detail/'.$page->id.'/0/wa/'.$bulan.'/'.$tahun)}}">
                  <i class='fab fa-whatsapp'></i>
                  <span> Whatsapp</span>
                </a>
              </span>
            </div>

            <div class="col-md-2 col-4 text-md-center text-right">
            	<div class="bd-highlight">
            		<span>
                  {{$arr['wa']}} clicks
                </span>
            	</div>
            </div>

            <div class="col-lg-3 col-md-4 menu-nomobile">
            	<div class="bd-highlight text-right">
            		<input type="text" name="" value="{{$page->wa_link}}" readonly="" style="margin-bottom: 2px;">
            	</div>
            </div>

            <div class="col-md-1 col-2 mb-1">
		          <button class="btn btn-sm btn-danger btn-delete-link" data-id="{{$page->id}}" data-title="WhatsApp" data-mode="wa"> 
	              <i class="fas fa-trash-alt"></i>
	            </button>
		        </div> 
          @endif

          @if($page->telegram_pixel_id!=0 and !is_null($page->telegram_pixel_id))
          	<div class="col-lg-6 col-md-5 col-6">
              <span class="tooltipstered" title="Click To View Details">
                <a class="single-report" href="{{url('dash-detail/'.$page->id.'/0/telegram/'.$bulan.'/'.$tahun)}}" data-url="{{url('dash-detail/'.$page->id.'/0/telegram/'.$bulan.'/'.$tahun)}}">
                  <i class='fab fa-telegram'></i>
                  <span> Telegram</span>
                </a>
              </span>
            </div>

            <div class="col-md-2 col-4 text-md-center text-right">
            	<div class="bd-highlight">
            		<span>
                  {{$arr['telegram']}} clicks
                </span>
            	</div>
            </div>

            <div class="col-lg-3 col-md-4 menu-nomobile">
            	<div class="bd-highlight text-right">
            		<input type="text" name="" value="{{$page->telegram_link}}" readonly="" style="margin-bottom: 2px;">
            	</div>
            </div>

            <div class="col-md-1 col-2 mb-1">
		          <button class="btn btn-sm btn-danger btn-delete-link" data-id="{{$page->id}}" data-title="Telegram" data-mode="telegram">  
	              <i class="fas fa-trash-alt"></i>
	            </button>
		        </div> 
          @endif

          @if($page->skype_pixel_id!=0 and !is_null($page->skype_pixel_id))
          	<div class="col-lg-6 col-md-5 col-6">
              <span class="tooltipstered" title="Click To View Details">
                <a class="single-report" href="{{url('dash-detail/'.$page->id.'/0/skype/'.$bulan.'/'.$tahun)}}" data-url="{{url('dash-detail/'.$page->id.'/0/skype/'.$bulan.'/'.$tahun)}}">
                  <i class='fab fa-skype'></i>
                  <span> Skype</span>
                </a>
              </span>
            </div>

            <div class="col-md-2 col-4 text-md-center text-right">
            	<div class="bd-highlight">
            		<span>
                  {{$arr['skype']}} clicks
                </span>
            	</div>
            </div>

            <div class="col-lg-3 col-md-4 menu-nomobile">
            	<div class="bd-highlight text-right">
            		<input type="text" name="" value="{{$page->skype_link}}" readonly="" style="margin-bottom: 2px;">
            	</div>
            </div>

            <div class="col-md-1 col-2 mb-1">
		          <button class="btn btn-sm btn-danger btn-delete-link" data-id="{{$page->id}}" data-title="Skype" data-mode="skype"> 
	              <i class="fas fa-trash-alt"></i>
	            </button>
		        </div> 
          @endif

          @if($page->line_pixel_id!=0 and !is_null($page->line_pixel_id))
          	<div class="col-lg-6 col-md-5 col-6">
              <span class="tooltipstered" title="Click To View Details">
                <a class="single-report" href="{{url('dash-detail/'.$page->id.'/0/line/'.$bulan.'/'.$tahun)}}" data-url="{{url('dash-detail/'.$page->id.'/0/line/'.$bulan.'/'.$tahun)}}">
                  <i class='fab fa-line'></i>
                  <span> Line</span>
                </a>
              </span>
            </div>

            <div class="col-md-2 col-4 text-md-center text-right">
            	<div class="bd-highlight">
            		<span>
                  {{$arr['line']}} clicks
                </span>
            	</div>
            </div>

            <div class="col-lg-3 col-md-4 menu-nomobile">
            	<div class="bd-highlight text-right">
            		<input type="text" name="" value="{{$page->line_link}}" readonly="" style="margin-bottom: 2px;">
            	</div>
            </div>

            <div class="col-md-1 col-2 mb-1">
		          <button class="btn btn-sm btn-danger btn-delete-link" data-id="{{$page->id}}" data-title="Line" data-mode="line"> 
	              <i class="fas fa-trash-alt"></i>
	            </button>
		        </div> 
          @endif

          @if($page->messenger_pixel_id!=0 and !is_null($page->messenger_pixel_id))
          	<div class="col-lg-6 col-md-5 col-6">
              <span class="tooltipstered" title="Click To View Details">
                <a class="single-report" href="{{url('dash-detail/'.$page->id.'/0/messenger/'.$bulan.'/'.$tahun)}}" data-url="{{url('dash-detail/'.$page->id.'/0/messenger/'.$bulan.'/'.$tahun)}}">
                  <i class="fab fa-facebook-messenger"></i>
                  <span> Messenger</span>
                </a>
              </span>
            </div>

            <div class="col-md-2 col-4 text-md-center text-right">
            	<div class="bd-highlight">
            		<span>
                  {{$arr['messenger']}} clicks
                </span>
            	</div>
            </div>

            <div class="col-lg-3 col-md-4 menu-nomobile">
            	<div class="bd-highlight text-right">
            		<input type="text" name="" value="{{$page->messenger_link}}" readonly="" style="margin-bottom: 2px;">
            	</div>
            </div>

            <div class="col-md-1 col-2 mb-1">
		          <button class="btn btn-sm btn-danger btn-delete-link" data-id="{{$page->id}}" data-title="Messenger" data-mode="messenger"> 
	              <i class="fas fa-trash-alt"></i>
	            </button>
		        </div> 
          @endif
        </div>

        <!--Links-->
        @if($links->count())
        	<div class="col-md-12">
		      	<hr class="">
		      </div>

		      <span>LINKS</span><br>

        	@foreach($links as $link)
		        <div class="row mb-1">
		          <div class="col-lg-6 col-md-5 col-6">
		            <span class="tooltipstered" title="Click To View Details">
		              <a class="single-report" href="{{url('dash-detail/'.$page->id.'/'.$link->id.'/link/'.$bulan.'/'.$tahun)}}" data-url="{{url('dash-detail/'.$page->id.'/'.$link->id.'/link/'.$bulan.'/'.$tahun)}}">
		                <i class="fas fa-link"></i>
		                <span>{{$link->title}}</span>
		              </a>
		            </span>
		          </div>

		          <div class="col-md-2 col-4 text-md-center text-right">
		            <div class="bd-highlight">
		              <span>
		                {{$arr[$link->title]}} clicks
		              </span>
		            </div>
		          </div>

		          <div class="col-lg-3 col-md-4 menu-nomobile">
		            <div class="bd-highlight text-right">
		              <input type="text" name="" value="{{$link->link}}" readonly="" style="margin-bottom: 2px;">
		            </div>       
		          </div>

		          <div class="col-md-1 col-2">
		          	<button class="btn btn-sm btn-danger btn-delete-link" data-id="{{$link->id}}" data-title="{{$link->title}}" data-mode="link"> 
	                <i class="fas fa-trash-alt"></i>
	              </button>
		          </div> 
		        </div>
		       @endforeach
        @endif

        <!--Social Media-->
        <div class="col-md-12">
          <hr class="">
        </div>

        <span>SOCIAL MEDIA</span><br>

        <div class="row" style="margin-bottom: 40px;">
        	@if($page->fb_pixel_id!=0 && !is_null($page->fb_pixel_id))
        		<div class="col-lg-6 col-md-5 col-6">
        			<span class="tooltipstered" title="Click To View Details">
                <a class="single-report" href="{{url('dash-detail/'.$page->id.'/0/fb/'.$bulan.'/'.$tahun)}}" data-url="{{url('dash-detail/'.$page->id.'/0/fb/'.$bulan.'/'.$tahun)}}">
                  <i class="fab fa-facebook-square"></i>
                  <span> Facebook</span>
                </a>
              </span>
        		</div>

        		<div class="col-md-2 col-4 text-md-center text-right">
            	<div class="bd-highlight">
            		<span>
                  {{$arr['fb']}} clicks
                </span>
            	</div>
            </div>

            <div class="col-lg-3 col-md-4 menu-nomobile">
            	<div class="bd-highlight text-right">
            		<input type="text" name="" value="{{$page->fb_link}}" readonly="" style="margin-bottom: 2px;">
            	</div>
            </div>

            <div class="col-md-1 col-2 mb-1">
            	<button class="btn btn-sm btn-danger btn-delete-link" data-id="{{$page->id}}" data-title="Facebook" data-mode="fb"> 
                <i class="fas fa-trash-alt"></i>
              </button>
           	</div>
        	@endif

        	@if($page->ig_pixel_id!=0 && !is_null($page->ig_pixel_id))
        		<div class="col-lg-6 col-md-5 col-6">
              <span class="tooltipstered" title="Click To View Details">
                <a class="single-report" href="{{url('dash-detail/'.$page->id.'/0/ig/'.$bulan.'/'.$tahun)}}" data-url="{{url('dash-detail/'.$page->id.'/0/ig/'.$bulan.'/'.$tahun)}}">
                  <i class='fab fa-instagram'></i>
                  <span> Instagram</span>
                </a>
              </span>
            </div>

            <div class="col-md-2 col-4 text-md-center text-right">
            	<div class="bd-highlight">
            		<span>
                  {{$arr['ig']}} clicks
                </span>
            	</div>
            </div>

            <div class="col-lg-3 col-md-4 menu-nomobile">
            	<div class="bd-highlight text-right">
            		<input type="text" name="" value="{{$page->ig_link}}" readonly="" style="margin-bottom: 2px;">
            	</div>
            </div>

            <div class="col-md-1 col-2 mb-1">
            	<button class="btn btn-sm btn-danger btn-delete-link" data-id="{{$page->id}}" data-title="Instagram" data-mode="ig">  
                <i class="fas fa-trash-alt"></i>
              </button>
           	</div>
          @endif

					@if($page->twitter_pixel_id!=0 && !is_null($page->twitter_pixel_id))          
						<div class="col-lg-6 col-md-5 col-6">
							<span class="tooltipstered" title="Click To View Details">
                <a class="single-report" href="{{url('dash-detail/'.$page->id.'/0/twitter/'.$bulan.'/'.$tahun)}}" data-url="{{url('dash-detail/'.$page->id.'/0/twitter/'.$bulan.'/'.$tahun)}}">
                  <i class='fab fa-twitter'></i>
                  <span> Twitter</span>
                </a>
              </span>
            </div>

            <div class="col-md-2 col-4 text-md-center text-right">
            	<div class="bd-highlight">
            		<span>
                  {{$arr['twitter']}} clicks
                </span>
            	</div>
            </div>

            <div class="col-lg-3 col-md-4 menu-nomobile">
            	<div class="bd-highlight text-right">
            		<input type="text" name="" value="{{$page->twitter_link}}" readonly="" style="margin-bottom: 2px;">
            	</div>
            </div>

						<div class="col-md-1 col-2 mb-1">
            	<button class="btn btn-sm btn-danger btn-delete-link" data-id="{{$page->id}}" data-title="Twitter" data-mode="twitter"> 
                <i class="fas fa-trash-alt"></i>
              </button>
           	</div>            
					@endif

					@if($page->youtube_pixel_id!=0 && !is_null($page->youtube_pixel_id))
						<div class="col-lg-6 col-md-5 col-6">
              <span class="tooltipstered" title="Click To View Details">
                <a class="single-report" href="{{url('dash-detail/'.$page->id.'/0/youtube/'.$bulan.'/'.$tahun)}}" data-url="{{url('dash-detail/'.$page->id.'/0/youtube/'.$bulan.'/'.$tahun)}}">
                  <i class='fab fa-youtube'></i>
                  <span> Youtube</span><br>
                </a>
              </span>
            </div>

            <div class="col-md-2 col-4 text-md-center text-right">
            	<div class="bd-highlight">
            		<span>
                  {{$arr['youtube']}} clicks
                </span>
            	</div>
            </div>

            <div class="col-lg-3 col-md-4 menu-nomobile">
            	<div class="bd-highlight text-right">
            		<input type="text" name="" value="{{$page->youtube_link}}" readonly="" style="margin-bottom: 2px;">
            	</div>
            </div>

            <div class="col-md-1 col-2 mb-1">
            	<button class="btn btn-sm btn-danger btn-delete-link" data-id="{{$page->id}}" data-title="Youtube" data-mode="youtube"> 
                <i class="fas fa-trash-alt"></i>
              </button>
           	</div>
          @endif 
        </div>
@endif