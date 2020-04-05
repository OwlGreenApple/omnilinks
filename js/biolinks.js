var arra = 0;
var elmhtml, counterLink = 2;

// function deleteview(id)
// {
//    let delete=0; 
// }
function changeLength() {
    if ($('.shown-mes').length == 1) {
        $('.shown-mes').parent().removeAttr('class');
        $('.shown-mes').parent().addClass('links messengers links-num-1');
    } else if ($('.shown-mes').length == 2) {
        $('.shown-mes').parent().removeAttr('class');
        $('.shown-mes').parent().addClass('links messengers links-num-2');
    } else if ($('.shown-mes').length == 3) {
        $('.shown-mes').parent().removeAttr('class');
        $('.shown-mes').parent().addClass('links messengers links-num-3');
    }
}

function changeLengthMedia() {
    if ($('.shown-sm').length == 1) {
        $('.shown-sm').removeClass('col-md-6 col-md-4 col-md-3');
        $('.shown-sm').addClass('col-md-12 linked shown-sm');
    } else if ($('.shown-sm').length == 2) {
        $('.shown-sm').removeClass('col-md-12 col-md-4 col-md-3');
        $('.shown-sm').addClass('col-md-6 linked shown-sm');
    } else if ($('.shown-sm').length == 3) {
        $('.shown-sm').removeClass('col-md-6 col-md-12 col-md-3');
        $('.shown-sm').addClass('col-md-4 linked shown-sm');
    } else if ($('.shown-sm').length == 4) {
        $('.shown-sm').removeClass('col-md-6 col-md-4 col-md-12');
        $('.shown-sm').addClass('col-md-3 linked shown-sm');
    }
}

