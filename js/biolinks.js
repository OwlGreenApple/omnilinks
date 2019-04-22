var arra=0;
var elmhtml,counterLink=0;
let viewButton=1;

// function deleteview(id)
// {
//    let delete=0; 
// }
$(document).ready(function(){

  $(document).on('click', '#tambah', function (e) {
    $('.messengers').each(function(){
      if($(this).hasClass('hidden')) {
        console.log('remove hidden');
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
    viewButton+=1;

    var $el;
    /*if($('.link-list').length<=0){
      var $el = $( ".sortable-link" ).append(elmhtml);
    } else {
      var $el = $('.link-list:first').clone().appendTo('.sortable-link');
    }
    $el.find("input").val("");
    $el.find("input").attr("value", "");*/
    counterLink+=1;
    $('.sortable-link').append('<li class="link-list" link-id="link-url-'+counterLink+'"><div class="div-table mb-4"><div class="div-cell"><span class="handle"><i class="fas fa-bars"></i></span></div><div class="div-cell"><div class="col-md-12 col-12 pr-0 pl-0"><div class="input-stack"><input type="hidden" name="idlink[]" value="new"><input type="text" name="title[]" value="" placeholder="Title" class="form-control"><input type="text" name="url[]" value="" placeholder="http://url..." class="form-control"></div></div></div><div class="div-cell cell-btn deletelink"><span><i class="far fa-trash-alt"></i></span></div></div></li>');
    
    $("#viewLink").append(' <button type="button" class="btn btn-light btnview" id="link-url-'+counterLink+'-preview" style="width: 100%; margin-bottom: 12px;">tes'+counterLink+'</button>');
    //$( ".a" ).append( '<li id="link-wa"><div class="row"><div class="col-md-1 col-1 pl-md-3 pl-2"><span class="handle"><i class="fas fa-bars"></i></span></div><div class="col-md-11 col-11"><div class="input-stack"><input type="hidden" name="idlink[]" value="new"><input type="text" name="title[]" value="" placeholder="Title" class="form-control" ><input type="text" name="url[]" value="" placeholder="http://url..." class="form-control" style="margin-bottom:20px;"><button class="deletelink btn btn-primary" type="button"><i class="fas fa-trash-alt"></i></button></div></div></div></li>');
  });
  $(document).on('click','.deletelink',function(e){
   // $("#viewLink").children().remove();

    /*let elviewlink=$("#viewLink");

    if($('.link-list').length<=1)
    {
      elmhtml = $('.sortable-link').html();
    } 
    elviewlink.children().remove();*/
    idLink = $(this).parent().parent().attr("link-id");
    console.log(idLink);
    $("#"+idLink+"-preview").remove();

    $(this).parent().parent().remove();
  });
  
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
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient1');
    $('#backtheme').val('colorgradient1');
  });
  $('.theme2').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient2');
    $('#backtheme').val('colorgradient2');
  });
  $('.theme3').click(function(){
   $('#phonecolor').removeAttr("class");
   $('#phonecolor').addClass('screen colorgradient3');
   $('#backtheme').val('colorgradient3');
 });
  $('.theme4').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient4');
    $('#backtheme').val('colorgradient4');
  });
  $('.theme5').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient5');
    $('#backtheme').val('colorgradient5');
  });
  $('.theme6').click(function(){
   $('#phonecolor').removeAttr("class");
   $('#phonecolor').addClass('screen colorgradient6');
   $('#backtheme').val('colorgradient6');
 });
  $('.theme7').click(function(){
   $('#phonecolor').removeAttr("class");
   $('#phonecolor').addClass('screen colorgradient7');
   $('#backtheme').val('colorgradient7');
 });
  $('.theme8').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient8');
    $('#backtheme').val('colorgradient8');
  });
  $('.theme9').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient9');
    $('#backtheme').val('colorgradient9');
  });
  $('.theme10').click(function(){
   $('#phonecolor').removeAttr("class");
   $('#phonecolor').addClass('screen colorgradient10');
   $('#backtheme').val('colorgradient10');
 });
  $('.theme11').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient11');
    $('#backtheme').val('colorgradient11');
  });
  $('.theme12').click(function(){
   $('#phonecolor').removeAttr("class");
   $('#phonecolor').addClass('screen colorgradient12');
   $('#backtheme').val('colorgradient12');
 });
  $('.theme13').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient13');
    $('#backtheme').val('colorgradient13');
  });
  $('.theme14').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient14');
    $('#backtheme').val('colorgradient14');
  });
  $('.theme15').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient15');
    $('#backtheme').val('colorgradient15');
  });
  $('.theme16').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient16');
    $('#backtheme').val('colorgradient16');
  });
  $('.theme17').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient17');
    $('#backtheme').val('colorgradient17');
  });
  $('.theme18').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient18');
    $('#backtheme').val('colorgradient18');
  });
  $('.theme19').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient19');
    $('#backtheme').val('colorgradient19');
  });
  $('.theme20').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient20');
    $('#backtheme').val('colorgradient20');
  });
  $('.theme21').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient21');
    $('#backtheme').val('colorgradient21');
  });
  $('.theme22').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient22');
    $('#backtheme').val('colorgradient22');
  });
  $('.theme23').click(function(){
   $('#phonecolor').removeAttr("class");
   $('#phonecolor').addClass('screen colorgradient23');
   $('#backtheme').val('colorgradient23');
 });
  $('.theme24').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient24');
    $('#backtheme').val('colorgradient24');
  });
  $('.theme25').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient25');
    $('#backtheme').val('colorgradient25');
  });
  $('.theme26').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient26');
    $('#backtheme').val('colorgradient26');
  });
  $('.theme27').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient27');
    $('#backtheme').val('colorgradient27');
  });
  $('.theme28').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient28');
    $('#backtheme').val('colorgradient28');
  });
  $('.theme29').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient29');
    $('#backtheme').val('colorgradient29');
  });
  $('.theme30').click(function(){
   $('#phonecolor').removeAttr("class");
   $('#phonecolor').addClass('screen colorgradient30');
   $('#backtheme').val('colorgradient30');
 });
  $('.theme31').click(function(){
   $('#phonecolor').removeAttr("class");
   $('#phonecolor').addClass('screen colorgradient31');
   $('#backtheme').val('colorgradient31');
 });
  $('.theme32').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient32');
    $('#backtheme').val('colorgradient32');
  });
  $('.theme33').click(function(){
   $('#phonecolor').removeAttr("class");
   $('#phonecolor').addClass('screen colorgradient33');
   $('#backtheme').val('colorgradient33');
 });
  $('.theme34').click(function(){
   $('#phonecolor').removeAttr("class");
   $('#phonecolor').addClass('screen colorgradient34');
   $('#backtheme').val('colorgradient34');
 });
  $('.theme35').click(function(){
   $('#phonecolor').removeAttr("class");
   $('#phonecolor').addClass('screen colorgradient35');
   $('#backtheme').val('colorgradient35');
 });
  $('.theme36').click(function(){
   $('#phonecolor').removeAttr("class");
   $('#phonecolor').addClass('screen colorgradient36');
   $('#backtheme').val('colorgradient36');
 });
  $('.theme37').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient37');
    $('#backtheme').val('colorgradient37');
  });
  $('.theme38').click(function(){
   $('#phonecolor').removeAttr("class");
   $('#phonecolor').addClass('screen colorgradient38');
   $('#backtheme').val('colorgradient38');
 });
  $('.theme39').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient39');
    $('#backtheme').val('colorgradient39');
  });
  $('.theme40').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient40');
    $('#backtheme').val('colorgradient40');
  });
  $('.theme41').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient41');
    $('#backtheme').val('colorgradient41');
  });
  $('.theme42').click(function(){
   $('#phonecolor').removeAttr("class");
   $('#phonecolor').addClass('screen colorgradient42');
   $('#backtheme').val('colorgradient42');
 });
  $('.theme43').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient43');
    $('#backtheme').val('colorgradient43');
  });
  $('.theme44').click(function(){
   $('#phonecolor').removeAttr("class");
   $('#phonecolor').addClass('screen colorgradient44');
   $('#backtheme').val('colorgradient44');
 });
  $('.theme45').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient45');
    $('#backtheme').val('colorgradient45');
  });
  $('.theme46').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient46');
    $('#backtheme').val('colorgradient46');
  });
  $('.theme47').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient47');
    $('#backtheme').val('colorgradient47');
  });
  $('.theme48').click(function(){
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient48');
    $('#backtheme').val('colorgradient48');
  });
  $('.theme49').click(function(){
   $('#phonecolor').removeAttr("class");
   $('#phonecolor').addClass('screen colorgradient49');
   $('#backtheme').val('colorgradient49');
 });
  $('.theme50').click(function(){
   $('#phonecolor').removeAttr("class");
   $('#phonecolor').addClass('screen colorgradient50');
   $('#backtheme').val('colorgradient50');
 });


