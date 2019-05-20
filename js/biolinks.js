var arra = 0;
var elmhtml, counterLink = 1;

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

    changeLength();
    changeLengthMedia();
    /*if ($('.wa-input').val()!='') {
      $('#wa').show();
      $('#waviewid').addClass('shown-mes').show();
        changeLength();
    }*/
    if ($('.telegram-input').val()!='') {
      $('#telegram').show();
      $('#telegramviewid').addClass('shown-mes').show();
        changeLength();
    }
    if ($('.skype-input').val()!='') {
      $('#skype').show();
      $('#skypeviewid').addClass('shown-mes').show();
        changeLength();
    }
    if ($('.youtube-input').val()!='') {
      $('#youtube').show();
      $('#youtubeviewid').addClass('shown-sm').show();
      changeLengthMedia();
    }
    if ($('.twitter-input').val()!='') {
      $('#twitter').show();
      $('#twitterviewid').addClass('shown-sm').show();
      changeLengthMedia();
    }
    if ($('.fb-input').val()!='') {
      $('#fb').show();
      $('#facebookviewid').addClass('shown-sm').show();
      changeLengthMedia();
    }
    if ($('.ig-input').val()!='') {
      $('#ig').show();
      $('#instagramviewid').addClass('shown-sm').show();
      changeLengthMedia();
    }
    $(document).on('click', '#tambah', function (e) {
        $('.messengers').each(function () {
            if ($(this).hasClass('hide')) {
                // console.log('remove hidden');
                $(this).show();
                $(this).removeClass('hide');
                $(this).parent().attr("id", "msg-" + $(this).attr('data-type'));
                return false;
            }
        });
        $('.link').each(function () {
            if ($(this).hasClass('hidden')) {
                $(this).show();
                $(this).removeClass('hidden');
                $(this).addClass('shown-mes');
                return false;
            }
        });
        changeLength();
    });

    $('#deletewa').on('click', function () {
        $('#wa').hide();
        $('#wa').addClass('hidden');
        $('#wa').find("input").val('');
        $('#waviewid').hide();
        $('#waviewid').addClass('hidden');
        $('#waviewid').removeClass('shown-mes');
        changeLength();
        return false;
    });

    $('#deletetelegram').on('click', function () {
        $('#telegram').hide();
        $('#telegram').addClass('hidden');
        $('#telegram').find("input").val('');
        $('#telegramviewid').hide();
        $('#telegramviewid').addClass('hidden');
        $('#telegramviewid').removeClass('shown-mes');
        changeLength();
        return false;
    });

    $('#deleteskype').on('click', function () {
        $('#skype').hide();
        $('#skype').addClass('hidden');
        $('#skype').find("input").val('');
        $('#skypeviewid').hide();
        $('#skypeviewid').addClass('hidden');
        $('#skypeviewid').removeClass('shown-mes');
        changeLength();
        return false;
    });

    /* biolink link */
    $(document).on('click', '#addlink', function (e) {
        var $el;
        counterLink += 1;
        $('.sortable-link').append('<li class="link-list" id="link-url-' + counterLink + '"><div class="div-table mb-4"><div class="div-cell"><span class="handle"><i class="fas fa-bars"></i></span></div><div class="div-cell"><div class="col-md-12 col-12 pr-0 pl-0"><div class="input-stack"><input type="hidden" name="idlink[]" value="new"><input type="text" name="title[]" value="" id="title-' + counterLink + '-view" placeholder="Title" class="form-control focuslink"><input type="text" name="url[]" value="" placeholder="http://url..." class="form-control"></div></div></div><div class="div-cell cell-btn deletelink"><span><i class="far fa-trash-alt"></i></span></div></div></li>');

        // $("#viewLink").append(' <button type="button" class="btn btn-light btnview title-' + counterLink + '-view-get" id="link-url-' + counterLink + '-preview" style="width: 100%; margin-bottom: 12px;">Masukkan Link</button>');
        $("#viewLink").append('<li class=""><a href="" class="btn btn-md btnview title-' + counterLink + '-view-get txthov" id="link-url-' + counterLink + '-preview" style="width: 100%; margin-bottom: 12px;">Masukkan Link</a></li>');
    });
    $(document).on('click', '.deletelink', function (e) {
      //let idLink = $(this).parent().parent().attr("link-id");
      var idLink = $(this).parent().parent().attr("id");
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
    });

    /* biolink social-media */
    $(document).on('click', '#sm', function (e) {
        $('.socialmedia').each(function () {
            if ($(this).hasClass('hidden')) {
                $(this).show();
                $(this).removeClass('hidden');
                $(this).parent().attr("id", "sosmed-" + $(this).attr('data-type'));
                return false;
            }
        });
         $('.linked').each(function () {
            if ($(this).hasClass('hiddensm')) {
                $(this).show();
                $(this).removeClass('hiddensm');
                $(this).addClass('shown-sm');
                return false;
            }
        });
        changeLengthMedia();
    });

    $('#deleteyoutube').on('click', function () {
        $('#youtube').hide();
        $('#youtube').addClass('hidden');
        $('#youtube').find("input").val('');
        $('#youtubeviewid').hide();
        $('#youtubeviewid').addClass('hiddensm');
        $('#youtubeviewid').removeClass('shown-sm');
        changeLengthMedia();
        return false;
    });
    $('#deleteig').on('click', function (e) {
        $('#ig').hide();
        $('#ig').addClass('hidden');
        $('#ig').find("input").val('');
        $('#instagramviewid').hide();
        $('#instagramviewid').addClass('hiddensm');
        $('#instagramviewid').removeClass('shown-sm');
        changeLengthMedia();
        return false;
    });
    $('#deletefb').on('click', function (e) {
        $('#fb').hide();
        $('#fb').addClass('hidden');
        $('#fb').find("input").val('');
        $('#facebookviewid').hide();
        $('#facebookviewid').addClass('hiddensm');
        $('#facebookviewid').removeClass('shown-sm');
        changeLengthMedia();
        return false;
    });
    $('#deletetwitter').on('click', function (e) {
        $('#twitter').hide();
        $('#twitter').addClass('hidden');
        $('#twitter').find("input").val('');
        $('#twitterviewid').hide();
        $('#twitterviewid').addClass('hiddensm');
        $('#twitterviewid').removeClass('shown-sm');
        changeLengthMedia();
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
}

//
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