$(document).ready(function () {

    //changeLength();
    //changeLengthMedia();
    /*if ($('.wa-input').val()!='') {
      $('#wa').show();
      $('#waviewid').addClass('shown-mes').show();
        changeLength();
    }*/
    if ($('.telegram-input').val()!='') {
      $('#telegram').show();
      //$('#telegramviewid').addClass('shown-mes').show();
        //changeLength();
    }
    if ($('.skype-input').val()!='') {
      $('#skype').show();
      $('#skypeviewid').addClass('shown-mes').show();
        //changeLength();
    }
    if ($('.youtube-input').val()!='') {
      $('#youtube').show();
      $('#youtubeviewid').addClass('shown-sm').show();
      //changeLengthMedia();
    }
    if ($('.twitter-input').val()!='') {
      $('#twitter').show();
      $('#twitterviewid').addClass('shown-sm').show();
      //changeLengthMedia();
    }
    if ($('.fb-input').val()!='') {
      $('#fb').show();
      $('#fbviewid').addClass('shown-sm').show();
      //changeLengthMedia();
    }
    if ($('.ig-input').val()!='') {
      $('#ig').show();
      $('#igid').addClass('shown-sm').show();
      //changeLengthMedia();
    }

    $('#deletewa').on('click', function () {
        $('#wa').hide();
        $('#wa').addClass('hide');
        $('#wa').find("input").val('');
        $('#waviewid').hide();
        $('#waviewid').addClass('hide');
        $('#waviewid').removeClass('shown-mes');
        renameColMessage();
        //changeLength();
        return false;
    });

    $('#deletetelegram').on('click', function () {
        $('#telegram').hide();
        $('#telegram').addClass('hide');
        $('#telegram').find("input").val('');
        $('#telegramviewid').hide();
        $('#telegramviewid').addClass('hide');
        $('#telegramviewid').removeClass('shown-mes');
        renameColMessage();
        //changeLength();
        return false;
    });

    $('#deleteskype').on('click', function () {
        $('#skype').hide();
        $('#skype').addClass('hide');
        $('#skype').find("input").val('');
        $('#skypeviewid').hide();
        $('#skypeviewid').addClass('hide');
        $('#skypeviewid').removeClass('shown-mes');
        renameColMessage();
        //changeLength();
        return false;
    });

    $('#deleteline').on('click', function () {
        $('#line').hide();
        $('#line').addClass('hide');
        $('#line').find("input").val('');
        $('#lineviewid').hide();
        $('#lineviewid').addClass('hide');
        $('#lineviewid').removeClass('shown-mes');
        renameColMessage();
        //changeLength();
        return false;
    });

    $('#deletemessenger').on('click', function () {
        $('#messenger').hide();
        $('#messenger').addClass('hide');
        $('#messenger').find("input").val('');
        $('#messengerviewid').hide();
        $('#messengerviewid').addClass('hide');
        $('#messengerviewid').removeClass('shown-mes');
        renameColMessage();
        //changeLength();
        return false;
    });


    $(document).on('click', '.deletelink', function (e) {
      //let idLink = $(this).parent().parent().attr("link-id");
      var idLink = $(this).parent().parent().attr("id");
      console.log(idLink);
      $("#" + idLink + "-preview").remove();
      $(this).parent().parent().remove();
    });

    $(document).on('click','.deletelink-update',function(e){
        //let idlinkDel=$(this).parent().parent().attr("link-id");
        var idlinkDel=$(this).parent().parent().attr("id");
        $("#" + idlinkDel + "-get").remove();
        let deleteval=$(this).parent();
        deleteval.find(".delete-link").val('delete');
        $(this).parent().parent().hide();
        check_click_bait();
    });

    /* biolink social-media */
    $(document).on('click', '#sm', function (e) {
      $('.socialmedia').each(function () {
        if ($(this).hasClass('hide')) {
          //$(this).show();
          $(this).css("display","table");
          $(this).find(".input-hidden").val($(this).find(".input-hidden").attr("data-val"));
          $(this).removeClass('hide');
          $(this).parent().attr("id", "sosmed-" + $(this).attr('data-type'));
          return false;
        }
      });
      $('.linked').each(function () {
        if ($(this).hasClass('hide')) {
          $(this).show();
          $(this).removeClass('hide');
          $(this).addClass('shown-sm');
          return false;
        }
      });
      //changeLengthMedia();
    });

    $('#deleteyoutube').on('click', function () {
        $('#youtube').hide();
        $('#youtube').addClass('hide');
        $('#youtube').find("input").val('');
        $('#youtubeviewid').hide();
        $('#youtubeviewid').addClass('hide');
        $('#youtubeviewid').removeClass('shown-sm');
        //changeLengthMedia();
        return false;
    });
    $('#deleteig').on('click', function (e) {
        $('#ig').hide();
        $('#ig').addClass('hide');
        $('#ig').find("input").val('');
        $('#igviewid').hide();
        $('#igviewid').addClass('hide');
        $('#igviewid').removeClass('shown-sm');
        //changeLengthMedia();
        return false;
    });
    $('#deletefb').on('click', function (e) {
        $('#fb').hide();
        $('#fb').addClass('hide');
        $('#fb').find("input").val('');
        $('#fbviewid').hide();
        $('#fbviewid').addClass('hide');
        $('#fbviewid').removeClass('shown-sm');
        //changeLengthMedia();
        return false;
    });
    $('#deletetwitter').on('click', function (e) {
        $('#twitter').hide();
        $('#twitter').addClass('hide');
        $('#twitter').find("input").val('');
        $('#twitterviewid').hide();
        $('#twitterviewid').addClass('hide');
        $('#twitterviewid').removeClass('shown-sm');
        //changeLengthMedia();
        return false;
    });
});
/* hanya angka */
function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which :event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
/* copy element */
function copyTO(element) {
    var $temp = $('<input>');
    $('body').append($temp);
    $temp.val($(element).text()).select();
    document.execCommand('copy');
    $temp.remove();

    $('#copy-link').modal('show');
}

