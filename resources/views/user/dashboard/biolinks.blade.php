@extends('layouts.app')

@section('content')
<?php use App\Helpers\Helper; ?>
<link rel="stylesheet" href="{{asset('css/dash.css')}}">
<link rel="stylesheet" href="{{asset('css/farbtastic.css')}}">
<link rel="stylesheet" href="{{asset('css/theme.css')}}">
<link rel="stylesheet" href="{{asset('css/animate.css')}}">
<link rel="stylesheet" href="{{asset('css/animate-2.css')}}">

<style type="text/css">
  @media screen and (max-width: 768px) {
    .menu-nomobile{
      display: none;
    }

    .menu-mobile {
      display: block;
    }
  }

  .btn-copy {
    cursor: pointer;
  }

  .themes.selected, .wallpapers.selected{
    border: 3px solid #0062CC;
  }
</style>

<script type="text/javascript">
  var picker,dataView;
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
  
  function loadLinkBio(){
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'GET',
      url: "<?php echo url('/link-bio');?>",
      data: { id: <?php echo $pages->id; ?>},
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
        $('.sortable-link').html(data.view);
        
      }
    });
  }
  
  function tambahTemp() {
    var form = $('#saveTemplate')[0];
    var formData = new FormData(form);
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
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
          loadLinkBio();
          //new 
          // $(".delete-link").parents("li").each(function( index ) {
            // if ($(this).val() != ''){
              // $(this).remove();
            // }
          // });
          
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
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
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
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'GET',
      data: {
        idpage: $('#idpage').val(),
      },
      url: "<?php echo url('/load-pixel'); ?>",
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
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
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

        $('#delete-success').modal('show');
        setTimeout(function(){
          $('#delete-success').modal('hide')
        }, 3000);
      }
    });
  }

  function loadPixel(){
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'GET',
      url: "<?php echo url('/load-pixel-page'); ?>",
      data: { id:0 },
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
        // $(selector).html(data.view);
        dataView = data.view;
      }
    });
  }
  loadPixel();

  function loadPixelPage() {
    $("#wapixel").html(dataView);
    $("#wapixel").val('{{$pages->wa_pixel_id}}');
    $("#telegrampixel").html(dataView);
    $("#telegrampixel").val('{{$pages->telegram_pixel_id}}');
    $("#skypepixel").html(dataView);
    $("#skypepixel").val('{{$pages->skype_pixel_id}}');
    $("#linepixel").html(dataView);
    $("#linepixel").val('{{$pages->line_pixel_id}}');
    $("#messengerpixel").html(dataView);
    $("#messengerpixel").val('{{$pages->messenger_pixel_id}}');
    $("#youtubepixel").html(dataView);
    $("#youtubepixel").val('{{$pages->youtube_pixel_id}}');
    $("#fbpixel").html(dataView);
    $("#fbpixel").val('{{$pages->fb_pixel_id}}');
    $("#igpixel").html(dataView);
    $("#igpixel").val('{{$pages->ig_pixel_id}}');
    $("#twitterpixel").html(dataView);
    $("#twitterpixel").val('{{$pages->twitter_pixel_id}}');
    <?php if(!$banner->count()) { ?>
      $(".bannerpixel").html(dataView);
      $(".bannerpixel").val(0);
    <?php } ?>
    // loadPixel('{{$pages->wa_pixel_id}}','#wapixel');
    // loadPixel('{{$pages->telegram_pixel_id}}','#telegrampixel');
    // loadPixel('{{$pages->skype_pixel_id}}','#skypepixel');
    // loadPixel('{{$pages->line_pixel_id}}','#linepixel');
    // loadPixel('{{$pages->messenger_pixel_id}}','#messengerpixel');
    
    // loadPixel('{{$pages->youtube_pixel_id}}','#youtubepixel');
    // loadPixel('{{$pages->fb_pixel_id}}','#fbpixel');
    // loadPixel('{{$pages->ig_pixel_id}}','#igpixel');
    // loadPixel('{{$pages->twitter_pixel_id}}','#twitterpixel');
    <?php 
    if($links->count()) {
      foreach($links as $link) {
    ?>
      $("#linkpixel-{{$link->id}}-update").html(dataView);
      $("#linkpixel-{{$link->id}}-update").val('{{$link->pixel_id}}');
    <?php 
      }
    }
    else {
    ?>
      $("#linkpixel-1").html(dataView);
      $("#linkpixel-1").val(0);
    <?php } ?>    
    
    
    <?php if(!$banner->count()) { ?>
      // loadPixel(0,'.bannerpixel');
    <?php } ?>
  }
  
  function tambahwalink() {
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
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
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'GET',
      url: "<?php echo url('/load-wa-link');?>",
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
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
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

        $('#delete-success').modal('show');
        setTimeout(function(){
          $('#delete-success').modal('hide')
        }, 3000);
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
    // console.log(n);
    // console.log($(".mySlides").length);
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
      if ($('#is_text_color').prop("checked") == false) {
        $('.btnview').css("border-color",$("#colorOutlineButton").val());
        $('.btnview').css("color",$("#colorOutlineButton").val());
        $('.description').css("color",$("#colorOutlineButton").val());
      } else {
        $('.btnview').css("border-color",$('#textColor').val());
        $('.btnview').css("color",$('#textColor').val());
        $('.description').css("color",$('#textColor').val());
      }

      /*$('.btnview').css("border-color",$("#colorButton").val());
      $('.btnview').css("color",$("#colorOutlineButton").val());*/
    } else if ($('.outlined').prop("checked") == false) {
      //$(".mobile1").removeClass("outlinedview");
      $(".screen").removeClass("outlinedview");
      $('.outlined').val(0);
      
      $('.btnview').css("background-color",$("#colorButton").val());
      $('.btnview').css("border-color",'transparent');
      //$('.btnview').css("color","#fff");
      if ($('#is_text_color').prop("checked") == false) {
        $('.btnview').css("color",$("#colorOutlineButton").val());
        $('.description').css("color",$("#colorOutlineButton").val());
      } else {
        $('.btnview').css("color",$("#textColor").val());
        $('.description').css("color",$("#textColor").val());
      }
    }
  }

  function check_rounded(){
    if ($('.rounded').prop("checked") == true) {
      //$(".mobile1").addClass("roundedview");
      $(".screen").addClass("roundedview");
      $('.rounded').val(1);
    } 
    else if ($('.rounded').prop("checked") == false) {
      //$(".mobile1").removeClass("roundedview");
      $(".screen").removeClass("roundedview");
      $('.rounded').val(0);
    }
  }
  
  function check_powered(){
    if ($('#powered').prop("checked") == true) {
      $("#poweredview").children().show();
      $('#powered').val(1);
    }
    else if ($('#powered').prop("checked") == false) {
      $("#poweredview").children().hide();
      $('#powered').val(0);
    }
  }

  function check_click_bait(){
    if ($('#is_click_bait').prop("checked") == true) {
      $("#phonecolor").addClass("service");
      // $("#viewLink li").first().addClass("animate-buzz");
      $("#viewLink").find('li:not(:empty):first').addClass("animate-buzz");
      $('#is_click_bait').val(1);
    }
    else if ($('#is_click_bait').prop("checked") == false) {
      $("#phonecolor").removeClass("service");
      // $("#viewLink li").first().removeClass("animate-buzz");
      $("#viewLink").find('li:not(:empty):first').removeClass("animate-buzz");
      $('#is_click_bait').val(0);
    }
  }
  
  function check_text_color(){
    if ($('#is_text_color').prop("checked") == true) {
      $('#is_text_color').val(1);
    }
    else if ($('#is_text_color').prop("checked") == false) {
      $('#is_text_color').val(0);
    }
    check_outlined();
  }

  function delete_photo(){
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
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
          $('.div-picture').hide();
          
          $("#wizardPicturePreview-delete").hide();
        } else {
          $('#pesanAlert').removeClass('alert-success');
          $('#pesanAlert').addClass('alert-warning');
        }
      }
    });  
  }

  function tambah_premiumid() {
    $.ajax({
      type: 'GET',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType: 'text',
      data: $('#form-premiumID').serialize(),
      url: "<?php echo url('/premium-id-biolinks/tambah');?>",
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        var data = jQuery.parseJSON(result);
        $("#pesanAlert").html(data.message);
        $("#pesanAlert").show();
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
</script>

<section id="tabs" class="col-md-10 offset-md-1 col-12 pl-0 pr-0 project-tab">
  <div class="container body-content-mobile main-cont">
    <div class="row">
      <div class="col-md-12">
        <h4 style="color: #106BC8">
          <a href="{{url('/')}}">
            <button class="btn btn-default btn-back mb-2">
              <i class="fas fa-arrow-circle-left"></i>
              Back
            </button>
          </a>
        </h4>
      
        <!--
        <br>
        @if(Auth::user()->membership=='free')
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
        
        <div id="pesanAlert" class="alert mb-0" style="display: none;"></div>

        <button class="btn btn-success mt-3 mb-3 btn-premium">
          <i class="fas fa-star"></i> Get Premium ID
        </button>

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

              @if(Auth::user()->membership!='free')
                <li class="nav-item">
                  <a href="#pixel" class="nav-link link" role="tab" data-toggle="tab">
                    Pixel
                  </a>
                </li>
              @endif
              
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
                                <input type="text" name="wa" class="form-control wa-input" value="{{$pages->wa_link}}" id="inlineFormInputGroupUsername" onkeypress="return hanyaAngka(event)" placeholder="Masukkan nomor WhatsApp ex : 6281...">
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
                  <label class="switch" style="margin-left:33px;margin-right:15px;">
                    <input type="checkbox" name="is_click_bait" id="is_click_bait" value="<?php if($pages->is_click_bait) echo '1'; ?>" <?php if($pages->is_click_bait) echo 'checked'; ?>>
                    <span class="slider round"></span>
                  </label>
                  <label class="caption">
                    Buzz Animation
                  </label>
                  <button type="button" class="float-right btn btn-primary btn-sm" id="addlink">
                    <i class="fas fa-plus"></i>
                  </button>
                  <br>

                  <div class="row">
                    <div class="col-md-2 col-3">
                    </div>
                    <div class="col-md-4 col-4">
                    </div>
                    <div class="col-md-4 col-4">
                    </div>
                  </div>
                  
                  <div class="mb-5">
                    <ul class="sortable-link a">
                      
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
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            +62
                          </div>
                        </div>
                        <input type="text" name="nomorwa" id="nomorwa" class="form-control col-md-12" onkeypress="return hanyaAngka(event)">
                      </div>
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
              
              <!-- TAB 4 -->
              <div role="tabpanel" class="tab-pane fade in active show" id="style">
                <form method="post" id="saveTemplate" enctype="multipart/form-data">

                  {{ csrf_field() }}
                  <input type="hidden" name="uuidtemp" value="{{$uuid}}">
                  <div class="form-group">
                    <div class="col-md-12">
                      <div class="row mt-5">
                        <div class="col-md-4 mb-3 picture-container">
                          <div class="picture" style="width: 106px;height: 106px;">
                            <img src="<?php 
                            if(is_null($pages->image_pages)){
                              echo asset('image/no-photo.jpg');
                            } 
                            else {
                              echo Storage::disk('s3')->url($pages->image_pages);
                            }
                            ?>" class="picture-src img-responsive" id="wizardPicturePreview" title="" altSrc="{{asset('/image/no-photo.jpg')}}" onerror="this.src = $(this).attr('altSrc')" style="width:100%;height:100%;object-fit: cover;object-position: center;">
                            <input type="file" name="imagepages" id="file-wizard-picture" class="" accept=".png, .jpg">
                          </div>
                          <!--<i class="fa fa-trash" id="wizardPicturePreview-delete" aria-hidden="true"></i>-->
                          <span id="wizardPicturePreview-delete" aria-hidden="true" style="color: red">Delete</span>
                        </div>
                        <div class="col-md-8">
                          @if(is_null($pages->page_title))
                          <input type="text" name="judul" id="pagetitle" value="" class="form-control" placeholder="Masukkan judul" style="margin-bottom: 5px">
                          @else
                          <input type="text" name="judul" id="pagetitle" value="{{$pages->page_title}}" class="form-control" placeholder="Masukkan judul" style="margin-bottom: 5px">
                          @endif
                          <textarea id="description" name="description" class="form-control" style="margin-bottom: 5px;resize: none;" rows="3" cols="53" maxlength="80" wrap="hard" placeholder="Max 80 character" no-resize><?php if(!is_null($pages->description)) { 
                            echo $pages->description;
                          }?></textarea>
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
                          <div class="contentBanner mb-4">
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
                                      //loadPixel('{{$ban->pixel_id}}','.bannerpixel-{{$ban->id}}');
                                      $(".bannerpixel-{{$ban->id}}").html(dataView);
                                      $(".bannerpixel-{{$ban->id}}").val('{{$ban->pixel_id}}');
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

                    <div class="col-md-12">
                      <input type="hidden" name="modeBackground" id="modeBackground" value="gradient">
                      <input type="hidden" name="backtheme" id="backtheme" value="colorgradient1">
                      <input type="hidden" name="wallpaperclass" id="wallpaperclass" value="wallpaper1">
                      <input type="hidden" name="animationclass" id="animationclass" value="animation1">
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
                                  <button class="btn btn-primary btn-apply-btn" type="button" data-dismiss="modal">Apply</button>
                                  <button type="button" data-dismiss="modal" class="btn" >Close </button>
                                </div>
                            </div>
                        </div>
                      </div>  

                      <div class="row mb-4">
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
                                        <input type="text" id="colorOutlineButton" name="colorOutlineButton" value="#ffffff">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-primary btn-apply-out" type="button" data-dismiss="modal" >Apply </button>
                                  <button type="button" data-dismiss="modal" class="btn" >Close </button>
                                </div>
                            </div>
                        </div>
                      </div>  
                      
                      <div class="row mb-4">
                        <div class="col-md-2 col-3">
                          <label class="switch">
                            <input type="checkbox" name="is_text_color" id="is_text_color" class="is_text_color" value="<?php if($pages->is_text_color) echo '1'; ?>" <?php if($pages->is_text_color) echo 'checked'; ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                        <div class="col-md-4 col-4">
                          <label class="caption">
                            Text Color
                          </label>
                        </div>
                        <div class="col-md-4 col-4">
                          <a href="" id="link-text-color" class="nav-link p-0">Custom Color</a>
                        </div>
                      </div>
                      <!-- Modal For Color Picker Button-->
                      <div class="modal fade" id="modal-color-picker-text-color" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    Choose Text Color 
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-md-4 col-xs-4">
                                      <div align="center">
                                        <div id="colorpickerTextColor"></div>
                                        <input type="text" id="textColor" name="textColor" value="#ffffff">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-primary btn-apply-text" type="button" data-dismiss="modal" >Apply </button>
                                  <button type="button" data-dismiss="modal" class="btn" >Close </button>
                                </div>
                            </div>
                        </div>
                      </div>  
                      <div class="row">
                        <div class="col-md-2 col-3">
                          <label class="switch">
                            <input type="checkbox" name="powered" id="powered" value="<?php if($pages->powered) echo '1'; ?>" <?php if($pages->powered) echo 'checked'; ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                        <div class="col-md-4 col-4">
                          <label class="caption">
                            Powered By Omnilinks
                          </label>
                        </div>
                        <div class="col-md-4 col-4">
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
                        <li class="nav-item sub-nav">
                          <a class="nav-link" href="#wallpaper" id="wallpaper-tab" role="tab" data-toggle="tab">Wallpaper</a>
                        </li>
                        <li class="nav-item sub-nav">
                          <a class="nav-link" href="#animation" id="animation-tab" role="tab" data-toggle="tab">Animation</a>
                        </li>
                      </ul>
                      <!-- Tab panes -->
                      <div class="tab-content mt-4 mb-4">

                        <!--theme color -->
                        <div role="tabpanel" class="tab-pane fade in active show" id="buzz">

                          <div class="theme mrgtp text-center">
                            @include('user.dashboard.background.theme-page')
                          </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="references">
                          <div align="center">
                            <div id="colorpicker"></div>
                            <input type="text" id="color" name="color" value="#ffffff">
                          </div>
                        </div>
                        

                        <div role="tabpanel" class="tab-pane fade" id="wallpaper">
                          <div align="center">
                            @include('user.dashboard.background.wallpaper-page')
                          </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="animation">
                          <select id="select-animation">
                            <option>bubble</option>
                            <option>bubble-up</option>
                            <option>cloud</option>
                            <option>confetti</option>
                            <option>disk</option>
                            <option>gradient</option>
                            <option>leaves</option>
                            <option>wave</option>
                            <option>waves</option>
                          </select>
                          <div align="center">
                            @include('user.dashboard.background.animation-page')
                          </div>
                        </div>

                        
                      </div>

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
                        <div class="div-picture" style="width: 82px; height: 82px; margin-left: 13px;<?php if(is_null($pages->image_pages)) echo 'display: none' ?>">
                          <?php  
                            $viewpicture = asset('/image/no-photo.jpg');
                            if(!is_null($pages->image_pages)){
                              // echo url(Storage::disk('local')->url('app/'.$pages->image_pages)); 
                              $viewpicture = Storage::disk('s3')->url($pages->image_pages);
                            }
                          ?>
                          <img id="viewpicture" src="<?php echo $viewpicture ?>" style="width:100%;height:100%;border-radius: 50%;object-fit: cover;object-position: center;" altSrc="{{asset('/image/no-photo.jpg')}}" onerror="this.src = $(this).attr('altSrc')">
                        </div>
                      </div>
                      <div class="col-md-10 col-8 p-2">
                        <ul style="margin-left: 23px; font-size: 11px;">
                          <li style="display: block; margin-bottom: -15px;  ">
                            <p class="font-weight-bold description" style="color: #fff;" id="outputtitle"></p>
                          </li>
                          <li style="display: block; margin-bottom: -15px; ">
                            <p class="font-weight-bold description" style="color: #fff; word-break: break-all;" id="outputdescription"></p>
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

                  <ul class="row links messengers links-num-1 "id="getview" style="margin-top: 12px; margin-left: 15px; margin-right: 10px;">
                    <li class="link col pl-1 pr-1 shown-mes hide" id="waviewid"> 
                      <a href="#" class="btn btn-md btnview txthov" style="width: 100%;font-size:11px;height: 40px;padding: 10px;" id="walinkview">
                        <i class="fab fa-whatsapp" style="font-size:14px;"></i>
                        <label class="" style="font-size:11px;">
                          Whatsapp
                        </label>
                      </a>
                    </li>
                    <li class="link col pl-1 pr-1 hide" id="telegramviewid" >
                      <a href="#" class="btn btn-md btnview txthov" style="
                      width: 100%;font-size:11px;height: 40px;padding: 10px;" id="telegramlinkview">
                        <i class="fab fa-telegram-plane" style="font-size:14px;"></i>
                        <label class="" style="font-size:11px;">
                          Telegram
                        </label>
                      </a>
                    </li> 
                    <li class="link col pl-1 pr-1 hide" id="skypeviewid" >
                      <a href="#" class="btn btn-md btnview txthov" style="
                      width: 100%;font-size:11px;height: 40px;padding: 10px;" id="skypelinkview">
                        <i class="fab fa-skype" style="font-size:14px;"></i>
                        <label class="" style="font-size:11px;">
                          Skype
                        </label>
                      </a>
                    </li>
                    <li class="link col pl-1 pr-1 hide" id="lineviewid" >
                      <a href="#" class="btn btn-md btnview txthov" style="
                      width: 100%;font-size:11px;height: 40px;padding: 10px;" id="linelinkview">
                        <i class="fab fa-line" style="font-size:14px;"></i>
                        <label class="" style="font-size:11px;">
                          Line
                        </label>
                      </a>
                    </li>
                    <li class="link col pl-1 pr-1 hide" id="messengerviewid" >
                      <a href="#" class="btn btn-md btnview txthov" style="
                      width: 100%;font-size:11px;height: 40px;padding: 10px;" id="messengerlinkview">
                        <i class="fab fa-facebook-messenger" style="font-size:14px;"></i>
                        <label class="" style="font-size:11px;">
                          Messenger
                        </label>
                      </a>
                    </li>
                  </ul>
                  <div class="row" style="font-size: xx-small; margin-left: 3px; margin-right: 2px; font-weight: 700;">
                    <ul class="col-md-12" id="viewLink" >
                      @if($links->count())
                      @foreach($links as $link)
                        <li id="link-preview-{{$link->id}}"><a href="#" class="btn btn-md btnview title-{{$link->id}}-view-update txthov" style="width: 100%;  padding-left: 2px;margin-bottom: 12px;" id="link-url-update-{{$link->id}}-get" >{{$link->title}}</a></li>
                      @endforeach
                      @else
                        <!--
                        <button type="button" class="btn btnview title-1-view-get" id="link-url-1-preview" style="width: 100%; margin-bottom: 12px;">masukkan link</button>
                        -->
                        <li id="link-url-1-preview" class=""><a href="#" class="btn btn-md btnview title-1-view-get txthov" style="width: 100%;  padding-left: 2px;margin-bottom: 12px;" id="link-url-update-1-preview" >masukkan link</a></li>
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

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- untuk preview di mobile -->
  <div class="preview-mobile preview-none">
  </div>

</section>

<!-- Modal Update Premium ID -->
<div class="modal fade" id="premium-id" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content content-premiumid">
      <div class="modal-header header-premiumid">
        <h5 class="modal-title font-premiumid big" id="modaltitle">
          Custom Premium ID
        </h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="form-premiumID">
          @csrf

          <input type="hidden" name="id" value="{{$pages->id}}">  

          <div class="form-group">
            <div class="col-12">
              ID Default
            </div>
            <div class="col-12">
              <input class="col-12 form-control" type="text" name="id_default" id="id_default" value="<?php echo env('SHORT_LINK').'/'.$pages->names ?>" readonly>
            </div>
          </div>

          <div class="form-group">
            <div class="col-12 font-premiumid">
              <b>Custom Premium ID</b>
            </div>
            <div class="col-auto">
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <?php echo env('SHORT_LINK').'/'; ?>
                  </div>
                </div>
                <input class="form-control" type="text" name="custom_id" id="custom_id" placeholder="YOURLINK" value="<?php if($pages->premium_id!=0) echo $pages->premium_names ?>"> 
              </div>
            </div>
          </div>
        </form>

        <div class="col-12 mb-4" style="margin-top: 30px">
          <button class="btn btn-success btn-block btn-premiumid" data-dismiss="modal">
            UPDATE LINK
          </button>  
        </div>
        
        <div class="col-12 text-center mb-4">
          <a href="#" data-dismiss="modal">
            Kembali
          </a>  
        </div>
        

      </div>
    </div>

  </div>
</div>

<!-- Modal Beli Premium ID -->
<div class="modal fade" id="premium-id-beli" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content content-premiumid">
      <div class="modal-header header-premiumid">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body text-center">
        <img src="{{asset('image/icon-premium-id.png')}}">
        <h5 class="font-premiumid big mt-3 mb-4">
          Custom Premium ID
        </h5>
        <p>Buat Customer Anda lebih mudah mengingat profile online shop Anda dengan custom premium ID</p>

        <div class="col-12 offset-lg-1 col-lg-10 mt-5 mb-5">
          <div class="row">
            <div class="col-lg-4 col-12 text-lg-left text-center">
              ID Default <br>
              <?php echo env('SHORT_LINK').'/YtBu8L' ?>
            </div>
            <div class="col-lg-4 col-12">
              <img class="arrow" src="{{asset('image/arrow-green.png')}}">
            </div>
            <div class="col-lg-4 col-12 text-lg-left text-center">
              <span class="font-premiumid">
                Custom Premium ID
              </span> <br>
              <b><?php echo env('SHORT_LINK').'/YOURLINK' ?></b>
            </div>  
          </div>
          
        </div>
        <div class="col-12 col-md-10 offset-md-1 mb-4" style="margin-top: 30px">
          <a href="{{url('pricing')}}" target="_blank">
            <button class="btn btn-success btn-block btn-beli-premium">
              BELI SEKARANG
            </button>    
          </a>
          
        </div>
        
        <div class="col-12 text-center mb-4">
          <a href="#" data-dismiss="modal">
            Lain Kali
          </a>  
        </div>
        

      </div>
    </div>

  </div>
</div>

<!-- Modal Delete Confirmation -->
<div class="modal fade" id="confirm-delete" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content content-premiumid">
      <div class="modal-header header-premiumid">
        <h5 class="modal-title" id="modaltitle">
          Confirmation Delete
        </h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body text-center">
        <input type="hidden" name="id_delete_link" id="id_delete_link">
        <input type="hidden" name="id_delete_pixel" id="id_delete_pixel">
        <input type="hidden" name="type" id="type">

        Apa Anda yakin untuk <i>menghapus</i> data berikut ?
        <br><br>
        <span class="txt-mode"></span>
        <br>
        
        <div class="col-12 mb-4" style="margin-top: 30px">
          <button class="btn btn-danger btn-block btn-delete-ok" data-dismiss="modal">
            YA, HAPUS SEKARANG
          </button>
        </div>
        
        <div class="col-12 text-center mb-4">
          <a href="#" data-dismiss="modal">
            Kembali ke Dashboard
          </a>  
        </div>
      </div>

    </div>   
  </div>
</div>

<!-- Modal Delete Success -->
<div class="modal fade" id="delete-success" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content content-premiumid">
      <div class="modal-header header-premiumid">
        <h5 class="modal-title" id="modaltitle">
          Delete Success
        </h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body text-center">
        <img id="img-success" src="{{asset('image/success.gif')}}" style="max-width: 100px"><br>
        <span class="txt-mode"></span>, berhasil <b>dihapus!</b><br>
        Anda akan diarahkan ke <i>Dashboard</i> dalam 3 detik

        <div class="col-12 text-center mb-4" style="margin-top: 30px">
          <a href="#" data-dismiss="modal">
            Ke Dashboard
          </a>  
        </div>
      </div>

    </div>   
  </div>
</div>

<!-- Modal Copy Link -->
<div class="modal fade" id="copy-link" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modaltitle">
          Copy Link
        </h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        Copy link berhasil!
      </div>
      <div class="modal-footer" id="foot">
        <button class="btn btn-primary" data-dismiss="modal">
          OK
        </button>
      </div>
    </div>
      
  </div>
</div>

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

  $('body').on('click', '.themes', function() {
    $('.themes').removeClass('selected');
    $(this).addClass('selected');
  });  

  $('body').on('click', '.wallpapers', function() {
    $('.wallpapers').removeClass('selected');
    $(this).addClass('selected');
  });  

  $('body').on('click', 'ul.nav-tabs', function() {
    if(!$('#pesanAlert').hasClass('alert-success')){
      $('#pesanAlert').hide();
    }
  });

  $( "body" ).on( "click", ".btn-copy", function(e) 
  {
    e.preventDefault();
    e.stopPropagation();

    //var id = $(this).attr("data-id");
    var link = $(this).attr("data-link");

    var tempInput = document.createElement("input");
    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
    tempInput.value = link;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);

    /*$(".link-"+id).select();
    document.execCommand("copy");*/
    $('#copy-link').modal('show');
  });

  $(document).ready(function() {
      loadLinkBio();
      dotsok();
      let inputtitle=$('#pagetitle');
      let outputtitle=$('#outputtitle');
      

      inputtitle.keyup(function(){
        outputtitle.text(inputtitle.val());
      });
      outputtitle.text(inputtitle.val());

      $('#description').keydown(function(e){
        newLines = $(this).val().split("\n").length;
        if(e.keyCode == 13 && newLines >= 3) {
          return false;
        }
        else {
          tempStr = $(this).val().replace(/\n/g, "<br>");;
          $('#outputdescription').html(tempStr);
        }
      });
      $('#description').keyup(function(e){
        tempStr = $(this).val().replace(/\n/g, "<br>");;
        $('#outputdescription').html(tempStr);
      });
      tempStr = $('#description').val().replace(/\n/g, "<br>");;
      $('#outputdescription').html(tempStr);

      
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
    $('#powered').click(function() {
      check_powered();
    });
    $('#is_click_bait').click(function() {
      check_click_bait();
    });
    $('#is_text_color').click(function() {
      check_text_color();
      onTextColorChange($("#textColor").val());
    });
    /*$("#powered").click(function(){
      if ($(this).prop("checked")==true) {
        $("#poweredview").children().show();
      }
      else if($(this).prop("checked")==false){
        $("#poweredview").children().hide(); 
      }
    });*/
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
    $(document).on('click', '#wallpaper-tab', function() {
      $('#modeBackground').val('wallpaper');
      $("#phonecolor").removeClass();
      $("#phonecolor").addClass("screen "+$('#wallpaperclass').val());
    });
    $(document).on('click', '#animation-tab', function() {
      $('#modeBackground').val('animation');
      $("#phonecolor").removeClass();
      $("#phonecolor").addClass("screen "+$('#animationclass').val());
    });
    $(document).on('click', '.btn-premiumid', function() {
      tambah_premiumid();
    });
    $(document).on('click', '.btn-premium', function() 
    {
      <?php if(Auth::user()->membership=='free') { ?>
        $('#premium-id-beli').modal('show');
      <?php } else { ?>
        $('#premium-id').modal('show');
      <?php } ?>
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
    <?php if (!is_null($pages->wallpaper)) { ?>
      $('#wallpaperclass').val("<?php echo $pages->wallpaper; ?>");
      $("#wallpaper-tab").click();
    <?php } ?>
    <?php if (!is_null($pages->gif_template)) { ?>
      $('#animationclass').val("<?php echo $pages->gif_template; ?>");
      $("#animation-tab").click();
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
      $('.description').css("color",outline);
    <?php } else {?>
      $('.btnview').css("background-color",outline);
      $('.btnview').css("color","#fff");
      $('.description').css("color","#fff");
    <?php } ?>
    
    <?php if($pages->is_text_color) {?>
      //$(".mobile1").addClass("outlinedview");
      $("#textColor").val("<?php echo $pages->text_color; ?>");
      $('.btnview').css("color","<?php echo $pages->text_color; ?>");
      $('.description').css("color","<?php echo $pages->text_color; ?>");
    <?php } else {?>
      $('.btnview').css("color","#fff");
      $('.description').css("color","#fff");
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
      $("#phonecolor").removeClass();
      $("#phonecolor").addClass("screen");
      $("#phonecolor").css("background-color",color);
      $("#backtheme").val();
      $("#color").val(color);
    }
    $('#colorpicker').farbtastic('#color');
    pickerbg = $.farbtastic('#colorpicker');
    // picker.setColor("#b6b6ff");
    $("#color").on('keyup', function() {
      pickerbg.setColor($(this).val());
    });
    pickerbg.linkTo(onColorChange);
    
    //for background color button purpose 
    function onColorButtonChange(color) {
      /*$("#colorButton").val(color);
      $('.btnview').css("background-color",color);*/
      $("#colorButton").val(color);
      if ($('input[name="outlined"]').val()=="1") {
        $('.btnview').css("background-color",'transparent');
      } else {
        $('.btnview').css("background-color",color);
      }
    }
    $('#colorpickerButton').farbtastic('#colorButton');
    pickerbtn = $.farbtastic('#colorpickerButton');
    // picker.setColor("#b6b6ff");
    $("#colorButton").on('keyup', function() {
      pickerbtn.setColor($(this).val());
    });
    // pickerbtn.linkTo(onColorButtonChange);
    $("#link-custom-background-color").on('click', function(e) {
      e.preventDefault();
      $('#modal-color-picker-button').modal('toggle');
    });
    $(document).on('click', '.btn-apply-btn', function() {
      onColorButtonChange($("#colorButton").val());
    });
    
    //modal-color-picker-outline-button colorpickerOutlineButton colorOutlineButton
    //for button purpose colorpickerButton colorButton
    function onOutlineColorButtonChange(color) {
      $("#colorOutlineButton").val(color);
      // $('.btnview').css("border-color",color);
      if ($('input[name="outlined"]').val()=="1") {
        //$(".mobile1").addClass("outlinedview");
        $(".screen").addClass("outlinedview");
        //$('.btnview').css("background-color","transparent");
        //$('.btnview').css("color",color);
        if ($('#is_text_color').prop("checked") == false) {
          $('.btnview').css("border-color",color);
        } else {
          $('.btnview').css("border-color",$('#textColor').val());
        }
        
      } else {
        //$('.btnview').css("background-color",color);
        //$('.btnview').css("color","#fff");
        $('.btnview').css("border-color","transparent");
      }
      $('.btnview').css("color",color);
      $('.description').css("color",color);
    }
    $('#colorpickerOutlineButton').farbtastic('#colorOutlineButton');
    pickerout = $.farbtastic('#colorpickerOutlineButton');
    // picker.setColor("#b6b6ff");
    $("#colorOutlineButton").on('keyup', function() {
      pickerout.setColor($(this).val());
    });
    //pickerout.linkTo(onOutlineColorButtonChange);
    $("#link-custom-outline-color").on('click', function(e) {
      e.preventDefault();
      $('#modal-color-picker-outline-button').modal('toggle');
    });
    $(document).on('click', '.btn-apply-out', function() {
      onOutlineColorButtonChange($("#colorOutlineButton").val());
    });
    
    // for all text color purpose
    function onTextColorChange(color) {
      $("#textColor").val(color);
      if ($('#is_text_color').val()=="1") {
        $('.btnview').css("color",color);
        $('.description').css("color",color);
      } else {
        $('.btnview').css("color","#fff");
        $('.description').css("color","#fff");
      }
    }
    $('#colorpickerTextColor').farbtastic('#textColor');
    pickerbtn = $.farbtastic('#colorpickerTextColor');
    // picker.setColor("#b6b6ff");
    $("#textColor").on('keyup', function() {
      pickerbtn.setColor($(this).val());
    });
    //pickerbtn.linkTo(onTextColorChange);
    $("#link-text-color").on('click', function(e) {
      e.preventDefault();
      $('#modal-color-picker-text-color').modal('toggle');
    });
    $(document).on('click', '.btn-apply-text', function() {
      onTextColorChange($("#textColor").val());
    });

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
          $('#viewpicture').attr('src', e.target.result).fadeIn('slow');

          $('.div-picture').show();
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

        
        if ($('#is_text_color').prop("checked") == false) {
          $(this).parent().children().css("background-color",temp1);
          $(this).parent().children().css("color",temp2);
        } else {
          $(this).parent().children().css("background-color",$('#textColor').val());
          $(this).parent().children().css("color",$("#phonecolor").css("background-color"));
        }

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
      $('#pesanAlert').removeClass('alert-danger');
      $('#pesanAlert').children().remove();
    });
    
    $("body").on("click", "#addBanner", function() {
      idpic+=1;
      let $el;
      elhtml = '<div class="div-table list-banner mb-4" picture-id="picture-id-'+idpic+'"><div class="div-cell"><input type="text" name="judulBanner[]" value="" class="form-control" placeholder="Judul banner"><input type="hidden" name="idBanner[]" value=""><input type="hidden" name="statusBanner[]" class="statusBanner" value=""><input type="text" name="linkBanner[]" value="" class="form-control" placeholder="masukkan link"><select name="bannerpixel[]"  class="form-control bannerpixel banner-new"></select><div class="custom-file"><input type="file" name="bannerImage[]" class="custom-file-input pictureClass" id="input-picture-'+idpic+'" aria-describedby="inputGroupFileAddon01"><label class="custom-file-label" for="inputGroupFile01">Choose file</label></div></div><div class="div-cell cell-btn btn-deleteBanner"><span><i class="far fa-trash-alt"></i></span></div></div>';
      $el = $(".div-banner").append(elhtml);
      $(".banner-new").html(dataView);
      $(".banner-new").val(0);
       // loadPixel(0,'.banner-new');
      if ($('.list-banner').length==5) {
         $(this).attr('disabled', 'disabled'); 
      }
      let countbanner=$('.mySlides').length;
      
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
      /*if (confirm('anda yakin ingin menghapus pixel ini')) {
        var idpixel = $(this).attr('dataid');
        delete_pixel(idpixel);
      }*/
      $('#id_delete_pixel').val($(this).attr('dataid'));
      $('#type').val('pixel');
      $('.txt-mode').html('Pixel');
      $('#confirm-delete').modal('show');
    });

    $("body").on("click", ".btn-deletewa", function() {
      /*if (confirm('anda yakin ingin menghapus walink ini')) {
        var idwalink = $(this).attr('dataidwa');
        deletewalink(idwalink);
      }*/
      $('#id_delete_link').val($(this).attr('dataidwa'));
      $('#type').val('wa');
      $('.txt-mode').html('WhatsApp');
      $('#confirm-delete').modal('show');
    });

    $("body").on("click", ".btn-delete-ok", function() {
      if($('#type').val()=='pixel'){
        delete_pixel($('#id_delete_pixel').val());
      } else {
        deletewalink($('#id_delete_link').val());
      }
    });

    $(document).on('click', '#generate', function(e) {
      var nomor = '0'+$('#nomorwa').val();
      var message = $('#pesan-wa').val();
      var convert = encodeURI(message);
      var link = "https://api.whatsapp.com/send?phone=" + nomor + "&text=" + convert + "";
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
    check_rounded();
    check_powered();
    check_click_bait();
    check_text_color();
    check_outlined();

    <?php 
      if(is_null($pages->image_pages)){
    ?>
      $("#wizardPicturePreview-delete").hide();
    <?php }
    ?>
    
    $('#select-animation').selectize({
      sortField: 'text',
      onChange: function(value) {
        if (value=="bubble"){
          $(".animation-thumb").hide();
          $(".animation-bubble").show();
        }
        if (value=="bubble-up"){
          $(".animation-thumb").hide();
          $(".animation-bubble-up").show();
        }
        if (value=="cloud"){
          $(".animation-thumb").hide();
          $(".animation-cloud").show();
        }
        if (value=="confetti"){
          $(".animation-thumb").hide();
          $(".animation-confetti").show();
        }
        if (value=="disk"){
          $(".animation-thumb").hide();
          $(".animation-disk").show();
        }
        if (value=="gradient"){
          $(".animation-thumb").hide();
          $(".animation-gradient").show();
        }
        if (value=="leaves"){
          $(".animation-thumb").hide();
          $(".animation-leaves").show();
        }
        if (value=="wave"){
          $(".animation-thumb").hide();
          $(".animation-wave").show();
        }
        if (value=="waves"){
          $(".animation-thumb").hide();
          $(".animation-waves").show();
        }
      }
    });    
    $(".animation-thumb").hide();
    $(".animation-bubble").show();
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
