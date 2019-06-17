@extends('layouts.app')

@section('content')
<?php use App\Helpers\Helper; ?>
<link rel="stylesheet" href="{{asset('css/dash.css')}}">
<link rel="stylesheet" href="{{asset('css/farbtastic.css')}}">
<link rel="stylesheet" href="{{asset('css/theme.css')}}">

<style type="text/css">
  @media screen and (max-width: 768px) {
    .menu-nomobile{
      display: none;
    }

    .menu-mobile {
      display: block;
    }
  }
</style>

<script type="text/javascript">
  var picker;
  var color_picker,rounded,outline;
  // https://www.shift8web.ca/2017/01/use-jquery-sort-reorganize-content/
  function sortMeBy(arg, sel, elem, order) {
    var $selector = $(sel),
    $element = $selector.children(elem);
    $element.sort(function(a, b) {
            var an = parseInt(a.getAttribute(arg)),
            bn = parseInt(b.getAttribute(arg));
            if (order == "asc") {
                    if (an > bn)
                    return 1;
                    if (an < bn)
                    return -1;
            } else if (order == "desc") {
                    if (an < bn)
                    return 1;
                    if (an > bn)
                    return -1;
            }
            return 0;
    });
    $element.detach().appendTo($selector);
  }
  
  function tambahTemp() {
    var form = $('#saveTemplate')[0];
    var formData = new FormData(form);
    $.ajax({
      type: 'POST',
      dataType: 'json',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      url: "<?php echo url('/save-template');?>",
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(data) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        //var data=jQuery.parseJSON(result);
        $("#pesanAlert").html(data.message);
        $("#pesanAlert").show();
        $(window).scrollTop(0);
        if (data.status == "success") {
          $("#pesanAlert").addClass("alert-success");
          $("#pesanAlert").removeClass("alert-danger");
        }
        if (data.status == "error") {
          $("#pesanAlert").addClass("alert-danger");
          $("#pesanAlert").removeClass("alert-success");
        }
      }
    });
  }

  function tambahPages() {
    $.ajax({
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType: 'text',
      data: $("#savelink").serialize() + '&' + $('.sortable-msg').sortable('serialize') + '&' + $('.sortable-link').sortable('serialize') + '&' + $('.sortable-sosmed').sortable('serialize'),
      url: "<?php echo url('/save-link');?>",
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        $(window).scrollTop(0);
        var data = jQuery.parseJSON(result);
        $("#pesanAlert").html(data.message);
        $("#pesanAlert").show();
        if (data.status == "success") {
          $("#pesanAlert").addClass("alert-success");
          $("#pesanAlert").removeClass("alert-danger");
          refreshwa();
          refreshpixel();
          return true;
        }
        if (data.status == "error") {
          $("#pesanAlert").addClass("alert-danger");
          $("#pesanAlert").removeClass("alert-success");
          return false;
        }
      }
    });
  }

  function tambahpixel() {
    $.ajax({
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "<?php echo url ('/save-pixel')?>",
      dataType: 'text',
      data: $("#savepixel").serialize(),
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        $('#script').val("");
        $('#judul').val("");
        $('#editidpixel').val("");
        $(window).scrollTop(0);
        refreshpixel();
        loadPixelPage();
        tambahBanner();
      },
    });
  }

  function tambahBanner() {
    $.ajax({
      type: 'GET',
      dataType: 'text',
      url: "<?php echo url('/banner/load-banner') ;?>",
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        var data = jQuery.parseJSON(result);
        $('.contentBanner').append(data.view);
      }
    });
  }

  function refreshpixel() {
    //console.log($('#idpage').val());
    $.ajax({
      type: 'GET',
      data: {
        idpage: $('#idpage').val(),
      },
      url: "<?php echo url('/pixel/load-pixel'); ?>",
      dataType: 'text',
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        var data = jQuery.parseJSON(result);
        $('#content').html(data.view);
        //$('.pixellink').html(data.pixelink);
      }
    });
  }

  function delete_pixel(idpixel) {
    $.ajax({
      type: 'GET',
      data: {
        idpixel: idpixel,
      },
      url: "<?php echo url ('/pixel/deletepixel'); ?>",
      dataType: 'text',
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        var data = jQuery.parseJSON(result);
        if (data.status == 'success') {
          refreshpixel();
        }
      }
    });
  }

  function loadPixel(id,selector){
    var view =''
    $.ajax({
      type: 'GET',
      url: "<?php echo url('/load/pixelpage');?>",
      data: { id:id },
      dataType: 'text',
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        var data = jQuery.parseJSON(result);
        $(selector).html(data.view);
      }
    });
  }

  function loadPixelPage() {
    loadPixel('{{$pages->wa_pixel_id}}','#wapixel');
    loadPixel('{{$pages->telegram_pixel_id}}','#telegrampixel');
    loadPixel('{{$pages->skype_pixel_id}}','#skypepixel');
    loadPixel('{{$pages->line_pixel_id}}','#linepixel');
    loadPixel('{{$pages->messenger_pixel_id}}','#messengerpixel');
    
    loadPixel('{{$pages->youtube_pixel_id}}','#youtubepixel');
    loadPixel('{{$pages->fb_pixel_id}}','#fbpixel');
    loadPixel('{{$pages->ig_pixel_id}}','#igpixel');
    loadPixel('{{$pages->twitter_pixel_id}}','#twitterpixel');
    
    //loadPixel(0,'.bannerpixel');
  }

  function tambahwalink() {
    $.ajax({
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: $("#savewalink").serialize(),
      url: "<?php echo url('/save-walink');?>",
      dataType: 'text',
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        $('#nomorwa').val("");
        $('#pesan-wa').val("");
        $(window).scrollTop(0);
        ///$('#demo').val("");
        refreshwa();
      }
    });
  }

  function refreshwa() {
    $.ajax({
      type: 'GET',
      url: "<?php echo url('/walink/loadwalink');?>",
      dataType: 'text',
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        var data = jQuery.parseJSON(result);
        $('#contentwa').html(data.viewer);
      }
    });
  }

  function deletewalink(idwalink) {
    $.ajax({
      type: 'GET',
      data: {
        idwalink: idwalink,
      },
      url: "<?php echo url('/walink/deletewalink');?>",
      dataType: 'text',
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        var data = jQuery.parseJSON(result);
        if (data.status == 'success') {
          refreshwa();
        }
      }
    });
  }

  
  function plusSlides(n) {
    showSlides(slideIndex += n );
  }

  function currentSlide(n) {
    showSlides(slideIndex = n);
  }

  function showSlides(n) {
    console.log(n);
    console.log($(".mySlides").length);
    var i;
    // let slides = document.getElementsByClassName("mySlides");
    // let slides = document.getElementsByClassName("mySlides");
    var dots = $(".dot");
    var slides = $(".mySlides");
    if (n > slides.length) {// need to be fix
      slideIndex = 1;
    }    
    if (n < 1) {
      slideIndex = slides.length;
    }
    for (i = 0; i < slides.length; i++) 
    {
      slides[i].style.display = "none";
      //slides[i].value='hid';
    }
    for (i = 0; i < dots.length; i++) 
    {
      dots[i].className = dots[i].className.replace("activated","");
    }
    if (slides.length>0) {
      slides[slideIndex-1].style.display = "block";
    }
    if (dots.length>0) {
      dots[n].className +=" activated";
    }
  }
  
  function dotsok()
  {
    let i,a=0,dotselement,slidesid;
    dotselement=$('#dot-view');
    slidesid=$('.mySlides');
    for (i = 0; i < slidesid.length ; i++) 
    {
      a+=1;
      dotselement.append('<span class="dot picture-id-'+a+'-dot input-picture-'+a+'-dot" id="input-picture-'+a+'-dot" onclick="currentSlide('+i+')"></span>');
    }
     if ($(".dot").length==1) {
      $(".dot").parent().hide();
      $('.prev').hide();
      $('.next').hide();
    }
  }

  function check_outlined(){
    if ($('.outlined').prop("checked") == true) {
      //$(".mobile1").addClass("outlinedview");
      $(".screen").addClass("outlinedview");
      $('.outlined').val(1);
      
      $('.btnview').css("background-color","transparent");
      $('.btnview').css("color",$("#colorOutlineButton").val());
    } else if ($('.outlined').prop("checked") == false) {
      //$(".mobile1").removeClass("outlinedview");
      $(".screen").removeClass("outlinedview");
      $('.outlined').val(0);
      
      $('.btnview').css("background-color",$("#colorOutlineButton").val());
      $('.btnview').css("color","#fff");
    }
  }

  function check_rounded(){
    if ($('.rounded').prop("checked") == true) {
      //$(".mobile1").addClass("roundedview");
      $(".screen").addClass("roundedview");
      $('.rounded').val(1);
    } else if ($('.rounded').prop("checked") == false) {
      //$(".mobile1").removeClass("roundedview");
      $(".screen").removeClass("roundedview");
      $('.rounded').val(0);
    }
  }

  function delete_photo(){
    $.ajax({
      type : 'get',
      url : "<?php echo url('/delete-photo') ?>",
      dataType: 'text',
      data : {
        id: "<?php echo $uuid; ?>",
      },
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        var data = jQuery.parseJSON(result);
        
        $('#pesanAlert').html(data.message);
        $('#pesanAlert').show();
        if(data.status=='success'){
          $('#pesanAlert').removeClass('alert-warning');
          $('#pesanAlert').addClass('alert-success');
          
          //
          $('#wizardPicturePreview').attr('src', "<?php echo asset('image/no-photo.jpg'); ?>").fadeIn('slow');
          // $('#viewpicture').attr('src', "<?php echo asset('image/no-photo.jpg'); ?>").fadeIn('slow');
          $('#viewpicture').attr('src', "").fadeIn('slow');
          
          $("#wizardPicturePreview-delete").hide();
        } else {
          $('#pesanAlert').removeClass('alert-success');
          $('#pesanAlert').addClass('alert-warning');
        }
      }
    });  
  }