//bubble
$('.thumb-bubble-bg-blue').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-bg-blue animation-core');
    $('#animationclass').val('animation-bubble-bg-blue animation-core');
});
$('.thumb-bubble-bg-orange').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-bg-orange');
    $('#animationclass').val('animation-bubble-bg-orange');
});
$('.thumb-bubble-bg-pink').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-bg-pink');
    $('#animationclass').val('animation-bubble-bg-pink');
});
$('.thumb-bubble-bg-purple').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-bg-purple');
    $('#animationclass').val('animation-bubble-bg-purple');
});
$('.thumb-bubble-bg-yellow').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-bg-yellow');
    $('#animationclass').val('animation-bubble-bg-yellow');
});
$('.thumb-bubble-bg-red').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-bg-red');
    $('#animationclass').val('animation-bubble-bg-red');
});
$('.thumb-bubble-blue').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-blue');
    $('#animationclass').val('animation-bubble-blue');
});
$('.thumb-bubble-brown').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-brown');
    $('#animationclass').val('animation-bubble-brown');
});
$('.thumb-bubble-colorful').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-colorful');
    $('#animationclass').val('animation-bubble-colorful');
});
$('.thumb-bubble-green').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-green');
    $('#animationclass').val('animation-bubble-green');
});
$('.thumb-bubble-orange').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-orange');
    $('#animationclass').val('animation-bubble-orange');
});
$('.thumb-bubble-purple').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-purple');
    $('#animationclass').val('animation-bubble-purple');
});
$('.thumb-bubble-red').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-red');
    $('#animationclass').val('animation-bubble-red');
});
$('.thumb-bubble-soft').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-soft');
    $('#animationclass').val('animation-bubble-soft');
});

//bubble-up
$('.thumb-bubble-up-bg-blue').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-up-bg-blue');
    $('#animationclass').val('animation-bubble-up-bg-blue');
});
$('.thumb-bubble-up-bg-brown').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-up-bg-brown');
    $('#animationclass').val('animation-bubble-up-bg-brown');
});
$('.thumb-bubble-up-bg-green').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-up-bg-green');
    $('#animationclass').val('animation-bubble-up-bg-green');
});
$('.thumb-bubble-up-bg-pink').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-up-bg-pink');
    $('#animationclass').val('animation-bubble-up-bg-pink');
});
$('.thumb-bubble-up-bg-purple').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-up-bg-purple');
    $('#animationclass').val('animation-bubble-up-bg-purple');
});
$('.thumb-bubble-up-bg-red').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-up-bg-red');
    $('#animationclass').val('animation-bubble-up-bg-red');
});
$('.thumb-bubble-up-blue').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-up-blue');
    $('#animationclass').val('animation-bubble-up-blue');
});
$('.thumb-bubble-up-green').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-up-green');
    $('#animationclass').val('animation-bubble-up-green');
});
$('.thumb-bubble-up-lilac').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-up-lilac');
    $('#animationclass').val('animation-bubble-up-lilac');
});
$('.thumb-bubble-up-mocca').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-up-mocca');
    $('#animationclass').val('animation-bubble-up-mocca');
});
$('.thumb-bubble-up-orange').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-up-orange');
    $('#animationclass').val('animation-bubble-up-orange');
});
$('.thumb-bubble-up-pink').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-up-pink');
    $('#animationclass').val('animation-bubble-up-pink');
});
$('.thumb-bubble-up-red').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-up-red');
    $('#animationclass').val('animation-bubble-up-red');
});
$('.thumb-bubble-up-soft-color').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-bubble-up-soft-color');
    $('#animationclass').val('animation-bubble-up-soft-color');
});

