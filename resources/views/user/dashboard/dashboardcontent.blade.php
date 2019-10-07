<?php 
  use App\Link;
  use App\Banner;
  use App\Pixel;
  use App\Http\Controllers\DashboardController;
?>

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

@if(!$pages->count() and $search==false)
  <div class="card noshow">
    <div class="card-body text-center">
      <span class="big-icon"><i class="fas fa-link"></i></span>
      <br>
      <span class="textdash">
        Buat Omnilinkz pertama Anda<br>Pilih 
        <a href="" class="btncreate-bio" style="color:#106BC8;">
          "BIO LINK"
        </a> 
        @if(Auth::user()->membership!='free')
          atau 
          <a href="{{url('dash/newsingle')}}" style="color:#106BC8;">
            "SINGLE LINK"
          </a>
        @endif
      </span>
    </div>
  </div>
@elseif(!$pages->count() and $search==true)
  <div class="card noshow">
    <div class="card-body text-center">
      <span class="big-icon">
        <i class="fas fa-search"></i>
      </span>
      <br>
      <div class="textdash" style="margin-top: 30px;">
        Data tidak ditemukan.
      </div>
      <span style="font-size: 17px;">
        Hasil pencarian tidak ditemukan. Coba keyword lain?
      </span>
    </div>
  </div>