</script>

<section id="tabs" class="col-md-10 offset-md-1 col-12 pl-0 pr-0 project-tab">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4 style="color: #106BC8">
          <i class="fas fa-arrow-left"></i>&nbsp;
          <a class="back-link" href="{{url('/')}}">
            KEMBALI
          </a>
        </h4>
        <br>

        <!--@if(Auth::user()->membership=='free')
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <button type="button" class="close" aria-label="Close" data-dismiss="alert">
              <span aria-hidden="true">×</span>
            </button>
            <?php  
              $time = Helper::get_trial_time();
              echo $time;
            ?>
            
            <a class="back-link" href="{{url('pricing')}}">
              Subscribe
            </a>
            untuk terus menggunakan Omnilinkz
          </div>
        @endif-->
      </div>

      <div class="offset-lg-0 col-lg-7 offset-md-1 col-md-10">
        
        <div id="pesanAlert" class="alert"></div>

        <div class="card carddash" style="margin-bottom:20px;">
          <div class="card-body">
            <ul class="mb-4 nav nav-tabs">
              <li class="nav-item">
                <a href="#link" class="nav-link link" role="tab" data-toggle="tab">
                  Link
                </a>
              </li>

              <li class="nav-item">
                <a href="#walink" class="nav-link link" role="tab" data-toggle="tab">
                  WA Link Creator
                </a>
              </li>

              <li class="nav-item">
                <a href="#pixel" class="nav-link link" role="tab" data-toggle="tab">
                  Pixel
                </a>
              </li>
              
              <li class="nav-item">
                <a href="#style" class="active nav-link link" role="tab" data-toggle="tab">
                  Tampilan
                </a>
              </li>
            </ul>

            <div class="tab-content">

              <!-- tab 1-->
              <div role="tabpanel" class="tab-pane fade in " id="link">
                <form method="post" id="savelink" action="{{url('save-link')}}" novalidate>
                  {{ csrf_field() }}

                  <!--messengers!-->
                  <input type="hidden" name="uuid" value="{{$uuid}}">

                  <label class="mb-3 blue-txt">
                    Messenger
                  </label>
                  <button type="button" class="float-right btn btn-primary btn-sm" id="tambah">
                    <i class="fas fa-plus"></i>
                  </button>

                  <div class="hid mb-5">
                    <ul class="sortable-msg">
                      <li id="msg-li-wa"> <!-- wa -->
                        <div id="wa" class="messengers div-table hide" style="display:none;">
                          <div class="div-cell">
                            <span class="handle">
                              <i class="fas fa-bars"></i>
                            </span>
                          </div>

                          <div class="div-cell">
                            <div class="col-md-12 col-12 pr-0 pl-0">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <i class="fab fa-whatsapp"></i>
                                  </div>
                                </div>
                                <input type="text" name="wa" class="form-control wa-input" value="{{$pages->wa_link}}" id="inlineFormInputGroupUsername" onkeypress="return hanyaAngka(event)" placeholder="Masukkan nomor WhatsApp">
                                <input type="hidden" name="sortmsg[]" value="" data-val="wa" class="input-hidden">
                              </div>
                            </div>

                            <div class="col-md-12 col-12 pr-0 pl-0">
                              <select name="wapixel" class="form-control" id="wapixel"></select>
                            </div>
                          </div>

                          <div class="div-cell cell-btn" id="deletewa">
                            <span>
                              <i class="far fa-trash-alt"></i>
                            </span>
                          </div>
                        </div>
                      </li>

                      <li id="msg-li-telegram"> <!-- telegram -->
                        <div id="telegram" class="messengers div-table hide" style="display:none;">
                          <div class="div-cell">
                            <span class="handle">
                              <i class="fas fa-bars"></i>
                            </span>
                          </div>

                          <div class="div-cell">
                            <div class="col-md-12 col-12 pr-0 pl-0">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <i class="fab fa-telegram-plane"></i>
                                  </div>
                                </div>
                                <input type="text" name="telegram" class="form-control telegram-input" id="inlineFormInputGroupUsername" value="{{$pages->telegram_link}}" placeholder="Masukkan username Telegram">
                                <input type="hidden" name="sortmsg[]" value="" data-val="telegram" class="input-hidden">
                              </div>

                              <div class="col-md-12 col-12 pr-0 pl-0">
                                <select name="telegrampixel" id="telegrampixel" class="form-control"></select>
                              </div>
                            </div>
                          </div>

                          <div class="div-cell cell-btn" id="deletetelegram">
                            <span>
                              <i class="far fa-trash-alt"></i>
                            </span>
                          </div>
                        </div>
                      </li>

                      <li id="msg-li-skype"> <!-- skype -->
                        <div id="skype" class="messengers div-table hide" style="display:none;">
                          <div class="div-cell">
                            <span class="handle">
                              <i class="fas fa-bars"></i>
                            </span>
                          </div>

                          <div class="div-cell">
                            <div class="col-md-12 col-12 pr-0 pl-0">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <i class="fab fa-skype"></i>
                                  </div>
                                </div>
                                <input type="text" name="skype" class="form-control skype-input" id="inlineFormInputGroupUsername" value="{{$pages->skype_link}}" placeholder="Masukkan username Skype">
                                <input type="hidden" name="sortmsg[]" value="" data-val="skype" class="input-hidden">
                              </div>
                            </div>

                            <div class="col-md-12 col-12 pr-0 pl-0">
                              <select name="skypepixel" class="form-control" id="skypepixel"></select>
                            </div>
                          </div>

                          <div class="div-cell cell-btn" id="deleteskype">
                            <span>
                              <i class="far fa-trash-alt"></i>
                            </span> 
                          </div>
                        </div>
                      </li>

                      <li id="msg-li-line"> <!-- line -->
                        <div id="line" class="messengers div-table hide" style="display:none;">
                          <div class="div-cell">
                            <span class="handle">
                              <i class="fas fa-bars"></i>
                            </span>
                          </div>

                          <div class="div-cell">
                            <div class="col-md-12 col-12 pr-0 pl-0">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <i class="fab fa-line"></i>
                                  </div>
                                </div>
                                <input type="text" name="line" class="form-control line-input" value="{{$pages->line_link}}" id="inlineFormInputGroupUsername" placeholder="Masukkan username Line">
                                <input type="hidden" name="sortmsg[]" value="" data-val="line" class="input-hidden">
                              </div>
                            </div>

                            <div class="col-md-12 col-12 pr-0 pl-0">
                              <select name="linepixel" class="form-control" id="linepixel"></select>
                            </div>
                          </div>

                          <div class="div-cell cell-btn" id="deleteline">
                            <span>
                              <i class="far fa-trash-alt"></i>
                            </span>
                          </div>
                        </div>
                      </li>

                      <li id="msg-li-messenger"> <!-- messenger -->
                        <div id="messenger" class="messengers div-table hide" style="display:none;">
                          <div class="div-cell">
                            <span class="handle">
                              <i class="fas fa-bars"></i>
                            </span>
                          </div>

                          <div class="div-cell">
                            <div class="col-md-12 col-12 pr-0 pl-0">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <i class="fab fa-facebook-messenger"></i>
                                  </div>
                                </div>
                                <input type="text" name="messenger" class="form-control messenger-input" value="{{$pages->messenger_link}}" id="inlineFormInputGroupUsername" placeholder="Masukkan username Messenger">
                                <input type="hidden" name="sortmsg[]" value="" data-val="messenger" class="input-hidden">
                              </div>
                            </div>

                            <div class="col-md-12 col-12 pr-0 pl-0">
                              <select name="messengerpixel" class="form-control" id="messengerpixel"></select>
                            </div>
                          </div>

                          <div class="div-cell cell-btn" id="deletemessenger">
                            <span>
                              <i class="far fa-trash-alt"></i>
                            </span>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>

                  <!--Links-->
                  <label class="mb-3 blue-txt">
                    Link
                  </label>
                  <button type="button" class="float-right btn btn-primary btn-sm" id="addlink">
                    <i class="fas fa-plus"></i>
                  </button>
                  <br>

                  <div class="mb-5">
                    <ul class="sortable-link a">
                      <?php 
                      if($links->count()) {
                        foreach($links as $link) {
                      ?>
                          <li class="link-list" id="link-url-update-{{$link->id}}">
                            <div class="div-table mb-4">
                              <div class="div-cell">
                                <span class="handle">
                                  <i class="fas fa-bars"></i>
                                </span>
                              </div>

                              <div class="div-cell">
                                <div class="col-md-12 col-12 pr-0 pl-0">
                                  <div class="input-stack">
                                    <input type="hidden" name="idlink[]" value="{{$link->id}}">
                                    <input class="delete-link" type="hidden" name="deletelink[]" value="">
                                    <input type="text" name="title[]" value="{{$link->title}}" id="title-{{$link->id}}-view-update" placeholder="Title" class="form-control focuslink-update">
                                    <input type="text" name="url[]" value="{{$link->link}}" placeholder="http://url..." class="form-control">
                                  </div>
                                </div>
                              </div>
                              
                              <div class="div-cell cell-btn deletelink-update">
                                <span>
                                  <i class="far fa-trash-alt"></i>
                                </span>
                              </div>
                            </div>
                          </li>
                      <?php 
                        }
                      }
                      else {
                      ?>

                        <li class="link-list" id="link-url-1">
                          <div class="div-table mb-4">
                            <div class="div-cell">
                              <span class="handle">
                                <i class="fas fa-bars"></i>
                              </span>
                            </div>

                            <div class="div-cell">
                              <div class="col-md-12 col-12 pr-0 pl-0">
                                <div class="input-stack">
                                  <input type="hidden" name="idlink[]" value="new">
                                  <input type="hidden" name="deletelink[]" value="">
                                  <input type="text" name="title[]" value="" id="title-1-view" placeholder="Title" class="form-control focuslink">
                                  <input type="text" name="url[]" value="" placeholder="http://url..." class="form-control">
                                </div>
                              </div>
                            </div>
                            
                            <div class="div-cell cell-btn deletelink">
                              <span>
                                <i class="far fa-trash-alt"></i>
                              </span>
                            </div>

                          </div>
                        </li>
                      <?php } ?>
                    </ul>
                  </div>

                  <!--social media-->
                  <label class="mb-3 blue-txt">
                    Media Sosial
                  </label>
                  <button type="button" class="float-right btn btn-primary btn-sm" id="sm">
                    <i class="fas fa-plus"></i>
                  </button>

                  <ul class="sortable-sosmed">
                    <li id="sosmed-youtube">
                      <div id="youtube" class="socialmedia div-table mb-4 hide">
                        <input type="hidden" name="sortsosmed[]" value="" data-val="youtube" class="input-hidden">
      
                        <div class="div-cell">
                          <span class="handle">
                            <i class="fas fa-bars"></i>
                          </span>
                        </div>

                        <div class="div-cell">
                          <div class="col-md-12 col-12 pr-0 pl-0">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <i class="fab fa-youtube"></i>
                                </div>
                              </div>
                              <input type="text" name="youtube" class="form-control youtube-input" id="inlineFormInputGroupUsername" placeholder="masukkan channel youtube url" value="{{$pages->youtube_link}}">
                            </div>
                          </div> 
                          <div class="col-md-12 col-12 pr-0 pl-0">
                            <select name="youtubepixel" id="youtubepixel" class="form-control">
                            </select>
                          </div> 
                        </div>
                          
                        <div class="div-cell cell-btn" id="deleteyoutube">
                          <span>
                            <i class="far fa-trash-alt"></i>
                          </span>
                        </div>
                      </div>                      
                    </li>

                    <li id="sosmed-fb">
                      <div id="fb" class="socialmedia div-table hide" data-type="fb" style="display:none;">
                        <input type="hidden" name="sortsosmed[]" value="" data-val="fb" class="input-hidden">
                        <div class="div-cell">
                          <span class="handle">
                            <i class="fas fa-bars"></i>
                          </span>
                        </div>

                        <div class="div-cell">
                          <div class="col-md-12 col-12 pr-0 pl-0">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <i class="fab fa-facebook-f"></i>
                                </div>
                              </div>
                              <input type="text" name="fb" class="form-control fb-input" value="{{$pages->fb_link}}" id="inlineFormInputGroupUsername" placeholder="masukkan username facebook">
                            </div>

                            <div class="col-md-12 col-12 pr-0 pl-0">
                              <select name="fbpixel" id="fbpixel" class="form-control"></select>
                            </div>
                          </div>
                        </div>
                        
                        <div class="div-cell cell-btn" id="deletefb">
                          <span>
                            <i class="far fa-trash-alt"></i>  
                          </span>
                        </div>
                      </div>
                    </li>

                    <li id="sosmed-twitter">
                      <div id="twitter" class="socialmedia div-table hide" data-type="twitter" style="display:none;">
                        <input type="hidden" name="sortsosmed[]" value="" data-val="twitter" class="input-hidden">
                        <div class="div-cell">
                          <span class="handle">
                            <i class="fas fa-bars"></i>
                          </span>
                        </div>

                        <div class="div-cell">
                          <div class="col-md-12 col-12 pr-0 pl-0">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <i class="fab fa-twitter"></i>
                                </div>
                              </div>
                              <input type="text" name="twitter" class="form-control twitter-input" id="inlineFormInputGroupUsername" placeholder="masukkan username twitter" value="{{$pages->twitter_link}}">
                            </div>
                          </div>
                          <div class="col-md-12 col-12 pr-0 pl-0">
                            <select name="twitterpixel" id="twitterpixel" class="form-control">
                            </select>
                          </div>
                        </div>
                          
                        <div class="div-cell cell-btn" id="deletetwitter">
                          <span>
                            <i class="far fa-trash-alt"></i>
                          </span>
                        </div>
                      </div>
                    </li>

                    <li id="sosmed-ig">
                      <div id="ig" class="socialmedia div-table hide" data-type="ig" style="display:none;">
                        <input type="hidden" name="sortsosmed[]" value="" data-val="ig" class="input-hidden">
                        <div class="div-cell">
                          <span class="handle">
                            <i class="fas fa-bars"></i>
                          </span>
                        </div>

                        <div class="div-cell">
                          <div class="col-md-12 col-12 pr-0 pl-0">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <i class="fab fa-instagram"></i>
                                </div>
                              </div>
                              <input type="text" name="ig" class="form-control ig-input" value="{{$pages->ig_link}}" id="inlineFormInputGroupUsername" placeholder="masukkan username instagram">
                            </div>
                          </div>
                          <div class="col-md-12 col-12 pr-0 pl-0">
                            <select name="igpixel" id="igpixel" class="form-control">
                            </select>
                          </div>
                        </div>
                          
                        <div class="div-cell cell-btn" id="deleteig">
                          <span>
                            <i class="far fa-trash-alt"></i>
                          </span>
                        </div>
                      </div>
                    </li>
                  </ul>

                  <div class="as offset-md-8 col-md-4 pr-0 menu-nomobile">
                    <button type="button" id="btn-save-link" class="btn btn-primary btn-block btn-biolinks btn-save-link">
                      <!--<i class="far fa-save" style="margin-right:5px;"></i>-->
                      SAVE
                    </button>
                  </div>

                  <div class="menu-mobile">
                    <div class="row btn-mobile">
                      <div class="col-6 pl-0 pr-0">
                        <button type="button" class="btn btn-default btn-block btn-preview">
                          PREVIEW
                        </button>
                      </div>
                      <div class="col-6 pl-0 pr-0">
                        <button type="button" class="btn btn-primary btn-block btn-save-preview btn-save-link">
                          SAVE
                        </button>  
                      </div>
                    </div>  
                  </div>
                  
                </form>
              </div>
      @if((Auth::user()->membership=='basic') OR (Auth::user()->membership=='elite'))
              <!-- TAB 2 -->
              <div role="tabpanel" class="tab-pane fade " id="walink">
                <form id="savewalink" method="post" style="margin-bottom: 40px;margin-top: 40px;">
                  {{ csrf_field() }}
                  <input type="hidden" name="uuidpixel" value="{{$uuid}}">
                  <span class="blue-txt">
                    WhatsApp Link Creator
                  </span>
                  
                  <div class="form-group mt-3 mb-4 row">
                    <div class="col-md-5">
                      <label for="nomorwa" class="control-label">
                        Masukkan Nomor WA
                      </label>  
                    </div>
                    
                    <div class="col-md-5 col-9 pr-1">
                      <input type="text" name="nomorwa" id="nomorwa" class="form-control col-md-12" onkeypress="return hanyaAngka(event)">
                    </div>

                    <div class="col-md-2 col-3 pl-0 text-right">
                      <button type="reset" class="btn btn-danger btn-reset">
                        Reset
                      </button>
                    </div>
                  </div>

                  <div class="card">
                    <span class="card-header card-gray">
                      Masukkan Pesan
                    </span>
                    <textarea class="form-control" name="pesan" id="pesan-wa" style="height:100px"> </textarea>
                  </div>

                  <input type="text" name="editidwa" hidden="" id="editidwa">
                  <textarea id="demo" hidden="" name="textlink"></textarea>

       
                  <div class="offset-md-6 col-md-6 pl-0 pr-0 text-right">
                    <button type="button" class="btn btn-primary btn-block btn-biolinks" id="generate" style="margin-top: 20px;">
                      SAVE & CREATE LINK
                    </button>  
                  </div>  
                  
                  
                </form>

                <hr>

                <div class="margin" style="margin-top: 20px;">
                  <span class="blue-txt mb-4">
                    Recent WhatsApp Link Creator
                  </span>
                  <div class="accordion mt-3" id="accordionExample">
                    <div id="contentwa"></div>
                  </div>
                </div>
              </div>

              <!-- TAB 3 -->
              <div class="tab-pane fade" id="pixel">
                <form id="savepixel" method="post" style="margin-bottom: 40px;margin-top: 40px;">
                  {{ csrf_field() }}
                  <input type="hidden" name="uuidpixel" value="{{$uuid}}">
                  <input type="hidden" name="idpage" id="idpage" value="{{$pageid}}">
                  <span class="blue-txt">
                    Pixel Retargetting
                  </span>

                  <textarea class="form-control mt-3" name="script" id="script" style="height:100px"></textarea>

                  <div class="form-group mt-3 mb-4 row">
                    <div class="col-md-2">
                      <label class="control-label">
                        Jenis
                      </label>  
                    </div>
                    
                    <div class="col-md-6 col-12">
                      <select class="form-control col-md-12" name="jenis_pixel" id="jenis_pixel">
                        <option value="fb">
                          FB Pixel
                        </option>
                        <option value="twitter">
                          Twitter Retargetting
                        </option>
                        <option value="google">
                          Google Retargetting
                        </option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group mt-3 mb-4 row">
                    <div class="col-md-2">
                      <label class="control-label">
                        Title
                      </label>  
                    </div>
                    
                    <div class="col-md-6 col-12 mb-3">
                      <input type="text" class="form-control col-md-12" name="title" placeholder="Masukkan Judul" id="judul">
                      <input type="text" name="editidpixel" hidden id="editidpixel">
                    </div>

                    <div class="col-md-4 pl-md-0 pl-3 text-center">
                      <button type="button" id="btnpixel" class="btn btn-primary mr-2" style="width:45%">
                        Save
                      </button>
                      <button type="reset" class="btn btn-danger btn-reset" style="width:45%">
                        Reset
                      </button>
                    </div>
                  </div>

                </form>

                <hr>

                <span class="blue-txt">
                  Recent Pixel Retargetting
                </span>
                <div class="accordion mt-3" id="accordionExample">
                  <div id="content"></div>
                </div>
              </div>
              @endif
              <!-- TAB 4 -->
              <div role="tabpanel" class="tab-pane fade in active show" id="style">
                <form method="post" id="saveTemplate" enctype="multipart/form-data">

                  {{ csrf_field() }}
                  <input type="hidden" name="uuidtemp" value="{{$uuid}}">
                  <div class="form-group">
                    <div class="col-md-12">
                      <div class="row mt-5">
                        <div class="col-md-4 mb-3 picture-container">
                          <div class="picture">
                            <img src="<?php 
                            if(is_null($pages->image_pages)){
                              echo asset('image/no-photo.jpg');
                            } 
                            else {
                              echo Storage::disk('s3')->url($pages->image_pages);
                            }
                            ?>" class="picture-src img-responsive" id="wizardPicturePreview" title="" altSrc="{{asset('/image/no-photo.jpg')}}" onerror="this.src = $(this).attr('altSrc')">
                            <input type="file" name="imagepages" id="file-wizard-picture" class="" accept=".png, .jpg">
                          </div>
                          <i class="fa fa-trash" id="wizardPicturePreview-delete" aria-hidden="true"></i>
                        </div>
                        <div class="col-md-8">
                          @if(is_null($pages->page_title))
                          <input type="text" name="judul" id="pagetitle" value="" class="form-control" placeholder="Masukkan judul" style="margin-bottom: 5px">
                          @else
                          <input type="text" name="judul" id="pagetitle" value="{{$pages->page_title}}" class="form-control" placeholder="Masukkan judul" style="margin-bottom: 5px">
                          @endif
                          @if(is_null($pages->link_utama))
                          <input type="text" name="link" value="" id="pagelink" class="form-control" placeholder="masukkan link" style="margin-bottom: 5px">
                          @else
                          <input type="text" name="link" id="pagelink" value="{{$pages->link_utama}}" class="form-control" placeholder="masukkan link" style="margin-bottom: 5px">
                          @endif
                          @if(is_null($pages->telpon_utama))
                          <input type="number" name="phone_no" id="telpon" value="" class="form-control" placeholder="masukkan nomor" style="margin-bottom: 5px">
                          @else
                          <input type="number" name="phone_no" id="telpon" value="{{$pages->telpon_utama}}" class="form-control" placeholder="masukkan nomor" style="margin-bottom: 5px">
                          @endif
                        </div>
                        <div class="col-md-12 mt-4">
                       @if(Auth::user()->membership=='elite') 
                          <button type="button" class="float-right mb-3 btn btn-primary btn-sm" id="addBanner">
                            <i class="fas fa-plus"></i>
                          </button>
                      @endif
                       @if(Auth::user()->membership!='free')
                          <span class="blue-txt">
                            Banner Promo
                          </span>
                        @endif
                          <div class="contentBanner mb-5">
                            <div class="c div-banner">
                              @if($banner->count())
                              <?php $uc=0; ?>
                                @foreach($banner as $ban)
                                <?php $uc+=1; ?>
                                <div class="div-table list-banner mb-4" picture-id="picture-id-<?=$uc?>">
                                  <div class="div-cell">
                                    <input type="text" name="judulBanner[]" value="{{$ban->title}}" class="form-control" placeholder="Judul banner">
                                    <input type="hidden" name="idBanner[]" value="{{$ban->id}}">
                                    <input type="hidden" name="statusBanner[]" class="statusBanner" value="">
                                    <input type="text" name="linkBanner[]" value="{{$ban->link}}" class="form-control" placeholder="masukkan link">

                                    <select name="bannerpixel[]" class="form-control bannerpixel bannerpixel-{{$ban->id}}">
                                    </select>
                                    <script type="text/javascript">
                                      loadPixel('{{$ban->pixel_id}}','.bannerpixel-{{$ban->id}}');
                                    </script>
                                    <!--<input type="file" name="bannerImage[]" value="Upload">-->
                                    <div class="custom-file">
                                      <input type="file" name="bannerImage[]" class="custom-file-input pictureClass" id="input-picture-<?=$uc?>" aria-describedby="inputGroupFileAddon01">

                                      <label class="custom-file-label" for="inputGroupFile01">
                                        {{basename($ban->images_banner)}}
                                      </label>
                                    </div>
                                  </div>
                                @if(Auth::user()->membership=='elite')
                                  <div class="div-cell cell-btn btn-deleteBannerUpdate">
                                    <span>
                                      <i class="far fa-trash-alt"></i>
                                    </span>
                                  </div>
                                @endif  
                                </div>
                                @endforeach
                              @else
                     @if((Auth::user()->membership=='basic') OR (Auth::user()->membership=='elite'))
                                <div class="div-table list-banner mb-4" picture-id="picture-id-6">
                                  <div class="div-cell">
                                    <input type="text" name="judulBanner[]" value="" class="form-control" placeholder="Judul banner">
                                    <input type="hidden" name="idBanner[]" value="">
                                    <input type="hidden" name="statusBanner[]" class="statusBanner" value="">
                                    <input type="text" name="linkBanner[]" value="" class="form-control" placeholder="masukkan link">
                                    <select name="bannerpixel[]" class="form-control bannerpixel">
                                    </select>
                                    <!--<input type="file" name="bannerImage[]" value="Upload">-->
                                    <div class="custom-file">
                                      <input type="file" name="bannerImage[]" class="custom-file-input pictureClass" id="input-picture-6" aria-describedby="inputGroupFileAddon01">

                                      <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                  </div>
                          @endif
                         @if(Auth::user()->membership=='elite')
                                  <div class="div-cell cell-btn btn-deleteBanner">
                                    <span>
                                      <i class="far fa-trash-alt"></i>
                                    </span>
                                  </div>
                                @endif    
                                </div>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <input type="text" name="modeBackground" id="modeBackground" hidden="" readonly="true"  value="gradient">
                    <input type="text" name="backtheme" id="backtheme" hidden="" readonly="true"  value="colorgradient1">
                    <p class="blue-txt">
                      Theme
                    </p>
                    
                    <div class="row">
                      <div class="col-md-2 col-3">
                        <label class="switch">
                          <input type="checkbox" name="rounded" class="rounded" value="<?php if($pages->is_rounded) echo '1'; ?>" <?php if($pages->is_rounded) echo 'checked';?>>
                          <span class="slider round"></span>
                        </label>
                        
                      </div>
                      <div class="col-md-4 col-4">
                        <label class="caption">
                          Rounded buttons
                        </label>
                      </div>
                      <div class="col-md-4 col-4">
                        <a href="" id="link-custom-background-color" class="nav-link p-0">Custom Color</a>
                      </div>
                    </div>
                    <!-- Modal For Color Picker Button-->
                    <div class="modal fade" id="modal-color-picker-button" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  Choose Background Color For The Buttons
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-4 col-xs-4">
                                    <div align="center">
                                      <div id="colorpickerButton"></div>
                                      <input type="text" id="colorButton" name="colorButton" value="#123456">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn" >Close </button>
                              </div>
                          </div>
                      </div>
                    </div>	

                    <div class="row mb-5">
                      <div class="col-md-2 col-3">
                        <label class="switch">
                          <input type="checkbox" name="outlined" class="outlined" value="<?php if($pages->is_outlined) echo '1'; ?>" <?php if($pages->is_outlined) echo 'checked'; ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                      <div class="col-md-4 col-4">
                        <label class="caption">
                          Outlined buttons
                        </label>
                      </div>
                      <div class="col-md-4 col-4">
                        <a href="" id="link-custom-outline-color" class="nav-link p-0">Custom Color</a>
                      </div>
                    </div>
                    <!-- Modal For Color Picker Button-->
                    <div class="modal fade" id="modal-color-picker-outline-button" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  Choose Outline Color For The Buttons
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-4 col-xs-4">
                                    <div align="center">
                                      <div id="colorpickerOutlineButton"></div>
                                      <input type="text" id="colorOutlineButton" name="colorOutlineButton" value="#123456">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn" >Close </button>
                              </div>
                          </div>
                      </div>
                    </div>	

                    
                    <div class="as">
                      <!-- Bootstrap CSS -->
                      <ul class="nav nav-tabs sub-nav mt-4" role="tablist">
                        <li class="nav-item sub-nav">
                          <a class="nav-link active" href="#buzz" id="gradient" role="tab" data-toggle="tab">GRADIENT</a>
                        </li>
                        <li class="nav-item sub-nav">
                          <a class="nav-link" href="#references" id="solid" role="tab" data-toggle="tab">SOLID</a>
                        </li>
                      </ul>
                      <!-- Tab panes -->
                      <div class="tab-content mt-4 mb-4">

                        <!--theme color -->
                        <div role="tabpanel" class="tab-pane fade in active show" id="buzz">

                          <div class="theme mrgtp text-center">
                            @include('user.dashboard.theme-page')
                          </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="references">
                          <div align="center">
                            <div id="colorpicker"></div>
                            <input type="text" id="color" name="color" value="#123456">
                          </div>
                        </div>
                      </div>
                      <!--<label class="switch mb-4">
                        <input type="checkbox" name="powered" id="powered" value="powered" checked="">
                        <span class="slider round"></span>
                      </label> &nbsp; Powered By Omnilinks<br>-->

                      <div class="offset-md-8 col-md-4 pr-0 menu-nomobile">
                        <button type="button" class="btn btn-primary btn-block btn-biolinks savetemp" id="savetemp">
                          <!--<i class="far fa-save" style="margin-right:5px;"></i>-->
                          SAVE
                        </button>  
                      </div>

                      <div class="menu-mobile">
                        <div class="row btn-mobile">
                          <div class="col-6 pl-0 pr-0">
                            <button type="button" class="btn btn-default btn-block btn-preview">
                              PREVIEW
                            </button>
                          </div>
                          <div class="col-6 pl-0 pr-0">
                            <button type="button" class="btn btn-primary btn-block btn-save-preview savetemp">
                              SAVE
                            </button>  
                          </div>
                        </div>  
                      </div>

                    </div>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
      <!--phone-->
      <div class="col-md-5">
        <div class="fixed">
          <div class="center preview-center">
            <div class="mobile d-none d-lg-block">
              <div class="mobile1">
                <div class="screen colorgradient1" id="phonecolor" style="border:none; overflow-y:auto; ">
                  <!--screen-->
                  <header class="col-md-12 mt-4" style="padding-top: 17px; padding-bottom: 12px;">
                    <div class="row">
                      <div class="col-md-2 col-3">
                        <div style="width: 82px; height: 82px; margin-left: 13px; <?php if(is_null($pages->image_pages)) { echo 'display: none;'; } ?>">
                          @if(is_null($pages->image_pages))
                          @else
                            <img id="viewpicture" src="<?php 
                            // echo url(Storage::disk('local')->url('app/'.$pages->image_pages)); 
                            echo Storage::disk('s3')->url($pages->image_pages);
                            ?>" style="width:100%;height:auto;border-radius: 50%;" altSrc="{{asset('/image/no-photo.jpg')}}" onerror="this.src = $(this).attr('altSrc')">
                          @endif
                        </div>
                      </div>
                      <div class="col-md-10 col-8 p-2">
                        <ul style="margin-left: 23px; font-size: 11px;">
                          <li style="display: block; margin-bottom: -15px;  ">
                            <p class="font-weight-bold" style="color: #fff;" id="outputtitle"></p>
                          </li>
                          <li style="display: block; margin-bottom: -15px; ">
                            <p class="font-weight-bold" style="color: #fff; word-break: break-all;" id="outputlink"></p>
                          </li>
                          <li style="display: block;">
                            <p class="font-weight-bold" style="color: #fff;" id="outputnomor"></p>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </header>

                  <div class="col-md-12">
                    <div class="slideshow-container">
                      <div class="ap" id="viewbanner">
                      <?php 
                      if($banner->count()){
                        $ut=0;
                        foreach($banner as $ban) {
                          $ut+=1; 
                          if (!is_null($ban->images_banner)){
                      ?>
                        <div class="mySlides mylides fit" id="picture-id-<?=$ut?>-get">
                          <img src="<?php  
                          // echo url(Storage::disk('local')->url('app/'.$ban->images_banner)); 
                          echo Storage::disk('s3')->url($ban->images_banner); 
                          ?>" class="imagesize  input-picture-<?=$ut?>-get" id="image-update-<?=$ut?>" value="ada" altSrc="{{asset('/image/739x218.png')}}" onerror="this.src = $(this).attr('altSrc')"> 
                        </div>
                      <?php 
                        }}
                      } else {
                        if((Auth::user()->membership=='basic') OR (Auth::user()->membership=='elite')) {
                      ?>
                        <div class="mySlides mylides fit " id="picture-id-6-get">
                          <img id="picture-6" src="{{asset('image/739x218.png')}}" class="imagesize input-picture-6-get" value="ada" >
                        </div>
                      <?php }
                      }?>
                      </div>
                      @if((Auth::user()->membership=='basic') OR (Auth::user()->membership=='elite'))
                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1)">&#10095;</a>
                      @endif
                    </div>
                    <br>

                    <div style="text-align:center ; margin-top: -25px;" id="dot-view"></div>
                  </div>

                  <ul class="row links messengers links-num-1 "id="getview" style="font-size: xx-small; margin-top: 12px; margin-left: 15px; margin-right: 10px;">
                    <li class="link col pl-1 pr-1 shown-mes hide" id="waviewid"> 
                      <a href="#" class="btn btn-md btnview btn-light txthov" style="width: 100%;  padding-left: 2px;" id="walinkview">
                        <i class="fab fa-whatsapp"></i>
                        <label class="" style="font-size: xx-small;">&nbsp Whatsapp</label>
                      </a>
                    </li>
                    <li class="link col pl-1 pr-1 hide" id="telegramviewid" >
                      <a href="#" class="btn btn-md btnview txthov" style="
                      width: 100%;  padding-left: 2px;" id="telegramlinkview"><i class="fab fa-telegram-plane"></i><label class="" style="font-size: xx-small;">&nbsp Telegram</label></a>
                    </li> 
                    <li class="link col pl-1 pr-1 hide" id="skypeviewid" >
                      <a href="#" class="btn btn-md btnview txthov" style="
                      width: 100%;  padding-left: 2px;" id="skypelinkview"><i class="fab fa-skype"></i><label class="" style="font-size: xx-small;">&nbsp Skype</label></a>
                    </li>
                    <li class="link col pl-1 pr-1 hide" id="lineviewid" >
                      <a href="#" class="btn btn-md btnview txthov" style="
                      width: 100%;  padding-left: 2px;" id="linelinkview"><i class="fab fa-line"></i><label class="" style="font-size: xx-small;">&nbsp Line</label></a>
                    </li>
                    <li class="link col pl-1 pr-1 hide" id="messengerviewid" >
                      <a href="#" class="btn btn-md btnview txthov" style="
                      width: 100%;  padding-left: 2px;" id="messengerlinkview"><i class="fab fa-facebook-messenger"></i><label class="" style="font-size: xx-small;">&nbsp Messenger</label></a>
                    </li>
                  </ul>
                  <div class="row" style="font-size: xx-small; margin-left: 3px; margin-right: 2px; font-weight: 700;">
                    <ul class="col-md-12" id="viewLink" >
                      @if($links->count())
                      @foreach($links as $link)
                        <li id="link-preview-{{$link->id}}">
                          <a href="#" class="btn btn-md btnview title-{{$link->id}}-view-update txthov" style="
                          width: 100%;  padding-left: 2px;margin-bottom: 12px;" id="link-url-update-{{$link->id}}-get" >{{$link->title}}</a>
                        </li>
                      @endforeach
                      @else
                        <!--
                        <button type="button" class="btn btnview title-1-view-get" id="link-url-1-preview" style="width: 100%; margin-bottom: 12px;">masukkan link</button>
                        -->
                        <li class="">
                          <a href="#" class="btn btn-md btnview title-1-view-get txthov" style="
                          width: 100%;  padding-left: 2px;margin-bottom: 12px;" id="link-url-update-1-preview" >masukkan link</a>
                        </li>
                      @endif
                    </ul>
                  </div>
                  <!-- SM preview -->
                  <ul class="row rows " style="padding-left: 27px; padding-right: 44px;" id="sm-preview">
                    <li class="col linked hide" id="youtubeviewid">
                      <a href="#" title="Youtube">
                        <i class="fab fa-youtube" style="color: #fff;"></i>
                      </a>
                    </li>
                    <li class="col linked hide" id="fbviewid" >
                      <a href="#" title="fb" >
                        <i class="fab fa-facebook-square" style="color: #fff;"></i>
                      </a>
                    </li>
                    <li class="col linked hide" id="twitterviewid">
                      <a href="#" title="Twitter">
                        <i class="fab fa-twitter-square" style="color: #fff;"></i>
                      </a>
                    </li>
                    <li class="col linked hide" id="igviewid">
                      <a href="#" title="ig" >
                        <i class="fab fa-instagram" style="color: #fff; "></i>
                      </a>  
                    </li>  
                  </ul>

                  @if(Auth::user()->membership!='elite')
                    <div class="col-md-12 mb-4 mt-4" align="center" id="poweredview">
                      <div class="powered-omnilinks">
                        <a href="#">
                          <span style="font-size:11px; color: #fff;">
                            powered by
                          </span>
                          <br>&nbsp;&nbsp;
                          <img style="width: 110px;" src="{{asset('image/omnilinkz-logo-wh.png')}}">
                        </a>
                      </div>
                    </div>
                  @endif

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- untuk preview di mobile -->
      <div class="preview-mobile preview-none">
      </div>

    </div>
  </div>