//cloud
$('.thumb-cloud-bg-blue').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-cloud-bg-blue');
    $('#animationclass').val('animation-cloud-bg-blue');
});
$('.thumb-cloud-bg-cyan').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-cloud-bg-cyan');
    $('#animationclass').val('animation-cloud-bg-cyan');
});
$('.thumb-cloud-bg-green').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-cloud-bg-green');
    $('#animationclass').val('animation-cloud-bg-green');
});
$('.thumb-cloud-bg-orange').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-cloud-bg-orange');
    $('#animationclass').val('animation-cloud-bg-orange');
});
$('.thumb-cloud-bg-pink').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-cloud-bg-pink');
    $('#animationclass').val('animation-cloud-bg-pink');
});
$('.thumb-cloud-bg-purple').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-cloud-bg-purple');
    $('#animationclass').val('animation-cloud-bg-purple');
});
$('.thumb-cloud-bg-red').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-cloud-bg-red');
    $('#animationclass').val('animation-cloud-bg-red');
});
$('.thumb-cloud-bg-yellow').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-cloud-bg-yellow');
    $('#animationclass').val('animation-cloud-bg-yellow');
});
$('.thumb-cloud-blue-orang').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-cloud-blue-orang');
    $('#animationclass').val('animation-cloud-blue-orang');
});
$('.thumb-cloud-brown').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-cloud-brown');
    $('#animationclass').val('animation-cloud-brown');
});
$('.thumb-cloud-gold').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-cloud-gold');
    $('#animationclass').val('animation-cloud-gold');
});
$('.thumb-cloud-gray').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-cloud-gray');
    $('#animationclass').val('animation-cloud-gray');
});
$('.thumb-cloud-green').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-cloud-green');
    $('#animationclass').val('animation-cloud-green');
});
$('.thumb-cloud-green-yellow').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-cloud-green-yellow');
    $('#animationclass').val('animation-cloud-green-yellow');
});
$('.thumb-cloud-light-blue').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-cloud-light-blue');
    $('#animationclass').val('animation-cloud-light-blue');
});
$('.thumb-cloud-orange').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-cloud-orange');
    $('#animationclass').val('animation-cloud-orange');
});
$('.thumb-cloud-pastel').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-cloud-pastel');
    $('#animationclass').val('animation-cloud-pastel');
});
$('.thumb-cloud-pink').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-cloud-pink');
    $('#animationclass').val('animation-cloud-pink');
});
$('.thumb-cloud-purple').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-cloud-purple');
    $('#animationclass').val('animation-cloud-purple');
});
$('.thumb-cloud-purple-yellow').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-cloud-purple-yellow');
    $('#animationclass').val('animation-cloud-purple-yellow');
});
$('.thumb-cloud-red').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-cloud-red');
    $('#animationclass').val('animation-cloud-red');
});
$('.thumb-cloud-soft').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-cloud-soft');
    $('#animationclass').val('animation-cloud-soft');
});

//confetti
$('.thumb-confetti-bg-blue').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-confetti-bg-blue');
    $('#animationclass').val('animation-confetti-bg-blue');
});
$('.thumb-confetti-bg-latte').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-confetti-bg-latte');
    $('#animationclass').val('animation-confetti-bg-latte');
});
$('.thumb-confetti-bg-orange').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-confetti-bg-orange');
    $('#animationclass').val('animation-confetti-bg-orange');
});
$('.thumb-confetti-bg-pink').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-confetti-bg-pink');
    $('#animationclass').val('animation-confetti-bg-pink');
});
$('.thumb-confetti-bg-white').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-confetti-bg-white');
    $('#animationclass').val('animation-confetti-bg-white');
});
$('.thumb-confetti-bg-yellow').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-confetti-bg-yellow');
    $('#animationclass').val('animation-confetti-bg-yellow');
});
$('.thumb-confetti-blue').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-confetti-blue');
    $('#animationclass').val('animation-confetti-blue');
});
$('.thumb-confetti-brown').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-confetti-brown');
    $('#animationclass').val('animation-confetti-brown');
});
$('.thumb-confetti-gray').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-confetti-gray');
    $('#animationclass').val('animation-confetti-gray');
});
$('.thumb-confetti-green').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-confetti-green');
    $('#animationclass').val('animation-confetti-green');
});
$('.thumb-confetti-pink').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-confetti-pink');
    $('#animationclass').val('animation-confetti-pink');
});
$('.thumb-confetti-purple').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-confetti-purple');
    $('#animationclass').val('animation-confetti-purple');
});
$('.thumb-confetti-red').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-confetti-red');
    $('#animationclass').val('animation-confetti-red');
});
$('.thumb-confetti-soft').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-confetti-soft');
    $('#animationclass').val('animation-confetti-soft');
});

//disk
$('.thumb-disk-blue').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-disk-blue');
    $('#animationclass').val('animation-disk-blue');
});
$('.thumb-disk-dual-color').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-disk-dual-color');
    $('#animationclass').val('animation-disk-dual-color');
});
$('.thumb-disk-green').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-disk-green');
    $('#animationclass').val('animation-disk-green');
});
$('.thumb-disk-orange').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-disk-orange');
    $('#animationclass').val('animation-disk-orange');
});
$('.thumb-disk-pink').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-disk-pink');
    $('#animationclass').val('animation-disk-pink');
});
$('.thumb-disk-purple').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-disk-purple');
    $('#animationclass').val('animation-disk-purple');
});
$('.thumb-disk-red').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-disk-red');
    $('#animationclass').val('animation-disk-red');
});
$('.thumb-disk-yellow').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-disk-yellow');
    $('#animationclass').val('animation-disk-yellow');
});