@else 
  @foreach($pages as $page)
    <?php
    $links = Link::where('users_id',Auth::user()->id)
              ->where('pages_id',$page->id)
              ->get();

    $banners = Banner::where('users_id',Auth::user()->id)
                ->where('pages_id',$page->id)
                ->get();

    $pixels = Pixel::where('users_id',Auth::user()->id)
                ->select('jenis_pixel')
                //->where('pages_id',$page->id)
                ->groupBy('jenis_pixel')
                ->get();

    $dashcont = new DashboardController;

    $arr = $dashcont->counter_click_month($page,$banners,$links,$bulan,$tahun);

    ?>

    <div class="card carddash">
      <div class="card-body link-header" id="linkHeader" dataid="{{$page->id}}" style="cursor:pointer;">
        <div class="row">
          <div class="col-lg-1 col-md-2 menu-nomobile">
            <div class="photo p-2 bd-highlight justify-content-center">
              <div class="imga">
                @if(is_null($page->image_pages))
                  <div class="picture-sm"></div>
                @else
                  <img src="<?php 
                    echo Storage::disk('s3')->url($page->image_pages);
                  ?>" class="imga img-{{$page->id}}" style="width: 70px;">
                @endif
              </div>
            </div>
          </div>

          <div class="col-7 col-md-4 col-lg-6">
            <?php 
                $names = '';
                if($page->premium_id!=0){
                  $names = env('SHORT_LINK').'/'.$page->premium_names;
                } else {
                  $names = env('SHORT_LINK').'/'.$page->names;
                }
            ?>

            <a href="{{'https://'.$names}}" class="getLink">
              {{$names}}
              <!--{{env('SHORT_LINK')}}/{{$page->names}} -->
              <span class="menu-mobile float-right">
                <i class="fas fa-sort-down"></i>
              </span>
              <input type="hidden" class="link-{{$page->id}}" value="{{$names}}">
            </a>
            &nbsp;
            <span class="btn-copylink menu-nomobile" data-id="{{$page->id}}" data-link="{{'https://'.$names}}">
              <i class="far fa-clone"></i>  
            </span>

            <br>

            <span>
              <span class="menu-nomobile">Title : </span>
              @if($page->page_title==null)
                -
              @else 
                {{$page->page_title}}
              @endif
            </span>

            <br>

            <span class="menu-nomobile">
              @if(Auth::user()->membership!='free')
                Pixels : 
                @if($pixels->count())
                  @foreach($pixels as $pixel)
                    @if($pixel->jenis_pixel=='fb')
                      <i class="fab fa-facebook-f">&nbsp;</i>
                    @endif

                    @if($pixel->jenis_pixel=='twitter')
                      <i class='fab fa-twitter'>&nbsp;</i>
                    @endif

                    @if($pixel->jenis_pixel=='google')
                      <i class="fab fa-google">&nbsp;</i>
                    @endif
                  @endforeach
                @endif
              @endif
            </span>

            <p class="menu-nomobile">
              Created On : {{date("F d,Y", strtotime($page->created_at))}}
            </p>

          </div>

          <div class="col-md-2 menu-nomobile">
            <div class="bd-highlight" align="center">
              <span class="click-page">
                {{array_sum($arr)}}
              </span><br>
              clicks
            </div>
          </div>

          <div class="col-5 col-lg-3 col-md-4">
            <div class="pt-md-4 pb-md-4 bd-highlight">

              <div class="buton">
                
                <button type="button" deletedataid="{{$page->id}}" data-title="
                {{$page->page_title}}" data-link="{{$names}}" data-created="
                {{date('F d, Y', strtotime($page->created_at))}}" class="btn btn-sm btn-danger float-right btn-deletePage">
                  <i class="fas fa-trash-alt"></i>
                  <span class="menu-nomobile" style="color:#fff">Delete</span>
                </button>
              </div>

              <button class="btn btn-sm btn-success float-right btn-editPage" data-id="{{$page->uid}}" style="margin-right:5px;">
                <i class="fas fa-pencil-alt"></i>
                <span class="menu-nomobile" style="color:#fff">Edit</span>
              </button>

              <button class="btn btn-sm btn-primary btn-viewall float-right" style="margin-right:5px;" data-id="{{$page->id}}/{{$bulan}}/{{$tahun}}">
                <i class="far fa-eye"></i>
                <span class="menu-nomobile" style="color:#fff">View</span>
              </button>

              <!--<a class="menu-nomobile" href="{{url('pdf/'.$page->id.'/biolinks/'.$bulan.'/'.$tahun)}}" >
                <button type="button" class="btn btn-sm btn-primary btn-pdf float-right" style="margin-right: 5px;" data-url="{{url('pdf/'.$page->id.'/biolinks/'.$bulan.'/'.$tahun)}}">
                  <i class="far fa-file-pdf"></i>
                  Saved AS PDF
                </button>
              </a>-->

            </div>
          </div>
        </div>
      </div>

      <div class="card-body content-link hidden" style="display: none;">
        <span class="menu-mobile">
          Total Click : <b>{{array_sum($arr)}} Clicks</b> <br>
          Created on : {{date("F d,Y", strtotime($page->created_at))}} <br>
        </span>

        <!--banner-->
        @if($banners->count())
          <div class="row">
            <div class="col-md-12">
              <hr class="">
            </div>
            <div class="col-md-12">
              <span>Banner</span>
            </div>

            @foreach($banners as $banner)
              <div class="col-lg-7 col-md-6 col-6">
                <span class="tooltipstered" title="Click To View Details">
                  <a class="single-report" href="{{url('dash-detail/'.$page->id.'/'.$banner->id.'/banner/'.$bulan.'/'.$tahun)}}" data-url="{{url('dash-detail/'.$page->id.'/'.$banner->id.'/banner/'.$bulan.'/'.$tahun)}}">
                    <i class="fab fa-font-awesome-flag"></i>
                    <span> {{$banner->title}}</span>
                  </a>
                </span>
              </div>
              <div class="col-md-2 col-6 text-md-center text-right">
                <div class=" bd-highlight">
                  <span>
                    {{$arr[$banner->title]}} clicks
                  </span>
                </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class=" bd-highlight menu-nomobile float-right">
                  <input type="text" name="" value="{{$banner->link}}" readonly="" style="margin-bottom: 2px;"><br>
                </div>       
              </div> 
            @endforeach
            
          </div>
        @endif

        <!--Mesengers-->
        <div class="row">
          <div class="col-md-12">
            <hr class="">
          </div>
          <div class="col-md-12">
            <span>MESSENGERS</span>
          </div>

          @if(!is_null($page->wa_link))
            <div class="col-lg-7 col-md-6 col-6">
              <div class="">
                <span class="tooltipstered" title="Click To View Details">
                  <a class="single-report" href="{{url('dash-detail/'.$page->id.'/0/wa/'.$bulan.'/'.$tahun)}}" data-url="{{url('dash-detail/'.$page->id.'/0/wa/'.$bulan.'/'.$tahun)}}">
                    <i class='fab fa-whatsapp'></i>
                    <span> Whatsapp</span>
                  </a>
                </span>
              </div>
            </div>
            <div class="col-6 col-md-2 col-lg-2 text-md-center text-right">
              <div class=" bd-highlight">
                <span>
                  {{$arr['wa']}} clicks
                </span>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 menu-nomobile">
              <div class=" bd-highlight float-right">
                <input type="text" name="" value="{{$page->wa_link}}" readonly="" style="margin-bottom: 2px;">
              </div>
            </div>
          @endif


          @if(!is_null($page->telegram_link))
            <div class="col-lg-7 col-md-6 col-6">
              <div class="">
                <span class="tooltipstered" title="Click To View Details">
                  <a class="single-report" href="{{url('dash-detail/'.$page->id.'/0/telegram/'.$bulan.'/'.$tahun)}}" data-url="{{url('dash-detail/'.$page->id.'/0/telegram/'.$bulan.'/'.$tahun)}}">
                    <i class='fab fa-telegram'></i>
                    <span> Telegram</span>
                  </a>
                </span>
              </div>
            </div>
            <div class="col-md-2 col-6 text-md-center text-right">
              <div class=" bd-highlight">
                <span>
                  {{$arr['telegram']}} clicks
                </span>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 menu-nomobile">
              <div class=" bd-highlight float-right">
                <input type="text" name="" value="{{$page->telegram_link}}" readonly="" style="margin-bottom: 2px;"><br>
              </div>
            </div>
          @endif

          @if(!is_null($page->skype_link))
            <div class="col-lg-7 col-md-6 col-6">
              <div class="">
                <span class="tooltipstered" title="Click To View Details">
                  <a class="single-report" href="{{url('dash-detail/'.$page->id.'/0/skype/'.$bulan.'/'.$tahun)}}" data-url="{{url('dash-detail/'.$page->id.'/0/skype/'.$bulan.'/'.$tahun)}}">
                    <i class='fab fa-skype'></i>
                    <span> Skype</span>
                  </a>
                </span>
              </div>
            </div>
            <div class="col-md-2 col-6 text-md-center text-right">
              <div class=" bd-highlight">
                <span>
                  {{$arr['skype']}} clicks
                </span>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 menu-nomobile">
              <div class=" bd-highlight float-right">
                <input type="text" name="" value="{{$page->skype_link}}" readonly="" style="margin-bottom: 2px;"><br>
              </div>
            </div>
          @endif

          @if(!is_null($page->line_link))
            <div class="col-lg-7 col-md-6 col-6">
              <div class="">
                <span class="tooltipstered" title="Click To View Details">
                  <a class="single-report" href="{{url('dash-detail/'.$page->id.'/0/line/'.$bulan.'/'.$tahun)}}" data-url="{{url('dash-detail/'.$page->id.'/0/line/'.$bulan.'/'.$tahun)}}">
                    <i class='fab fa-line'></i>
                    <span> Line</span>
                  </a>
                </span>
              </div>
            </div>
            <div class="col-md-2 col-6 text-md-center text-right">
              <div class=" bd-highlight">
                <span>
                  {{$arr['line']}} clicks
                </span>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 menu-nomobile">
              <div class="bd-highlight float-right">
                <input type="text" name="" value="{{$page->line_link}}" readonly="" style="margin-bottom: 2px;"><br>
              </div>
            </div>
          @endif

          @if(!is_null($page->messenger_link))
            <div class="col-lg-7 col-md-6 col-6">
              <div class="">
                <span class="tooltipstered" title="Click To View Details">
                  <a class="single-report" href="{{url('dash-detail/'.$page->id.'/0/messenger/'.$bulan.'/'.$tahun)}}" data-url="{{url('dash-detail/'.$page->id.'/0/messenger/'.$bulan.'/'.$tahun)}}">
                    <i class='fab fa-facebook-messenger'></i>
                    <span> Messenger</span>
                  </a>
                </span>
              </div>
            </div>
            <div class="col-md-2 col-6 text-md-center text-right">
              <div class=" bd-highlight">
                <span>
                  {{$arr['messenger']}} clicks
                </span>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 menu-nomobile">
              <div class=" bd-highlight float-right">
                <input type="text" name="" value="{{$page->messenger_link}}" readonly="" style="margin-bottom: 2px;"><br>
              </div>
            </div>
          @endif




        </div>

        <!--Links-->
        @if($links->count())
        <div class="row">
          <div class="col-md-12">
            <hr class="">
          </div>
          <div class="col-md-12">
            <span>Links</span>
          </div>

          @foreach($links as $link)
            <div class="col-lg-7 col-md-6 col-6">
              <span class="tooltipstered" title="Click To View Details">
                <a class="single-report" href="{{url('dash-detail/'.$page->id.'/'.$link->id.'/link/'.$bulan.'/'.$tahun)}}" data-url="{{url('dash-detail/'.$page->id.'/'.$link->id.'/link/'.$bulan.'/'.$tahun)}}">
                  <i class="fas fa-link"></i>
                  <span>{{$link->title}}</span>
                </a>
              </span>
            </div>
            <div class="col-md-2 col-6 text-md-center text-right">
              <div class="bd-highlight">
                <span>
                  {{$arr[$link->counter]}} clicks
                </span>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 menu-nomobile">
              <div class="bd-highlight float-right">
                <input type="text" name="" value="{{$link->link}}" readonly="" style="margin-bottom: 2px;"><br>
              </div>
            </div> 
          @endforeach

        </div>
        @endif

        <!--Social Media-->
        <div class="row">
          <div class="col-md-12">
            <hr class="">
          </div>
          <div class="col-md-12">
            <span>Social-Media</span>
          </div>
          
          
          @if(!is_null($page->fb_link))
            <div class="col-lg-7 col-md-6 col-6">
              <span class="tooltipstered" title="Click To View Details">
                <a class="single-report" href="{{url('dash-detail/'.$page->id.'/0/fb/'.$bulan.'/'.$tahun)}}" data-url="{{url('dash-detail/'.$page->id.'/0/fb/'.$bulan.'/'.$tahun)}}">
                  <i class="fab fa-facebook-square"></i>
                  <span> Facebook</span>
                </a>
              </span>
            </div>
            <div class="col-md-2 col-6 text-md-center text-right">
              <div class="bd-highlight">
                <span>
                  {{$arr['fb']}} clicks
                </span>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 menu-nomobile">
              <div class="bd-highlight float-right">
                  <input type="text" name="" value="https://facebook.com/{{$page->fb_link}}" readonly="" style="margin-bottom: 2px;"><br>
              </div>
            </div>
          @endif
        


          @if(!is_null($page->ig_link))
            <div class="col-lg-7 col-md-6 col-6">
              <span class="tooltipstered" title="Click To View Details">
                <a class="single-report" href="{{url('dash-detail/'.$page->id.'/0/ig/'.$bulan.'/'.$tahun)}}" data-url="{{url('dash-detail/'.$page->id.'/0/ig/'.$bulan.'/'.$tahun)}}">
                  <i class='fab fa-instagram'></i>
                  <span> Instagram</span>
                </a>
              </span>
            </div>
            <div class="col-md-2 col-6 text-md-center text-right">
              <div class="bd-highlight">
                <span>
                  {{$arr['ig']}} clicks
                </span>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 menu-nomobile">
              <div class="bd-highlight float-right">
                <input type="text" name="" value="https://instagram.com/{{$page->ig_link}}" readonly="" style="margin-bottom: 2px;"><br>
              </div>
            </div>
          @endif

          @if(!is_null($page->twitter_link))
            <div class="col-lg-7 col-md-6 col-6">
              <span class="tooltipstered" title="Click To View Details">
                <a class="single-report" href="{{url('dash-detail/'.$page->id.'/0/twitter/'.$bulan.'/'.$tahun)}}" data-url="{{url('dash-detail/'.$page->id.'/0/twitter/'.$bulan.'/'.$tahun)}}">
                  <i class='fab fa-twitter'></i>
                  <span> Twitter</span>
                </a>
              </span>
            </div>
            <div class="col-md-2 col-6 text-md-center text-right">
              <div class="bd-highlight">
                <span>
                  {{$arr['twitter']}} clicks
                </span>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 menu-nomobile">
              <div class="bd-highlight float-right">
                <input type="text" name="" value="https://twitter.com/{{$page->twitter_link}}" readonly="" style="margin-bottom: 2px;"><br>
              </div>
            </div>
          @endif

          @if(!is_null($page->youtube_link))
            <div class="col-lg-7 col-md-6 col-6">
              <span class="tooltipstered" title="Click To View Details">
                <a class="single-report" href="{{url('dash-detail/'.$page->id.'/0/youtube/'.$bulan.'/'.$tahun)}}" data-url="{{url('dash-detail/'.$page->id.'/0/youtube/'.$bulan.'/'.$tahun)}}">
                  <i class='fab fa-youtube'></i>
                  <span> Youtube</span><br>
                </a>
              </span>
            </div>
            <div class="col-md-2 col-6 text-md-center text-right">
              <div class="bd-highlight">
                <span>
                  {{$arr['youtube']}} clicks
                </span>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 menu-nomobile">
              <div class="bd-highlight float-right">
                <input type="text" name="" value="{{$page->youtube_link}}" readonly="" style="margin-bottom: 2px;"><br>
              </div>
            </div>
          @endif


        </div>
      </div>
    </div> 
  @endforeach
@endif