</section>
<script src="{{asset('js/farbtastic.js')}}"></script>
<script src="{{asset('js/biolinks.js')}}"></script>
<noscript>Jalankan Javascript di browser anda</noscript>
<script type="text/javascript">
  var elhtml;
  let idpic=6;
  let counterBanner=0;
  
  $('body').on('click', '.btn-preview', function() {
    $('.preview-mobile').html($('.mobile1').html());
    $('.preview-mobile').toggleClass('preview-none');
  });

  $(document).ready(function() {
     // dotview();
    
      dotsok();
      let inputtitle=$('#pagetitle');
      let inputlink=$('#pagelink');
      let inputtelpon=$('#telpon');

      let outputtitle=$('#outputtitle');
      let outputlink=$('#outputlink');
      let outputnomor=$('#outputnomor');

      inputtitle.keyup(function(){
        outputtitle.text(inputtitle.val());
      });
       inputlink.keyup(function(){
        outputlink.text(inputlink.val());
      });
        inputtelpon.keyup(function(){
        outputnomor.text(inputtelpon.val());
      });
      outputtitle.text(inputtitle.val());
      outputlink.text(inputlink.val());
      outputnomor.text(inputtelpon.val());

      
    $(document).on('focus','.focuslink',function(){
      let inputlinkview=$(this);
      let getoutputviewlink=inputlinkview.attr('id');
      let outputviewlink=$('.'+getoutputviewlink+'-get');
      $(document).on('keyup',inputlinkview,function(){
         outputviewlink.text(inputlinkview.val());
         if (inputlinkview.val()=='') {
          outputviewlink.text('Masukkan Link');
         }
      });
    });
    $(document).on('focus','.focuslink-update',function(){
      let inputlinkview=$(this);
      let getoutputviewlink=inputlinkview.attr('id');
      let outputviewlink=$('.'+getoutputviewlink);
      $(document).on('keyup',inputlinkview,function(){
        outputviewlink.text(inputlinkview.val());
        if (inputlinkview.val()=='') {
          outputviewlink.text('Masukkan Link');
        }
      });
    });

    $('.outlined').click(function() {
      check_outlined();
    });
    <?php if($pages->is_rounded) {?>
      //$(".mobile1").addClass("roundedview");
      $(".screen").addClass("roundedview");
    <?php } ?>

    $('.rounded').click(function() {
      check_rounded();
    });
    $("#powered").click(function(){
      if ($(this).prop("checked")==true) {
        $("#poweredview").children().show();
      }
      else if($(this).prop("checked")==false){
        $("#poweredview").children().hide(); 
      }
    });
    $(document).on('click', '#gradient', function() {
      $('#modeBackground').val('gradient');
      // $('#backtheme').val('colorgradient1');
      $("#phonecolor").removeClass();
      $("#phonecolor").addClass("screen "+$('#backtheme').val());
    });
    $(document).on('click', '#solid', function() {
      $('#modeBackground').val('solid');
      $("#phonecolor").removeClass();
      $("#phonecolor").addClass("screen");
      $("#phonecolor").css("background-color",$("#color").val());
      // $("#backtheme").val();
    });
    <?php if (!is_null($pages->color_picker)) { ?>
      color_picker = "<?php echo $pages->color_picker; ?>";
      $('#color').val(color_picker);
      $("#solid").click();
    <?php } ?>
    <?php if (!is_null($pages->template)) { ?>
      $('#backtheme').val("<?php echo $pages->template; ?>");
      $("#gradient").click();
    <?php } ?>

    //for bacground, outline color 
    <?php if (!is_null($pages->rounded)) { ?>
      $('#colorButton').val("<?php echo $pages->rounded; ?>");
      // $('.btnview').css("background-color","<?php echo $pages->rounded; ?>");
    <?php } ?>
    <?php if (!is_null($pages->outline)) { ?>
      outline = "<?php echo $pages->outline; ?>";
      $('#colorOutlineButton').val(outline);
      $('.btnview').css("border-color",outline);
    <?php } ?>

    <?php if($pages->is_outlined) {?>
      //$(".mobile1").addClass("outlinedview");
      $(".screen").addClass("outlinedview");
      $('.btnview').css("background-color","transparent");
      $('.btnview').css("color",outline);
    <?php } else {?>
      $('.btnview').css("background-color",outline);
      $('.btnview').css("color","#fff");
    <?php } ?>
    
    loadPixelPage();
    refreshpixel();
    refreshwa();

    $('.infooter').remove();

    $(".sortable-msg").sortable({
      handle: '.handle',
      cursor: 'move',
      axis: 'y',
      start: function(e, ui) {
          // creates a temporary attribute on the element with the old index
          $(this).attr('data-previndex', ui.item.index());
      },
      update: function(event, ui) {
        var index =  ui.item.index();
        var start_pos = $(this).attr('data-previndex');
        
        if (start_pos<index) {
          $("#getview li:eq("+start_pos+")").insertAfter($("#getview li:eq("+index+")"));
        }
        else {
          $("#getview li:eq("+start_pos+")").insertBefore($("#getview li:eq("+index+")"));
        }
      }
    });
    $(".sortable-msg").disableSelection();
    //$( ".sortable-msg" ).draggable();

    $(".sortable-link").sortable({
      handle: '.handle',
      cursor: 'move',
      axis: 'y',
      /* for example 
      stop: function(event, ui) {
        var data = $(this).sortable('serialize');
        //save_order(data);
      }*/
      start: function(e, ui) {
          // creates a temporary attribute on the element with the old index
          $(this).attr('data-previndex', ui.item.index());
      },
      update: function(event, ui) {
        var index =  ui.item.index();
        var start_pos = $(this).attr('data-previndex');
        
        if (start_pos<index) {
          $("#viewLink li:eq("+start_pos+")").insertAfter($("#viewLink li:eq("+index+")"));
        }
        else {
          $("#viewLink li:eq("+start_pos+")").insertBefore($("#viewLink li:eq("+index+")"));
        }
      }
      
    });
    $(".sortable-link").disableSelection();
    //$( ".sortable-link" ).draggable();

    $(".sortable-sosmed").sortable({
      handle: '.handle',
      cursor: 'move',
      axis: 'y',
      start: function(e, ui) {
          // creates a temporary attribute on the element with the old index
          $(this).attr('data-previndex', ui.item.index());
      },
      update: function(event, ui) {
        var index =  ui.item.index();
        var start_pos = $(this).attr('data-previndex');
        
        if (start_pos<index) {
          $("#sm-preview li:eq("+start_pos+")").insertAfter($("#sm-preview li:eq("+index+")"));
        }
        else {
          $("#sm-preview li:eq("+start_pos+")").insertBefore($("#sm-preview li:eq("+index+")"));
        }
      }
    });
    $(".sortable-sosmed").disableSelection();

    //picker for background device color purpose
    function onColorChange(color) {
      // console.log(color);
      $("#phonecolor").removeClass();
      $("#phonecolor").addClass("screen");
      $("#phonecolor").css("background-color",color);
      $("#backtheme").val();
      $("#color").val(color);
    }
    $('#colorpicker').farbtastic('#color');
    picker = $.farbtastic('#colorpicker');
    // picker.setColor("#b6b6ff");
    $("#color").on('keyup', function() {
      picker.setColor($(this).val());
    });
    picker.linkTo(onColorChange);
    
    //for background color button purpose 
    function onColorButtonChange(color) {
      // console.log(color);
      $("#colorButton").val(color);
      $('.btnview').css("background-color",color);
    }
    $('#colorpickerButton').farbtastic('#colorButton');
    picker = $.farbtastic('#colorpickerButton');
    // picker.setColor("#b6b6ff");
    $("#colorButton").on('keyup', function() {
      picker.setColor($(this).val());
    });
    picker.linkTo(onColorButtonChange);
    $("#link-custom-background-color").on('click', function(e) {
      e.preventDefault();
      $('#modal-color-picker-button').modal('toggle');
    });

    //modal-color-picker-outline-button colorpickerOutlineButton colorOutlineButton
    //for button purpose colorpickerButton colorButton
    function onOutlineColorButtonChange(color) {
      // console.log(color);
      $("#colorOutlineButton").val(color);
      // $('.btnview').css("border-color",color);
      console.log($('input[name="outlined"]'));
      if ($('input[name="outlined"]').val()=="1") {
        //$(".mobile1").addClass("outlinedview");
        $(".screen").addClass("outlinedview");
        $('.btnview').css("background-color","transparent");
        $('.btnview').css("color",color);
      } else {
        $('.btnview').css("background-color",color);
        $('.btnview').css("color","#fff");
      }
      
    }
    $('#colorpickerOutlineButton').farbtastic('#colorOutlineButton');
    picker = $.farbtastic('#colorpickerOutlineButton');
    // picker.setColor("#b6b6ff");
    $("#colorOutlineButton").on('keyup', function() {
      picker.setColor($(this).val());
    });
    picker.linkTo(onOutlineColorButtonChange);
    $("#link-custom-outline-color").on('click', function(e) {
      e.preventDefault();
      $('#modal-color-picker-outline-button').modal('toggle');
    });
    
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
          $('#viewpicture').attr('src', e.target.result).fadeIn('slow');

          $('#viewpicture').show();
          $("#wizardPicturePreview-delete").show();
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#wizardPicturePreview").on('click', function() {
      $('#file-wizard-picture').trigger('click');
    });
    $(document).on('change', "#file-wizard-picture", function (e) {
      readURL(this);
    });
    $("#wizardPicturePreview-delete").on('click', function() {
      delete_photo();
    });
    $(document).on('change','.pictureClass',function(){
      let inputthis=$(this).attr('id');
        function readThis(input) {
          if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
            $("."+inputthis+"-get").attr('src',e.target.result);
            // $("."+inputthis+"-get").parent().show();
            if ($(".mylides").hide()) {
              $("."+inputthis+"-get").parent().show();
              $("."+inputthis+"-dot").siblings().removeClass("activated");
              $("."+inputthis+"-dot").addClass("activated");
            }
            

            $("."+inputthis+"-get").attr("value","ada");
            $("#"+inputthis+"-dot").show();
            if ($(".dot").length==1) {
              $(".dot").parent().hide();
              $('.prev').hide();
              $('.next').hide();
            }
            else{
              $(".dot").parent().show();
              $('.prev').show();
              $('.next').show();
            }
          }
          reader.readAsDataURL(input.files[0]);
        }
      }
      //showSlides();
      readThis(this);
    });
     
    /*$(".txthov").hover(
      function() {
        check_outlined();
        check_rounded();
        temp1 = $(this).css("color");
        // temp2 = $(this).css("background-color");
        temp2 = $("#phonecolor").css("background-color");

        $(this).parent().children().css("background-color",temp1);
        $(this).parent().children().css("color",temp2);
      }, function() {
        check_outlined();
        check_rounded();
      }
    );*/
    $(document).on({
      mouseenter: function () {
        check_outlined();
        check_rounded();
        temp1 = $(this).css("color");
        // temp2 = $(this).css("background-color");
        temp2 = $("#phonecolor").css("background-color");

        $(this).parent().children().css("background-color",temp1);
        $(this).parent().children().css("color",temp2);
      },
      mouseleave: function () {
        check_outlined();
        check_rounded();
      }
    }, ".txthov"); //pass the element as an argument to .on    


    // Add the following code if you want the name of the file appear on select
    $(document).on("change", ".custom-file-input",function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    $("body").on("click", ".savetemp", function() {
      tambahTemp();
      //tambahPages();
      $('#pesanAlert').removeClass('alert-danger');
      $('#pesanAlert').children().remove();
    });
    // $(".prev").click(function(){
    //  let sibli=$(this).siblings(".mySlides").css("display","block");
    //  console.log($(this).siblings(".mySlides").children().val());
    //  if (sibli.children().val()=='tidakada') {
    //   plusSlides(1);
    //  }
    // });
    // $(".next").click(function(){
    //  let sibli=$(this).parent();
    //  let find= sibli.find(".mySlides");
    //  if (find.css("display")=='block') {
    //   let findimage=find.children().val();
    //   if (findimage=="tidakada") {
    //      plusSlides(-1);
    //   }
    //  }

    //  // siblings(".mySlides").css("display","block");
    //  // if (sibli.children().val()=="tidakada") {
    //  // 
    //  // }
    // });
    $("body").on("click", "#addBanner", function() {
      //tambahBanner();
      
      idpic+=1;
      let $el;
      // if($('.list-banner').length<=0){
      //   $el = $( ".div-banner" ).append(elhtml);
      // }
      //  else {
      //   $el = $('.list-banner:first').clone().appendTo('.div-banner');
      // }
        elhtml = '<div class="div-table list-banner mb-4" picture-id="picture-id-'+idpic+'"><div class="div-cell"><input type="text" name="judulBanner[]" value="" class="form-control" placeholder="Judul banner"><input type="hidden" name="idBanner[]" value=""><input type="hidden" name="statusBanner[]" class="statusBanner" value=""><input type="text" name="linkBanner[]" value="" class="form-control" placeholder="masukkan link"><select name="bannerpixel[]"  class="form-control bannerpixel banner-new"></select><div class="custom-file"><input type="file" name="bannerImage[]" class="custom-file-input pictureClass" id="input-picture-'+idpic+'" aria-describedby="inputGroupFileAddon01"><label class="custom-file-label" for="inputGroupFile01">Choose file</label></div></div><div class="div-cell cell-btn btn-deleteBanner"><span><i class="far fa-trash-alt"></i></span></div></div>';
       $el = $(".div-banner").append(elhtml);
       loadPixel(0,'.banner-new');
      if ($('.list-banner').length==5) {
         $(this).attr('disabled', 'disabled'); 
        }
      // if($el.find("input").val("")){
      // $el.find("input").val("");  
      // }

      // $el.find("input").attr("value","");
      // $el.attr("picture-id","picture-id-"+idpic+"");
      // $el.find("input[type='file']").attr("id","input-picture-"+idpic+"");

      // $el.find(".custom-file-input").siblings(".custom-file-label").addClass("selected").html('Choose file');
      // $el.wrap('<form>').closest('form').trigger("reset");
      // $el.unwrap();
      // $el.find(".custom-file-input").siblings(".custom-file-label").addClass("selected").html('Choose file');
      let countbanner=$('.mySlides').length;
        // if (countbanner==1) {

        // }
      let style=""; 
      if ($(".list-banner").length==1) {
        style="block";
      }
      else{
        style="none"; 
      }
      $('#viewbanner').append('<div class="mySlides mylides fit" id="picture-id-'+idpic+'-get"  style="display:'+style+'" value="hid"><img id="picture-'+idpic+'" src="<?php echo asset('banner-default.jpg');?>" value="tidakada" class="imagesize input-picture-'+idpic+'-get"></div>');
      let slidesi=$('.mySlides');
      let dotselementt=$('#dot-view');
      let slidesiLength=slidesi.length-1;
      //console.log(slidesiLength);
        dotselementt.append('<span class="dot picture-id-'+idpic+'-dot input-picture-'+idpic+'-dot" id="input-picture-'+idpic+'-dot" onclick="currentSlide('+slidesiLength+')" style="display:none"></span>');
      if ($(".dot").length==1) 
      {
        $(".dot").parent().hide();
        $('.prev').hide();
        $('.next').hide();
      }
    });

    $(document).on("click",".btn-deleteBannerUpdate",function(){
      $(this).parent().hide();
      $(this).parent().removeClass('list-banner');
      let hide=$(this).parent();
      hide.find(".statusBanner").val("delete");
      let idthis=$(this).parent().attr("picture-id");
      $("#"+idthis+"-get").remove();
      $("."+idthis+"-dot").remove();
      // if () {}  
      if($('.list-banner').length<=1){
        elhtml = $('.div-banner').html();
        $('.prev').hide();
        $('.next').hide();
      }  
        plusSlides(-1);
    });


    $(document).on("click", ".btn-deleteBanner", function() {
      if($('.list-banner').length<=1){
        elhtml = $('.div-banner').html();
        $('.prev').hide();
        $('.next').hide();
      } 
      if ($('.list-banner').length<=5) {
        $("#addBanner").removeAttr("disabled");
      }

      $(this).parent().remove();
       let idthis=$(this).parent().attr("picture-id");

      $("#"+idthis+"-get").remove();

      $("."+idthis+"-dot").remove();    
        plusSlides(-1);
       if ($(".dot").length==1) {
        $(".dot").parent().hide();
        $('.prev').hide();
        $('.next').hide();
      }
    });

    $("body").on("click", ".btn-delete", function() {
      if (confirm('anda yakin ingin menghapus pixel ini')) {
        var idpixel = $(this).attr('dataid');
        delete_pixel(idpixel);
      }
    });

    $("body").on("click", ".btn-deletewa", function() {
      if (confirm('anda yakin ingin menghapus walink ini')) {
        var idwalink = $(this).attr('dataidwa');
        deletewalink(idwalink);
      }
    });

    $(document).on('click', '#generate', function(e) {
      var nomor = $('#nomorwa').val();
      var message = $('#pesan-wa').val();
      var convert = encodeURI(message);
      var link = "https://api.whatsapp.com/send?phone=" + nomor + "&text=" + convert + "";
          //console.log(link);
      $('#demo').html(link);
      tambahwalink();
    });

    $(document).on("click", "#btnpixel", function(e) {
      tambahpixel();
      $('#pesanAlert').removeClass('alert-danger');
      $('#pesanAlert').children().remove();
    });

    $(document).on("click", ".btn-save-link", function(e) {
      if (tambahPages()) {
        tambahTemp();
      }
      $('#pesanAlert').removeClass('alert-danger');
      $('#pesanAlert').children().remove();
      $(window).scrollTop(0);
    });

    $('.btn-reset').click(function() {
      $('#pesanAlert').removeClass('alert-danger');
      $('#pesanAlert').children().remove();
    });

    $(document).on('click', '.btn-editwa', function(e) {
      var editnomorwa = $(this).attr("datanomorwa");
      var editpesan = $(this).attr("datapesan");
      var editidwa = $(this).attr("dataeditwa");
      $('#pesanAlert').addClass('alert-danger').html('<div class="resetedit">anda dalam mode edit tekan reset untuk membatalkan</div>');
      $('#editidwa').val(editidwa);
      $('#nomorwa').val(editnomorwa);
      $('#pesan-wa').val(editpesan);
    });

    $(document).on('click', '.btn-editpixel', function(e) {
      var script = $(this).attr("datascriptpixel");
      var title = $(this).attr("dataedittitle");
      var editidpixel = $(this).attr("dataeditpixelid");
      var jenis = $(this).attr("datajenis");

      $('#pesanAlert').addClass('alert-danger').html('<div class="resetedit">anda dalam mode edit tekan reset untuk membatalkan</div>');
      $('#script').val(script);
      $('#judul').val(title);
      $('#editidpixel').val(editidpixel);
      $('#jenis_pixel').val(jenis);
    });
    
    // buat sort msg
    <?php 
    if (!is_null($pages->sort_msg)) {
      $arr = explode(";",$pages->sort_msg);
      $counter = 1;
      foreach($arr as $data){
    ?>
        $("#msg-li-"+"<?php echo $data; ?>").attr("data-category","<?php echo $counter; ?>");
        $("#msg-li-"+"<?php echo $data; ?>>div").removeClass("hide");
        // $("#msg-li-"+"<?php echo $data; ?>>div").show();
        $("#msg-li-"+"<?php echo $data; ?>>div").css("display","table");
        $("#msg-li-"+"<?php echo $data; ?>>div").find(".input-hidden").val($("#msg-li-"+"<?php echo $data; ?>>div").find(".input-hidden").attr("data-val"));
        
        $("#"+"<?php echo $data; ?>"+"viewid").attr("data-category","<?php echo $counter; ?>");
        $("#"+"<?php echo $data; ?>"+"viewid").removeClass("hide");
    <?php 
        $counter += 1;
      } ?>
      sortMeBy("data-category", "ul.sortable-msg", "li", "asc");
      sortMeBy("data-category", "ul#getview", "li", "asc");
    <?php }
    else {
    ?>
        $("#msg-li-wa>div").removeClass("hide");
        // $("#msg-li-wa>div").show();
        $("#msg-li-wa>div").css("display","table");
        
        $("#waviewid").removeClass("hide");
    <?php } ?>


    
    // buat sort link
    <?php 
    if (!is_null($pages->sort_link)) {
      $arr = explode(";",$pages->sort_link);
      $counter = 1;
      foreach($arr as $data){
    ?>
        $("#link-url-update-"+"<?php echo $data; ?>").attr("data-category","<?php echo $counter; ?>");
        
        $("#link-preview-"+"<?php echo $data; ?>").attr("data-category","<?php echo $counter; ?>");
    <?php 
        $counter += 1;
      } ?>
      sortMeBy("data-category", "ul.sortable-link", "li", "asc");
      sortMeBy("data-category", "ul#viewLink", "li", "asc");
    <?php }
    else {
    ?>
    <?php } ?>
    
    
    // buat sort sosmed
    <?php 
    if (!is_null($pages->sort_sosmed)) {
      $arr = explode(";",$pages->sort_sosmed);
      $counter = 1;
      foreach($arr as $data){
    ?>
        $("#sosmed-"+"<?php echo $data; ?>").attr("data-category","<?php echo $counter; ?>");
        $("#sosmed-"+"<?php echo $data; ?>>div").removeClass("hide");
        // $("#sosmed-"+"<?php echo $data; ?>>div").show();
        $("#sosmed-"+"<?php echo $data; ?>>div").css("display","table");
        $("#sosmed-"+"<?php echo $data; ?>>div").find(".input-hidden").val($("#sosmed-"+"<?php echo $data; ?>>div").find(".input-hidden").attr("data-val"));
        
        $("#"+"<?php echo $data; ?>"+"viewid").attr("data-category","<?php echo $counter; ?>");
        $("#"+"<?php echo $data; ?>"+"viewid").removeClass("hide");
        $("#"+"<?php echo $data; ?>"+"viewid").addClass("shown-sm");
        // changeLengthMedia();
    <?php 
        $counter += 1;
      } ?>
      sortMeBy("data-category", "ul.sortable-sosmed", "li", "asc");
      sortMeBy("data-category", "ul#sm-preview", "li", "asc");
    <?php }
    else {
    ?>
        $("#sosmed-youtube>div").removeClass("hide");
        
        $("#youtubeviewid").removeClass("hide");
    <?php } ?>

    
    currentSlide(0);
    slideIndex=0;
    check_outlined();
    check_rounded();
    <?php 
      if(is_null($pages->image_pages)){
    ?>
      $("#wizardPicturePreview-delete").hide();
    <?php }
    ?>
    
  });


 
    // $(document).on('click','.marker',function(){
    //      $('#backtheme').val('');
    // });
    //  $('#powered').prop('disabled','disabled');
    // $(document).bind('contextmenu',function(e){
    //   e.preventDefault();
    // });
</script>
@endsection