//gradient
$('.thumb-gradient-blue').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-gradient-blue');
    $('#animationclass').val('animation-gradient-blue');
});
$('.thumb-gradient-blue-purple').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-gradient-blue-purple');
    $('#animationclass').val('animation-gradient-blue-purple');
});
$('.thumb-gradient-cyan').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-gradient-cyan');
    $('#animationclass').val('animation-gradient-cyan');
});
$('.thumb-gradient-green').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-gradient-green');
    $('#animationclass').val('animation-gradient-green');
});
$('.thumb-gradient-orange').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-gradient-orange');
    $('#animationclass').val('animation-gradient-orange');
});
$('.thumb-gradient-peach').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-gradient-peach');
    $('#animationclass').val('animation-gradient-peach');
});
$('.thumb-gradient-purple').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-gradient-purple');
    $('#animationclass').val('animation-gradient-purple');
});
$('.thumb-gradient-soft-blue').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-gradient-soft-blue');
    $('#animationclass').val('animation-gradient-soft-blue');
});

//leaves
$('.thumb-leaves-bg-blue').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-leaves-bg-blue');
    $('#animationclass').val('animation-leaves-bg-blue');
});
$('.thumb-leaves-bg-green').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-leaves-bg-green');
    $('#animationclass').val('animation-leaves-bg-green');
});
$('.thumb-leaves-bg-moca').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-leaves-bg-moca');
    $('#animationclass').val('animation-leaves-bg-moca');
});
$('.thumb-leaves-bg-orange').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-leaves-bg-orange');
    $('#animationclass').val('animation-leaves-bg-orange');
});
$('.thumb-leaves-bg-purple').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-leaves-bg-purple');
    $('#animationclass').val('animation-leaves-bg-purple');
});
$('.thumb-leaves-bg-red').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-leaves-bg-red');
    $('#animationclass').val('animation-leaves-bg-red');
});
$('.thumb-leaves-blue').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-leaves-blue');
    $('#animationclass').val('animation-leaves-blue');
});
$('.thumb-leaves-gray').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-leaves-gray');
    $('#animationclass').val('animation-leaves-gray');
});
$('.thumb-leaves-green').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-leaves-green');
    $('#animationclass').val('animation-leaves-green');
});
$('.thumb-leaves-pastel').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-leaves-pastel');
    $('#animationclass').val('animation-leaves-pastel');
});
$('.thumb-leaves-pink').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-leaves-pink');
    $('#animationclass').val('animation-leaves-pink');
});
$('.thumb-leaves-purple').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-leaves-purple');
    $('#animationclass').val('animation-leaves-purple');
});
$('.thumb-leaves-red').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-leaves-red');
    $('#animationclass').val('animation-leaves-red');
});
$('.thumb-leaves-yellow').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-leaves-yellow');
    $('#animationclass').val('animation-leaves-yellow');
});

//wave
$('.thumb-wave-blue').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-wave-blue');
    $('#animationclass').val('animation-wave-blue');
});
$('.thumb-wave-brown').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-wave-brown');
    $('#animationclass').val('animation-wave-brown');
});
$('.thumb-wave-dual-tone').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-wave-dual-tone');
    $('#animationclass').val('animation-wave-dual-tone');
});
$('.thumb-wave-green').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-wave-green');
    $('#animationclass').val('animation-wave-green');
});
$('.thumb-wave-mocca').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-wave-mocca');
    $('#animationclass').val('animation-wave-mocca');
});
$('.thumb-wave-orange').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-wave-orange');
    $('#animationclass').val('animation-wave-orange');
});
$('.thumb-wave-peach').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-wave-peach');
    $('#animationclass').val('animation-wave-peach');
});
$('.thumb-wave-pink').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-wave-pink');
    $('#animationclass').val('animation-wave-pink');
});
$('.thumb-wave-purple').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-wave-purple');
    $('#animationclass').val('animation-wave-purple');
});
$('.thumb-wave-red').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-wave-red');
    $('#animationclass').val('animation-wave-red');
});
$('.thumb-wave-soft-blue').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-wave-soft-blue');
    $('#animationclass').val('animation-wave-soft-blue');
});
$('.thumb-wave-soft-purple').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-wave-soft-purple');
    $('#animationclass').val('animation-wave-soft-purple');
});
$('.thumb-wave-yellow').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-wave-yellow');
    $('#animationclass').val('animation-wave-yellow');
});

