@if($proof->count() > 0)
  <div class="proof-box-preview">
  @foreach($proof as $row)
  <div class="proof-wrapper-preview">
      <div class="proof_image"><img src="{!! Storage::disk('s3')->url($row->url_image) !!}"/></div>
   
      <div class="proof-desc">
          <div class="proof_profile">
            <div class="proof_name_preview">{{ $row->name }}</div>
            <div class="proof_star_preview">
              @for($x=1;$x<=$row->star;$x++)
                <i class="fa fa-star" aria-hidden="true"></i>
              @endfor
            </div>
          </div>

          <div class="proof_comments_preview">
           {{ $row->text }}
          </div>
      </div>
  </div>
  @endforeach
@endif

<script type="text/javascript">

$(function(){
  setTimeout(function(){runningProof();},5000)
});

/* run animation display */
  function runningProof()
  {
    var total = $(".proof-wrapper-preview").length;
    var counting = 0;
    var timer = 5000;

    $('.proof-box-preview > .proof-wrapper-preview:gt(0)').hide();
      var run = setInterval(
        function(){
          $('.proof-box-preview > :first-child').fadeOut().next('.proof-wrapper-preview').fadeIn().addClass('animate-buzz').end().appendTo('.proof-box-preview');
            counting++;

          //put php logic according on setting
          <?php 
            if($pages->proof_settings == 0):
          ?>
              if(counting == total)
              {
                  $('.proof-wrapper-preview').hide();
                  clearInterval(run);
              }
          <?php
            endif;
          ?>
        }, 
      timer);
  }
</script>