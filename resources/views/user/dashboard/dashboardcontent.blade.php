<?php 
    use App\Link;
    use App\Banner;
 ?>
@if(!$pages->count())
  <div class="card noshow">
    <div class="card-body">
      <h1 class="textdash">
        Buat Omnilinkz pertama Anda<br>Pilih <span style="color:#106BC8;">"BIO LINK"</span> atau <span style="color:#106BC8;">"SINGLE LINK"
          </span>
        </h1>
    </div>
  </div>
@else
  @foreach($pages as $page)
    <div class="card carddash">
      <div class="card-body link-header" id="linkHeader" dataid="{{$page->id}}" style="cursor:pointer;">
        <div class="row">
          <div class="col-md-1">
            <div class="photo p-2 bd-highlight justify-content-center">
              <div class="imga">
                @if(is_null($page->image_pages))
                  <div class="picture-sm"></div>
                @else
                  <img src="<?php echo url(Storage::disk('local')->url('app/'.$page->image_pages)); ?>" class="imga" style="width: 70px;">
                @endif
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <a href="omn.lkz/{{$page->shorten}}" class="getLink">
              omn.lkz/{{$page->names}} 
              <input type="hidden" class="link-{{$page->id}}" value="omn.lkz/{{$page->names}}">
            </a>
            &nbsp;
            <span class="btn-copylink" data-id="{{$page->id}}" data-link="omn.lkz/{{$page->names}}">
              <i class="far fa-clone"></i>  
            </span>

            <br>

            <span>
              Title : {{$page->page_title}}
            </span>

            <br>

            <span>
              Pixels : 
                @if($page->wa_pixel_id!=0 and !is_null($page->wa_pixel_id))
                  <i class='fab fa-whatsapp'></i>&nbsp;
                @endif

                @if($page->ig_pixel_id!=0 and !is_null($page->ig_pixel_id))
                  <i class='fab fa-instagram'>&nbsp;</i>
                @endif

                @if($page->fb_pixel_id!=0 and !is_null($page->fb_pixel_id))
                  <i class='fab fa-facebook'>&nbsp;</i>
                @endif

                @if($page->twitter_pixel_id!=0 and !is_null($page->twitter_pixel_id))
                  <i class='fab fa-twitter-square'>&nbsp;</i>
                @endif

                @if($page->youtube_pixel_id!=0 and !is_null($page->youtube_pixel_id))
                  <i class='fab fa-youtube'>&nbsp;</i>
                @endif

                @if($page->telegram_pixel_id!=0 and !is_null($page->telegram_pixel_id))
                  <i class='fab fa-telegram'>&nbsp;</i>
                @endif

                @if($page->skype_pixel_id!=0 and !is_null($page->skype_pixel_id))
                  <i class='fab fa-skype'></i>
                @endif
            </span>

            <p>
              Created On : {{date("F d,Y", strtotime($page->created_at))}}
            </p>

          </div>

          <div class="col-md-2">
            <div class="p-4 bd-highlight" align="center">
              {{$page->total_counter}}<br>
              clicks
            </div>
          </div>

          <div class="col-md-3">
            <div class="p-4 bd-highlight">
              <div class="buton">
                <button type="button" deletedataid="{{$page->id}}" class="btn btn-sm btn-danger float-right btn-deletePage">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </div>

              <button class="btn btn-sm btn-success float-right btn-editPage" data-id="{{$page->uid}}" style="margin-right:5px;">
                <i class="fas fa-pencil-alt"></i>
              </button>

              <button type="button" class="btn btn-sm btn-primary btn-pdf float-right" style="margin-right: 5px;">
                <i class="far fa-file-pdf"></i>
                Saved AS PDF
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="card-body content-link hidden" style="display: none;">
        <!--banner-->
        <?php 
          $banners=Banner::where('users_id',Auth::user()->id)
                    ->where('pages_id',$page->id)
                    ->get(); 
        ?>

        @if($banners->count())
          <div class="row">
            <div class="col-md-12">
              <hr class="">
            </div>

           
              <div class="col-md-7">
                <span>Banner</span><br>
                 @foreach($banners as $banner)
                <i class="fab fa-font-awesome-flag"></i>
                <span> {{$banner->title}}</span><br>
                @endforeach
                <br>
              </div>

              <div class="col-md-2">
                <div class="p-4 bd-highlight">
                   @foreach($banners as $banner)
                  <span>clicks</span><br>
                  @endforeach
                </div>
              </div>

              <div class="col-md-3">
                <div class="p-4 bd-highlight float-right">
                  @foreach($banners as $banner)
                  <input type="text" name="" value="{{$banner->link}}" readonly="" style="margin-bottom: 2px;"><br>
                  @endforeach
                </div>       
              </div> 
             
          </div>
        @endif

        <!--Mesengers-->
        <div class="row">
          <div class="col-md-12">
            <hr class="">
          </div>

          <div class="col-md-7">
            <span>MESSENGERS</span><br>
            @if($page->wa_pixel_id!=0 and !is_null($page->wa_pixel_id))
              <i class='fab fa-whatsapp'></i>
              <span> Whatsapp</span><br>
            @endif
            @if($page->telegram_pixel_id!=0 && !is_null($page->telegram_pixel_id))
              <i class='fab fa-telegram'></i>
              <span> Telegram</span><br>
            @endif
            @if($page->skype_pixel_id!=0 && !is_null($page->skype_pixel_id))
              <i class='fab fa-skype'></i>
              <span> Skype</span><br>
            @endif
          </div>

          <div class="col-md-2">
            <div class="p-4 bd-highlight">
              @if($page->wa_pixel_id!=0 &&  !is_null($page->wa_pixel_id))
              <span>clicks wa</span><br>
              @endif
             @if($page->telegram_pixel_id!=0 && !is_null($page->telegram_pixel_id))
                <span>Click telgram</span><br>
              @endif

              @if($page->skype_pixel_id!=0 && !is_null($page->skype_pixel_id))
              <span>Click Skype</span><br>
              @endif              
            </div>
          </div>

          <div class="col-md-3">
            <div class="p-4 bd-highlight float-right">
              @if($page->wa_pixel_id!=0 &&  !is_null($page->wa_pixel_id))
                <input type="text" name="" value="{{$page->wa_link}}" readonly="" style="margin-bottom: 2px;"><br>
              @endif

              @if($page->telegram_pixel_id!=0 && !is_null($page->telegram_pixel_id))
                <input type="text" name="" value="{{$page->telegram_link}}" readonly="" style="margin-bottom: 2px;"><br>
              @endif

              @if($page->skype_pixel_id!=0 && !is_null($page->skype_pixel_id))
                <input type="text" name="" value="{{$page->skype_link}}" readonly="" style="margin-bottom: 2px;"><br>
              @endif
            </div>
          </div>
        </div>

        <!--Links-->
        <?php
          $links=Link::where('users_id',Auth::user()->id)
                  ->where('pages_id',$page->id)
                  ->get();
        ?>
        
        @if($links->count())
          <div class="row">
            <div class="col-md-12">
              <hr class="">
            </div>
            
              <div class="col-md-7">
                <span>Links</span><br>
                @foreach($links as $link)
                <i class="fas fa-link"></i>
                <span>
                  {{$link->title}}
                </span>
                <br>
                @endforeach
              </div>

              <div class="col-md-2">
                <div class="p-4 bd-highlight">
                  @foreach($links as $link)
                  <span>clicks</span><br>
                  @endforeach
                </div>
              </div>
                  
              <div class="col-md-3">
                <div class="p-4 bd-highlight float-right">
                  @foreach($links as $link)
                  <input type="text" name="" value="{{$link->link}}" readonly="" style="margin-bottom: 2px;"><br>
                  @endforeach 
                </div>       
              </div> 
            
          </div>
        @endif

        <!--Social Media-->
        <div class="row">
          <div class="col-md-12">
            <hr class="">
          </div>
          <div class="col-md-7">
            <span>Social-Media</span><br>

            @if($page->fb_pixel_id!=0 && !is_null($page->fb_pixel_id))
              <i class='fab fa-facebook-f'></i>
              <span> Facebook</span><br>
            @endif

            @if($page->ig_pixel_id!=0 && !is_null($page->ig_pixel_id))
              <i class='fab fa-instagram'></i>
              <span> Instagram</span><br>
            @endif

            @if($page->twitter_pixel_id!=0 && !is_null($page->twitter_pixel_id))
              <i class='fab fa-twitter'></i>
              <span> Twitter</span><br>
            @endif

            @if($page->youtube_pixel_id!=0 && !is_null($page->youtube_pixel_id))
              <i class='fab fa-youtube'></i>
              <span> Youtube</span><br>
            @endif
          </div>

          <div class="col-md-2">
            <div class="p-4 bd-highlight">
              @if($page->fb_pixel_id!=0 && !is_null($page->fb_pixel_id))
              <span>clicks Fb</span><br>
              @endif
              @if($page->ig_pixel_id!=0 && !is_null($page->ig_pixel_id))
               <span>clicks ig</span><br>
               @endif
               @if($page->twitter_pixel_id!=0 && !is_null($page->twitter_pixel_id))
                <span>clicks twit</span><br>
                @endif
                @if($page->youtube_pixel_id!=0 && !is_null($page->youtube_pixel_id))
                 <span>clicks yt</span><br>
                 @endif
            </div>
          </div>

          <div class="col-md-3">
            <div class="p-4 bd-highlight float-right">
              @if($page->fb_pixel_id!=0 && !is_null($page->fb_pixel_id))
                <input type="text" name="" value="{{$page->fb_link}}" readonly="" style="margin-bottom: 2px;"><br>
              @endif

              @if($page->ig_pixel_id!=0 && !is_null($page->ig_pixel_id))
                <input type="text" name="" value="{{$page->ig_link}}" readonly="" style="margin-bottom: 2px;"><br>
              @endif

              @if($page->twitter_pixel_id!=0 && !is_null($page->twitter_pixel_id))
                <input type="text" name="" value="{{$page->twitter_link}}" readonly="" style="margin-bottom: 2px;"><br>
              @endif

              @if($page->youtube_pixel_id!=0 && !is_null($page->youtube_pixel_id))
                <input type="text" name="" value="{{$page->youtube_link}}" readonly="" style="margin-bottom: 2px;"><br>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div> 
  @endforeach
@endif