//waves
$('.thumb-waves-blue').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-waves-blue');
    $('#animationclass').val('animation-waves-blue');
});
$('.thumb-waves-chocolate').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-waves-chocolate');
    $('#animationclass').val('animation-waves-chocolate');
});
$('.thumb-waves-green').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-waves-green');
    $('#animationclass').val('animation-waves-green');
});
$('.thumb-waves-grey').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-waves-grey');
    $('#animationclass').val('animation-waves-grey');
});
$('.thumb-waves-light-blue').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-waves-light-blue');
    $('#animationclass').val('animation-waves-light-blue');
});
$('.thumb-waves-light-brown').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-waves-light-brown');
    $('#animationclass').val('animation-waves-light-brown');
});
$('.thumb-waves-ocean').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-waves-ocean');
    $('#animationclass').val('animation-waves-ocean');
});
$('.thumb-waves-orange').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-waves-orange');
    $('#animationclass').val('animation-waves-orange');
});
$('.thumb-waves-pink').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-waves-pink');
    $('#animationclass').val('animation-waves-pink');
});
$('.thumb-waves-purple').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-waves-purple');
    $('#animationclass').val('animation-waves-purple');
});
$('.thumb-waves-red').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-waves-red');
    $('#animationclass').val('animation-waves-red');
});
$('.thumb-waves-sand').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-waves-sand');
    $('#animationclass').val('animation-waves-sand');
});
$('.thumb-waves-yellow').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen animation-waves-yellow');
    $('#animationclass').val('animation-waves-yellow');
});

$('.thumb-wallpaper1').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen wallpaper1');
    $('#wallpaperclass').val('wallpaper1');
});
$('.thumb-wallpaper2').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen wallpaper2');
    $('#wallpaperclass').val('wallpaper2');
});
$('.thumb-wallpaper3').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen wallpaper3');
    $('#wallpaperclass').val('wallpaper3');
});
$('.thumb-wallpaper4').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen wallpaper4');
    $('#wallpaperclass').val('wallpaper4');
});
$('.thumb-wallpaper5').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen wallpaper5');
    $('#wallpaperclass').val('wallpaper5');
});
$('.thumb-wallpaper6').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen wallpaper6');
    $('#wallpaperclass').val('wallpaper6');
});
$('.thumb-wallpaper7').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen wallpaper7');
    $('#wallpaperclass').val('wallpaper7');
});
$('.thumb-wallpaper8').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen wallpaper8');
    $('#wallpaperclass').val('wallpaper8');
});
$('.thumb-wallpaper9').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen wallpaper9');
    $('#wallpaperclass').val('wallpaper9');
});
$('.thumb-wallpaper10').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen wallpaper10');
    $('#wallpaperclass').val('wallpaper10');
});
$('.thumb-wallpaper11').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen wallpaper11');
    $('#wallpaperclass').val('wallpaper11');
});
$('.thumb-wallpaper12').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen wallpaper12');
    $('#wallpaperclass').val('wallpaper12');
});
$('.thumb-wallpaper13').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen wallpaper13');
    $('#wallpaperclass').val('wallpaper13');
});
$('.thumb-wallpaper14').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen wallpaper14');
    $('#wallpaperclass').val('wallpaper14');
});
$('.thumb-wallpaper15').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen wallpaper15');
    $('#wallpaperclass').val('wallpaper15');
});
$('.thumb-wallpaper16').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen wallpaper16');
    $('#wallpaperclass').val('wallpaper16');
});
$('.thumb-wallpaper17').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen wallpaper17');
    $('#wallpaperclass').val('wallpaper17');
});
$('.thumb-wallpaper18').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen wallpaper18');
    $('#wallpaperclass').val('wallpaper18');
});
$('.thumb-wallpaper19').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen wallpaper19');
    $('#wallpaperclass').val('wallpaper19');
});
$('.thumb-wallpaper20').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen wallpaper20');
    $('#wallpaperclass').val('wallpaper20');
});
$('.thumb-wallpaper21').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen wallpaper21');
    $('#wallpaperclass').val('wallpaper21');
});

