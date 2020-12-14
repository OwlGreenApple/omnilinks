<!--- activproof phone-preview -->

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

          <div class="proof_comments_preview">{{ $row->text }}</div>
          <small><i class="fas fa-check"></i> Activproof</small>
      </div>
  </div>
  @endforeach
</div>
@endif

<script type="text/javascript">

$(function(){
  /*$('.proof-box-preview > .proof-wrapper-preview:gt(1)').css({position:'absolute','top':0,'left':0});
  $('.proof-box-preview > .proof-wrapper-preview:gt(0)').hide();
  setTimeout(function(){runningProof();},5000);*/
  runningProof();
});

/* run animation display */
 function runningProof()
{
  var total = $(".proof-wrapper-preview").length;
  var counting = 0;
  var delay = 1000;
  var timing = 5000;

  var run = setInterval(
    function(){
      $('.proof-box-preview').css({'width':'260px','height':'99.8px'}); //make animation stable
      animateProof(counting);
      counting++;

      //put php logic according on setting
      <?php 
        if($pages->proof_settings == 0):
      ?>
          if(counting == total)
          {
              $('.proof-wrapper-preview').hide();
              clearInterval(run);  
              $('.proof-box-preview').css({'height':'auto'})            
          }
      <?php
        endif;
      ?>

      if(counting == total)
      {
         counting = 0;    
      }

    }, 
  timing);
}

function animateProof(interval)
{
    $('.proof-wrapper-preview').eq(interval).css({ 'display' : 'inline-flex'}).animate({
        top : 0,
    }, 350, function(){
      $(this).delay(4000).fadeOut(function(){
        $(this).css({'top' : '50px'});
      });
    });
}
</script>