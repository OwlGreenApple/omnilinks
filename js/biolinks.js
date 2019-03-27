/* biolink messenngers*/
var arra=0;
$(document).ready(function(){
    $(document).on('click', '#tambah', function (e) {
    $('.messengers').each(function () {
        if($(this).hasClass('hidden'))
        {
            $(this).show();
            $(this).removeClass('hidden');
            $(this).parent().attr("id","msg-"+$(this).attr('data-type'));
            return false;
        }      
    });
});
    $('#deletewa').on('click', function () {
            $('#wa').hide();
            $('#wa').addClass('hidden');
            return false;
        });
    $('#deletetelegram').on('click', function () {
            $('#telegram').hide();
            $('#telegram').addClass('hidden');
            return false;
        });
    $( '#deleteskype').on('click', function () {
        $('#skype').hide();
        $('#skype').addClass('hidden');
        return false;
    });
    /* biolink link */
    $(document).on('click', '#addlink', function (e){
   // console.log(arra);
   //arra+=1;
    $( ".a" ).append( '<li id="link-wa"><div class="row"><div class="col-md-1 col-1 pl-md-3 pl-2"><span class="handle"><i class="fas fa-bars"></i></span></div><div class="col-md-11 col-11"><div class="input-stack"><input type="hidden" name="idlink[]" value="new"><input type="text" name="title[]" value="" placeholder="Title" class="form-control" ><input type="text" name="url[]" value="" placeholder="http://url..." class="form-control" style="margin-bottom:20px;"><button class="deletelink btn btn-primary" type="button"><i class="fas fa-trash-alt"></i></button></div></div></div></li>');

    });
    $(document).on('click','.deletelink',function(e){
      $(this).parent().parent().parent().remove();
    });
    //Banner
//    $(document).on('click','#addBanner',function(){
//        $('.b').append(' <input type="text" name="judulBanner" value="" class="form-control" placeholder="Judul banner"><input type="text" name="linkBanner" value="" class="form-control" placeholder="masukkan link"><select name="bannerpixel" class="form-control"><option value="">--Pilih Pixel Yang telah dibuat--</option>@foreach($pixels as $pixel)<option value="{{$pixel->id}}">{{$pixel->title}}</option>@endforeach</select><input type="file" name="bannerImage" value="Upload">');
//    });
    /* biolink social-media */
    $(document).on('click','#sm',function(e){
      $('.socialmedia').each(function(){
        if($(this).hasClass('hidden')) {
          $(this).show();
          $(this).removeClass('hidden');
          $(this).parent().attr("id","sosmed-"+$(this).attr('data-type'));
          return false;
        }
      });
    });
    $('#deleteyoutube').on('click',  function () {
                $('#youtube').hide();
                $('#youtube').addClass('hidden');
                return false;
            });
            $('#deleteig').on('click',function (e) {
                $('#ig').hide();
                $('#ig').addClass('hidden');
                return false;
            });
        $('#deletefb').on('click', function (e) {
            $('#fb').hide();
            $('#fb').addClass('hidden');
            return false;
        });
        $( '#deletetwitter').on('click', function (e) {
            $('#twitter').hide();
            $('#twitter').addClass('hidden');
            return false;
        });
});
/* hanya angka */
function hanyaAngka(evt) {
    var charCode = (evt.which)?evt.which:event.keyCode
     if (charCode>31&&(charCode<48||charCode>57))

      return false;
    return true;
  }
  /* copy element */
  function copyTO(element)
  {
    var $temp=$('<input>');
    $('body').append($temp);
    $temp.val($(element).text()).select();
    document.execCommand('copy');
    $temp.remove();
  }

  //
   $('.theme1').click(function(){
        $('.mobile1').children().remove();
        $('.mobile1').html(' <div class="screen colorgradient1" id="phonecolor"></div>');
        console.log('halo');
        $('#backtheme').val('colorgradient1');
    });
    $('.theme2').click(function(){
        $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient2" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient2');
    });
    $('.theme3').click(function(){
        $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient3" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient3');
    });
     $('.theme4').click(function(){
      $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient4" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient4');
    });
    $('.theme5').click(function(){
         $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient5" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient5');
    });
    $('.theme6').click(function(){
      $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient6" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient6');
    });
     $('.theme7').click(function(){
      $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient7" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient7');
    });
    $('.theme8').click(function(){
      $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient8" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient8');
    });
    $('.theme9').click(function(){
      $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient9" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient9');
    });
    $('.theme10').click(function(){
      $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient10" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient10');
    });
     $('.theme11').click(function(){
   $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient11" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient11');
    });
    $('.theme12').click(function(){
       $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient12" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient12');
    });
    $('.theme13').click(function(){
        $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient13" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient13');
    });
     $('.theme14').click(function(){
      $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient14" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient14');
    });
    $('.theme15').click(function(){
        $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient15" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient15');
    });
    $('.theme16').click(function(){
        $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient16" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient16');
    });
     $('.theme17').click(function(){
      $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient17" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient17');
    });
    $('.theme18').click(function(){
      $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient18" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient18');
    });
    $('.theme19').click(function(){
     $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient19" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient19');
    });
    $('.theme20').click(function(){
       $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient20" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient20');
    });
      $('.theme21').click(function(){
        $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient21" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient21');
    });
    $('.theme22').click(function(){
      $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient22" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient22');
    });
    $('.theme23').click(function(){
       $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient23" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient23');
    });
     $('.theme24').click(function(){
      $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient24" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient24');
    });
    $('.theme25').click(function(){
       $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient25" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient25');
    });
    $('.theme26').click(function(){
      $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient26" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient26');
    });
     $('.theme27').click(function(){
      $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient27" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient27');
    });
    $('.theme28').click(function(){
      $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient28" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient28');
    });
    $('.theme29').click(function(){
      $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient29" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient29');
    });
    $('.theme30').click(function(){
       $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient30" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient30');
    });
     $('.theme31').click(function(){
      $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient31" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient31');
    });
    $('.theme32').click(function(){
       $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient32" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient32');
    });
    $('.theme33').click(function(){
        $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient33" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient33');
    });
     $('.theme34').click(function(){
       $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient34" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient34');
    });
    $('.theme35').click(function(){
       $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient35" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient35');
    });
    $('.theme36').click(function(){
      $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient36" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient36');
    });
     $('.theme37').click(function(){
       $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient37" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient37');
    });
    $('.theme38').click(function(){
        $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient38" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient38');
    });
    $('.theme39').click(function(){
       $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient39" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient39');
    });
    $('.theme40').click(function(){
        $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient40" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient40');
    });
       $('.theme41').click(function(){
       $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient41" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient41');
    });
    $('.theme42').click(function(){
        $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient42" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient42');
    });
    $('.theme43').click(function(){
      $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient43" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient43');
    });
     $('.theme44').click(function(){
       $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient44" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient44');
    });
    $('.theme45').click(function(){
      $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient45" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient45');
    });
    $('.theme46').click(function(){
       $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient46" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient46');
    });
     $('.theme47').click(function(){
       $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient47" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient47');
    });
    $('.theme48').click(function(){
       $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient48" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient48');
    });
    $('.theme49').click(function(){
      $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient49" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient49');
    });
    $('.theme50').click(function(){
      $('.mobile1').children().remove();
        $('.mobile1').html('<div class="screen colorgradient50" id="phonecolor"></div>');
        $('#backtheme').val('colorgradient50');
    });
    