$('.theme1').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient1');
    $('#backtheme').val('colorgradient1');
});
$('.theme2').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient2');
    $('#backtheme').val('colorgradient2');
});
$('.theme3').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient3');
    $('#backtheme').val('colorgradient3');
});
$('.theme4').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient4');
    $('#backtheme').val('colorgradient4');
});
$('.theme5').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient5');
    $('#backtheme').val('colorgradient5');
});
$('.theme6').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient6');
    $('#backtheme').val('colorgradient6');
});
$('.theme7').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient7');
    $('#backtheme').val('colorgradient7');
});
$('.theme8').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient8');
    $('#backtheme').val('colorgradient8');
});
$('.theme9').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient9');
    $('#backtheme').val('colorgradient9');
});
$('.theme10').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient10');
    $('#backtheme').val('colorgradient10');
});
$('.theme11').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient11');
    $('#backtheme').val('colorgradient11');
});
$('.theme12').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient12');
    $('#backtheme').val('colorgradient12');
});
$('.theme13').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient13');
    $('#backtheme').val('colorgradient13');
});
$('.theme14').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient14');
    $('#backtheme').val('colorgradient14');
});
$('.theme15').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient15');
    $('#backtheme').val('colorgradient15');
});
$('.theme16').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient16');
    $('#backtheme').val('colorgradient16');
});
$('.theme17').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient17');
    $('#backtheme').val('colorgradient17');
});
$('.theme18').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient18');
    $('#backtheme').val('colorgradient18');
});
$('.theme19').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient19');
    $('#backtheme').val('colorgradient19');
});
$('.theme20').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient20');
    $('#backtheme').val('colorgradient20');
});
$('.theme21').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient21');
    $('#backtheme').val('colorgradient21');
});
$('.theme22').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient22');
    $('#backtheme').val('colorgradient22');
});
$('.theme23').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient23');
    $('#backtheme').val('colorgradient23');
});
$('.theme24').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient24');
    $('#backtheme').val('colorgradient24');
});
$('.theme25').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient25');
    $('#backtheme').val('colorgradient25');
});
$('.theme26').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient26');
    $('#backtheme').val('colorgradient26');
});
$('.theme27').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient27');
    $('#backtheme').val('colorgradient27');
});
$('.theme28').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient28');
    $('#backtheme').val('colorgradient28');
});
$('.theme29').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient29');
    $('#backtheme').val('colorgradient29');
});
$('.theme30').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient30');
    $('#backtheme').val('colorgradient30');
});
$('.theme31').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient31');
    $('#backtheme').val('colorgradient31');
});
$('.theme32').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient32');
    $('#backtheme').val('colorgradient32');
});
$('.theme33').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient33');
    $('#backtheme').val('colorgradient33');
});
$('.theme34').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient34');
    $('#backtheme').val('colorgradient34');
});
$('.theme35').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient35');
    $('#backtheme').val('colorgradient35');
});
$('.theme36').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient36');
    $('#backtheme').val('colorgradient36');
});
$('.theme37').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient37');
    $('#backtheme').val('colorgradient37');
});
$('.theme38').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient38');
    $('#backtheme').val('colorgradient38');
});
$('.theme39').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient39');
    $('#backtheme').val('colorgradient39');
});
$('.theme40').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient40');
    $('#backtheme').val('colorgradient40');
});
$('.theme41').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient41');
    $('#backtheme').val('colorgradient41');
});
$('.theme42').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient42');
    $('#backtheme').val('colorgradient42');
});
$('.theme43').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient43');
    $('#backtheme').val('colorgradient43');
});
$('.theme44').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient44');
    $('#backtheme').val('colorgradient44');
});
$('.theme45').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient45');
    $('#backtheme').val('colorgradient45');
});
$('.theme46').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient46');
    $('#backtheme').val('colorgradient46');
});
$('.theme47').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient47');
    $('#backtheme').val('colorgradient47');
});
$('.theme48').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient48');
    $('#backtheme').val('colorgradient48');
});
$('.theme49').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient49');
    $('#backtheme').val('colorgradient49');
});
$('.theme50').click(function () {
    $('#phonecolor').removeAttr("class");
    $('#phonecolor').addClass('screen colorgradient50');
    $('#backtheme').val('colorgradient50');
});