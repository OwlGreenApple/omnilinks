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


/* if user switch another tab , the animation stop, but if return otherwise */
var run;
var vis = (function(){
  var stateKey, eventKey, keys = {
      hidden: "visibilitychange",
      webkitHidden: "webkitvisibilitychange",
      mozHidden: "mozvisibilitychange",
      msHidden: "msvisibilitychange"
  };
  for (stateKey in keys) {
      if (stateKey in document) {
          eventKey = keys[stateKey];
          break;
      }
  }
  return function(c) {
      if (c) document.addEventListener(eventKey, c);
      return !document[stateKey];
  }
})();
/****/

$(function(){
  runningProof();

  //call switch tab
  vis(function(){
     // document.title = vis() ? 'Visible' : 'Not visible';
     if(vis()){
      <?php 
        if($pages->proof_settings !== 0):
      ?>
        runningProof();
      <?php 
        else:
      ?>
        $('.proof-box-preview').removeAttr('style'); 
      <?php
        endif;
      ?>
      
     }
     else
     {
      clearInterval(run);  
     }
  });
});

/* run animation display */
 function runningProof()
{
  var total = $(".proof-wrapper-preview").length;
  var counting = 0;
  var timing = 5500;

  run = setInterval(
    function(){
      $('.proof-box-preview').css({'width':'260px','height':'145px'}); //make animation stable
      animateProof(counting);
      counting++;

      //put php logic according on setting
      <?php 
        if($pages->proof_settings == 0):
      ?>
          if(counting == total)
          {
            setTimeout(function(){
              clearInterval(run);
              $('.proof-wrapper-preview').hide();
              $('.proof-box-preview').removeAttr('style');    
            },4500);      
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
  var speed = 350;
  var delay = 3150
  
  $('.proof-wrapper-preview').eq(interval).css({ 'display' : 'inline-flex'}).animate({
      top : 0,
   }, {
    duration : speed,
    complete : function(){
      $(this).delay(delay).fadeOut(function(){
        $(this).css({'top' : '120px'});
      });
    }
  });
}
</script>