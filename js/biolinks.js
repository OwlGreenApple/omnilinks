/* biolink messenngers*/
var arra=0;
$(document).ready(function(){
    $(document).on('click', '#tambah', function (e) {
    $('.messengers').each(function () {
        if($(this).hasClass('hidden'))
        {
            $(this).show();
            $(this).removeClass('hidden');
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
    $( ".a" ).append( '<div class="input-stack"> <input type="text" name="title[]" value="" placeholder="Title" class="form-control"> <input type="text" name="url[]" value="" placeholder="http://url..." class="form-control" style="margin-bottom:20px;"><button class="deletelink btn btn-primary" type="button"><i class="fas fa-trash-alt"></i></button></div>');
    });
    $(document).on('click','.deletelink',function(e){
      $(this).parent().remove();
    });

    /* biolink social-media */
    $(document).on('click','#sm',function(e){
        $('.socialmedia').each(function(){
            if($(this).hasClass('hidden'))
            {
            $(this).show();
            $(this).removeClass('hidden');
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
function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode > 31 && (charCode < 48 || charCode > 57))

      return false;
    return true;
  }