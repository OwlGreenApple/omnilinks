@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/dash.css')}}">
<link rel="stylesheet" href="{{asset('css/farbtastic.css')}}">
<link rel="stylesheet" href="{{asset('css/theme.css')}}">

<script type="text/javascript">
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
      success: function(data) {
                //var data=jQuery.parseJSON(result);
                if (data.status == "success") {
                  $("#pesan").html(data.message);
                  $("#pesan").addClass("alert-success");
                  $("#pesan").show();
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
      success: function(result) {
        refreshwa();
        refreshpixel();
        var data = jQuery.parseJSON(result);
        if (data.status == "success") {
          $("#pesan").html(data.message);
          $("#pesan").addClass("alert-success");
          $("#pesan").show();
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
      success: function(result) {
        $('#script').val("");
        $('#judul').val("");
        $('#editidpixel').val("");
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
      success: function(result) {
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
      success: function(result) {
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
      success: function(result) {
        var data = jQuery.parseJSON(result);
        if (data.status == 'success') {
          refreshpixel();
        }
      }
    });
  }

  function loadPixelPage() {
    $.ajax({
      type: 'GET',
      url: "<?php echo url('/load/pixelpage');?>",
      dataType: 'text',
      success: function(result) {
        var data = jQuery.parseJSON(result);
        $('#wapixel').html(data.view);
        $('#telegrampixel').html(data.view);
        $('#skypepixel').html(data.view);
        $('#youtubepixel').html(data.view);
        $('#fbpixel').html(data.view);
        $('#igpixel').html(data.view);
        $('#twitterpixel').html(data.view);
        $('.bannerpixel').html(data.view);
      }
    });
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
      success: function(result) {
        $('#nomorwa').val("");
        $('#pesan-wa').val("");
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
      success: function(result) {
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
      success: function(result) {
        var data = jQuery.parseJSON(result);
        if (data.status == 'success') {
          refreshwa();
        }
      }
    });
  }

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
        $('#viewpicture').attr('src', e.target.result).fadeIn('slow');
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $(document).ready(function() {
    loadPixelPage();
    refreshpixel();
    refreshwa();

    $('.infooter').remove();

    $(".sortable-msg").sortable({
      handle: '.handle',
      cursor: 'move',
      axis: 'y',
      stop: function(event, ui) {
        var data = $(this).sortable('serialize');
        //save_order(data);
      }
    });
    $(".sortable-msg").disableSelection();
    //$( ".sortable-msg" ).draggable();

    $(".sortable-link").sortable({
      handle: '.handle',
      cursor: 'move',
      axis: 'y',
      stop: function(event, ui) {
        var data = $(this).sortable('serialize');
        //save_order(data);
      }
    });
    $(".sortable-link").disableSelection();
    //$( ".sortable-link" ).draggable();

    $(".sortable-sosmed").sortable({
      handle: '.handle',
      cursor: 'move',
      axis: 'y',
      stop: function(event, ui) {
        var data = $(this).sortable('serialize');
        //save_order(data);
      }
    });
    $(".sortable-sosmed").disableSelection();

    $('#colorpicker').farbtastic('#colour');
    //$.farbtastic('#colorpicker','.screen');
    //$('#colorpicker').farbtastic('.screen');

    $("#wizard-picture").on('change', function() {
      readURL(this);
    });
  });
</script>

<section id="tabs" class="project-tab">
  <div class="container">
    <div class="row notif">
      <div class="col-md-12">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          Masa trial anda akan berakhir dalam 5 hari. <span style="color:blue;">Subscribe</span> untuk terus menggunakan Omnilinks
        </div>
      </div>

      <div class="col-md-6">
        <div id="pesan" class="alert"></div>
        <div id="pesanAlert" class="alert"></div>

        <div class="card carddash" style="margin-bottom:20px;">
          <div class="card-body">
            <ul class="mb-4 nav nav-tabs">
              <li class="nav-item">
                <a href="#link" class="active nav-link link" role="tab" data-toggle="tab">
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
                <a href="#style" class="nav-link link" role="tab" data-toggle="tab">
                  Tampilan
                </a>
              </li>
            </ul>

            <div class="tab-content">

              <!-- tab 1-->
              <div role="tabpanel" class="tab-pane fade in active show" id="link">
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

                  <div class="hid">
                    <ul class="sortable-msg">
                      <li id="msg-wa">
                        <div id="wa" class="messengers div-table">
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
                                <input type="text" name="wa" class="form-control" value="{{$pages->wa_link}}" id="inlineFormInputGroupUsername" onkeypress="return hanyaAngka(event)" placeholder="masukkan nomor whatsapp">
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

                      <li id="msg">
                        <div id="telegram" class="messengers div-table hidden" style=" display:none;">
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
                                <input type="text" name="telegram" class="form-control" id="inlineFormInputGroupUsername" value="{{$pages->telegram_link}}" placeholder="masukkan nomor telegram">
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

                      <li id="msg">
                        <div id="skype" class="messengers div-table hidden" style=" display:none;">
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
                                <input type="text" name="skype" onkeypress="return hanyaAngka(event)" class="form-control" id="inlineFormInputGroupUsername" value="{{$pages->skype_link}}" placeholder="masukkan nomor Skype">
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

                  <div>
                    <ul class="sortable-link a">
                      @if($links->count())
                        @foreach($links as $link)
                          <li class="link-list">
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

                                    <input type="text" name="title[]" value="{{$link->title}}" placeholder="Title" class="form-control">
                                    <input type="text" name="url[]" value="{{$link->link}}" placeholder="http://url..." class="form-control">
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
                        @endforeach
                      @else 
                        <li class="link-list">
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
                                  <input type="text" name="title[]" value="" placeholder="Title" class="form-control">
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
                      @endif
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
                    @if(is_null($pages->youtube_link))
                    <li id="sosmed-youtube">
                      <div id="youtube" class="socialmedia">
                        <div class="row">
                          <div class="col-md-1 col-1 pl-md-3 pl-2">
                            <span class="handle">
                              <i class="fas fa-bars"></i>
                            </span>
                          </div>

                          <div class="col-md-11 col-11">
                            <div class="input-group margin">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <i class="fab fa-youtube"></i>
                                </div>
                              </div>
                              <input type="text" name="youtube" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan channel youtube url">
                              <button id="deleteyoutube" class="btn btn-primary" type="button">
                                <i class="fas fa-trash-alt"></i>
                              </button>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="offset-md-1 col-md-11 offset-1 col-11">
                            <select name="youtubepixel" id="youtubepixel" class="form-control">
                            </select>
                          </div>
                        </div>
                      </div>
                    </li>
                    @else
                    <li id="sosmed-youtube">
                      <div id="youtube" class="socialmedia">
                        <div class="row">
                          <div class="col-md-1 col-1 pl-md-3 pl-2">
                            <span class="handle">
                              <i class="fas fa-bars"></i>
                            </span>
                          </div>

                          <div class="col-md-11 col-11">
                            <div class="input-group margin">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <i class="fab fa-youtube"></i>
                                </div>
                              </div>
                              <input type="text" name="youtube" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan channel youtube url" value="{{$pages->youtube_link}}">
                              <button id="deleteyoutube" class="btn btn-primary" type="button">
                                <i class="fas fa-trash-alt"></i>
                              </button>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="offset-md-1 col-md-11 offset-1 col-11">
                            <select name="youtubepixel" id="youtubepixel" class="form-control">
                            </select>
                          </div>
                        </div>
                      </div>
                    </li>
                    @endif

                    @if(is_null($pages->fb_link))
                    <li id="sosmed">
                      <div id="fb" class="socialmedia hidden" style="display:none;" data-type="fb">
                        <div class="row">
                          <div class="col-md-1 col-1 pl-md-3 pl-2">
                            <span class="handle">
                              <i class="fas fa-bars"></i>
                            </span>
                          </div>

                          <div class="col-md-11 col-11">
                            <div class="input-group margin">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <i class="fab fa-facebook-f"></i>
                                </div>
                              </div>
                              <input type="text" name="fb" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan username facebook">
                              <button id="deletefb" class="btn btn-primary" type="button">
                                <i class="fas fa-trash-alt"></i>
                              </button>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="offset-md-1 col-md-11 offset-1 col-11">
                            <select name="fbpixel" id="fbpixel" class="form-control"></select>
                          </div>
                        </div>
                      </div>
                    </li>
                    @else
                    <li id="sosmed">
                      <div id="fb" class="socialmedia" data-type="fb">
                        <div class="row">
                          <div class="col-md-1 col-1 pl-md-3 pl-2">
                            <span class="handle">
                              <i class="fas fa-bars"></i>
                            </span>
                          </div>

                          <div class="col-md-11 col-11">
                            <div class="input-group margin">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <i class="fab fa-facebook-f"></i>
                                </div>
                              </div>
                              <input type="text" name="fb" class="form-control" value="{{$pages->fb_link}}" id="inlineFormInputGroupUsername" placeholder="masukkan username facebook">
                              <button id="deletefb" class="btn btn-primary" type="button">
                                <i class="fas fa-trash-alt"></i>
                              </button>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="offset-md-1 col-md-11 offset-1 col-11">
                            <select name="fbpixel" id="fbpixel" class="form-control"></select>
                          </div>
                        </div>
                      </div>
                    </li>
                    @endif

                    @if(is_null($pages->twitter_link))
                    <li id="sosmed">
                      <div id="twitter" class="socialmedia hidden" style=" display:none;" data-type="twitter">
                        <div class="row">
                          <div class="col-md-1 col-1 pl-md-3 pl-2">
                            <span class="handle">
                              <i class="fas fa-bars"></i>
                            </span>
                          </div>

                          <div class="col-md-11 col-11">
                            <div class="input-group margin">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <i class="fab fa-twitter"></i>
                                </div>
                              </div>
                              <input type="text" name="twitter" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan username twitter">
                              <button id="deletetwitter" class="btn btn-primary" type="button">
                                <i class="fas fa-trash-alt"></i>
                              </button>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="offset-md-1 col-md-11 offset-1 col-11">
                            <select name="twitterpixel" id="twitterpixel" class="form-control">
                            </select>
                          </div>
                        </div>
                      </div>
                    </li>
                    @else
                    <li id="sosmed">
                      <div id="twitter" class="socialmedia hidden" data-type="twitter">
                        <div class="row">
                          <div class="col-md-1 col-1 pl-md-3 pl-2">
                            <span class="handle">
                              <i class="fas fa-bars"></i>
                            </span>
                          </div>

                          <div class="col-md-11 col-11">
                            <div class="input-group margin">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <i class="fab fa-twitter"></i>
                                </div>
                              </div>
                              <input type="text" name="twitter" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan username twitter" value="{{$pages->twitter_link}}">
                              <button id="deletetwitter" class="btn btn-primary" type="button">
                                <i class="fas fa-trash-alt"></i>
                              </button>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="offset-md-1 col-md-11 offset-1 col-11">
                            <select name="twitterpixel" id="twitterpixel" class="form-control">
                            </select>
                          </div>
                        </div>
                      </div>
                    </li>
                    @endif

                    @if(is_null($pages->ig_link))
                    <li id="sosmed">
                      <div id="ig" class="socialmedia hidden" style="display: none;" data-type="ig">
                        <div class="row">
                          <div class="col-md-1 col-1 pl-md-3 pl-2">
                            <span class="handle">
                              <i class="fas fa-bars"></i>
                            </span>
                          </div>
                          <div class="col-md-11 col-11">
                            <div class="input-group margin">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <i class="fab fa-instagram"></i>
                                </div>
                              </div>
                              <input type="text" name="ig" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan username instagram">
                              <button id="deleteig" class="btn btn-primary" type="button">
                                <i class="fas fa-trash-alt"></i>
                              </button>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="offset-md-1 col-md-11 offset-1 col-11">
                            <select name="igpixel" id="igpixel" class="form-control">
                            </select>
                          </div>
                        </div>
                      </div>
                    </li>
                    @else
                    <li id="sosmed">
                      <div id="ig" class="socialmedia " data-type="ig">
                        <div class="row">
                          <div class="col-md-1 col-1 pl-md-3 pl-2">
                            <span class="handle">
                              <i class="fas fa-bars"></i>
                            </span>
                          </div>
                          <div class="col-md-11 col-11">
                            <div class="input-group margin">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <i class="fab fa-instagram"></i>
                                </div>
                              </div>
                              <input type="text" name="ig" class="form-control" value="{{$pages->ig_link}}" id="inlineFormInputGroupUsername" placeholder="masukkan username instagram">
                              <button id="deleteig" class="btn btn-primary" type="button">
                                <i class="fas fa-trash-alt"></i>
                              </button>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="offset-md-1 col-md-11 offset-1 col-11">
                            <select name="igpixel" id="igpixel" class="form-control">
                            </select>
                          </div>
                        </div>
                      </div>
                    </li>
                    @endif
                  </ul>

                  <div class="as">
                    <button type="button" id="btn-save-link" class="btn btn-primary btn-biolinks ">
                      <i class="far fa-save" style="margin-right:5px;"></i>
                      SAVE
                    </button>
                  </div>
                </form>
              </div>

              <!-- TAB 2 -->
              <div role="tabpanel" class="tab-pane fade " id="walink">
                <form id="savewalink" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="uuidpixel" value="{{$uuid}}">
                  <span class="blue-txt">
                    WhatsApp Link Creator
                  </span>
                  <br>
                  <span>
                    Masukkan Nomor WA
                  </span>
                  <input type="number" name="nomorwa" id="nomorwa" class="">
                  <button type="reset" class="btn btn-danger btn-reset" style="margin-top: 10px; margin-bottom: 10px;">
                    Reset
                  </button>
                  <div class="card">
                    <span class="card-header">
                      Masukkan Pesan
                    </span>
                    <textarea class="card-body form-control" name="pesan" id="pesan-wa"> </textarea>
                  </div>
                  <input type="text" name="editidwa" hidden="" id="editidwa">
                  <textarea id="demo" hidden="" name="textlink"></textarea>
                  <button type="button" class="btn btn-primary btn-biolinks" id="generate" style="margin-top: 20px;">
                    SAVE & CREATE LINK
                  </button>
                </form>

                <div class="margin" style="margin-top: 47px;">
                  <span class="blue-txt">
                    Recent WhatsApp Link Creator
                  </span>
                  <div class="accordion" id="accordionExample">
                    <div id="contentwa"></div>
                  </div>
                </div>
              </div>

              <!-- TAB 3 -->
              <div class="tab-pane fade" id="pixel">
                <form id="savepixel" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="uuidpixel" value="{{$uuid}}">
                  <input type="hidden" name="idpage" id="idpage" value="{{$pageid}}">
                  <span class="blue-txt">
                    Pixel Retargetting
                  </span>
                  <textarea class="card-body form-control" name="script" id="script"></textarea>

                  <div class="title" style="margin-top: 20px;">
                    <span>Title</span>
                    <input type="text" name="title" placeholder="Masukkan Judul" id="judul">
                    <input type="text" name="editidpixel" hidden id="editidpixel">
                    <button type="button" id="btnpixel" class="btn btn-primary">
                      Save
                    </button>
                    <button type="reset" class="btn btn-warning btn-reset">
                      Reset
                    </button>
                  </div>
                </form>

                <hr class="own">

                <span class="blue-txt">
                  Recent Pixel Retargetting
                </span>
                <div class="accordion" id="accordionExample">
                  <div id="content"></div>
                </div>
              </div>

              <!-- TAB 4 -->
              <div role="tabpanel" class="tab-pane fade" id="style">
                <form method="post" id="saveTemplate" enctype="multipart/form-data">

                  {{ csrf_field() }}
                  <input type="hidden" name="uuidtemp" value="{{$uuid}}">
                  <div class="form-group">
                    <div class="container">
                      <div class="row mt-5">
                        <div class="col-md-4 picture-container">
                          <div class="picture">
                            <img src="https://institutogoldenprana.com.br/wp-content/uploads/2015/08/no-avatar-25359d55aa3c93ab3466622fd2ce712d1.jpg" class="picture-src" id="wizardPicturePreview" title="">
                            <input type="file" name="imagepages" id="wizard-picture" class="" accept=".png, .jpg">
                          </div>
                        </div>
                        <div class="col-md-8">
                          @if(is_null($pages->page_title))
                          <input type="text" name="judul" ng-model="pagetitle" value="" class="form-control" placeholder="Masukkan judul" style="margin-bottom: 5px">
                          @else
                          <input type="text" name="judul" ng-model="pagetitle" value="{{$pages->page_title}}" class="form-control" placeholder="Masukkan judul" style="margin-bottom: 5px">
                          @endif
                          @if(is_null($pages->link_utama))
                          <input type="text" name="link" value="" ng-model="pagelink" class="form-control" placeholder="masukkan link" style="margin-bottom: 5px">
                          @else
                          <input type="text" name="link" ng-model="pagelink" value="{{$pages->link_utama}}" class="form-control" placeholder="masukkan link" style="margin-bottom: 5px">
                          @endif
                          @if(is_null($pages->telpon_utama))
                          <input type="number" name="nomor" ng-model="telpon" value="" class="form-control" placeholder="masukkan nomor" style="margin-bottom: 5px">
                          @else
                          <input type="number" name="nomor" ng-model="telpon" value="{{$pages->telpon_utama}}" class="form-control" placeholder="masukkan nomor" style="margin-bottom: 5px">
                          @endif
                        </div>
                        <div class="col-md-12 mt-4">
                          <button type="button" class="float-right mb-3 btn btn-primary btn-sm" id="addBanner"><i class="fas fa-plus"></i>
                          </button>
                          <span class="blue-txt">
                            Banner Promo
                          </span>

                          <div class="contentBanner mb-5">
                            <div class="c">
                              @foreach($banner as $banner)
                              <input type="text" name="judulBanner[]" value="{{$banner->title}}" class="form-control" placeholder="Judul banner">
                              <input type="text" name="linkBanner[]" value="{{$banner->link}}" class="form-control" placeholder="masukkan link">
                              <select name="bannerpixel[]" id="bannerpixel" class="form-control bannerpixel">
                              </select>
                              <input type="file" name="bannerImage[]" value="Upload">
                              <button class="btn btn-primary btn-deleteBanner"><i class="fa fa-trash-alt"></i></button>
                              @endforeach
                              <input type="text" name="judulBanner[]" value="" class="form-control" placeholder="Judul banner">
                              <input type="text" name="linkBanner[]" value="" class="form-control" placeholder="masukkan link">
                              <select name="bannerpixel[]" id="bannerpixel" class="form-control bannerpixel">
                              </select>
                              <input type="file" name="bannerImage[]" value="Upload">
                              <button class="btn btn-primary btn-deleteBanner"><i class="fa fa-trash-alt"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <input type="text" name="backtheme" id="backtheme" readonly="true" hidden="" value="colorgradient1">
                    <p class="blue-txt">
                      Theme
                    </p>
                    <label class="switch">
                      <input type="checkbox" name="rounded" class="rounded" value="rounded-p">
                      <span class="slider round"></span>
                    </label>&nbsp;Rounded buttons<br>
                    <label class="switch">
                      <input type="checkbox" name="outlined" class="outlined" value="outlined">
                      <span class="slider round"></span>
                    </label>&nbsp; Outlined buttons
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

                          <div class="theme mrgtp">
                            @include('user.dashboard.theme-page')
                          </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="references">
                          <div align="center">
                            <div id="colorpicker"></div>
                            <input type="text" id="colour" name="colour" value="#123456" readonly="">
                          </div>
                        </div>
                      </div>
                      <label class="switch mb-4">
                        <input type="checkbox" name="powered" id="powered" value="powered" checked="">
                        <span class="slider round"></span>
                      </label> &nbsp; Powered By Omnilinks<br>
                      <button type="button" class="btn btn-primary btn-biolinks" id="savetemp"><i class="far fa-save" style="margin-right:5px;"></i>SAVE</button>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>

      <!--phone-->
      <div class="col-md-6">
        <div class="fixed">
          <div class="center">
            <div class="mobile">
              <div class="mobile1">
                <div class="screen colorgradient1" id="phonecolor" style="border:none;">
                  <!--screen-->
                  <header class="container  " style="padding-top: 33px; padding-bottom: 12px;">
                    <div class="row">
                      <div class="col-md-2 col-3">
                        <img id="viewpicture" src="https://pngimage.net/wp-content/uploads/2018/06/no-avatar-png.png" style="border-radius: 50%; width: 82px; height: 82px; margin-left: 13px;">

                      </div>
                      <div class="col-md-7 col-8 p-2">
                        <ul style="margin-left: 23px;">
                          <li style="display: block; margin-bottom: -15px;">
                            <p class="font-weight-bold" style="color: #fff;">@{{pagetitle}}</p>
                          </li>
                          <li style="display: block; margin-bottom: -15px; ">
                            <p class="font-weight-bold" style="color: #fff;">@{{pagelink}}</p>
                          </li>
                          <li style="display: block;">
                            <p class="font-weight-bold" style="color: #fff;">@{{telpon}}</p>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </header>
                  <div class="col-md-12">
                    <div class="slideshow-container">
                      <div class="ap">
                        <div class="mySlides fit">
                          <img src="https://cdn.pixabay.com/photo/2016/04/15/04/02/water-1330252__340.jpg" class="imagesize">
                        </div>

                        <div class="mySlides fit">

                          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTXORJaE09hY_hdP0CLQlNGczblJC4fMluQJQIAEVHFYs_58MFC" class="imagesize"> 

                        </div>

                        <div class="mySlides fit">

                          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRNL6cJAzJjtpG83icr-1rMhNvRDAp1eDH80z826LwYjmgFo8XQ" class="imagesize" >

                        </div>

                      </div>
                      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                      <a class="next" onclick="plusSlides(1)">&#10095;</a>

                    </div>
                    <br>

                    <div style="text-align:center ; margin-top: -25px;">
                      <span class="dot" onclick="currentSlide(1)"></span> 
                      <span class="dot" onclick="currentSlide(2)"></span> 
                      <span class="dot" onclick="currentSlide(3)"></span> 
                    </div>
                  </div>
                  <div class="row rows" style="font-size: xx-small; margin-top: 12px;">
                    <div class="col-md-4">
                      <button type="button" class="btn btn-md btnview btn-light" style="margin-left: 19px;
                      width: 100%; margin-bottom: 12px;"><i class="fab fa-whatsapp"></i><span class="txtspan" style="font-size: xx-small;"> Whatsapp</span></button>
                    </div>
                    <div class="col-md-4">
                      <button type="button" class="btn btn-md btnview btn-light" style="
                      width: 100%; margin-bottom: 12px;"><i class="fab fa-skype"></i><span class="txtspan" style="font-size: xx-small;"> Skype</span></button>
                    </div>
                    <div class="col-md-4">
                      <button type="button" class="btn btn-md btnview btn-light" style="margin-left: -16px;
                      width: 100%; margin-bottom: 12px;"><i class="fab fa-telegram-plane"></i><span class="txtspan" style="font-size: xx-small;"> Telegram</span></button>
                    </div>
                    <div class="col-md-12" style="padding-right: 31px; padding-left: 34px; " id="viewLink">
                      <button type="button" class="btn btn-md btnview btn-light" style="
                      width: 100%; margin-bottom: 12px;">tes</button>
                    </div>

                    <div class="row" style="padding-left: 27px; padding-right: 44px;">
                     <div class="col-md-3 linked">
                       <a href="#" title="fb"><i class="fab fa-facebook-f" style="color: #fff;"></i></a>
                     </div>

                     <div class="col-md-3 linked">
                       <a href="#" title="ig"><i class="fab fa-instagram" style="color: #fff;"></i></a>  
                     </div>  

                     <div class="col-md-3 linked">
                       <a href="#" title="Twitter"><i class="fab fa-twitter-square" style="color: #fff;"></i></a>
                     </div>

                     <div class="col-md-3 linked">
                       <a href="#" title="Youtube"><i class="fab fa-youtube" style="color: #fff;"></i></a>
                     </div>
                   </div>


                   <div class="col-md-12" align="center" id="poweredview">
                    <div class="powered-omnilinks"><a href="#"><span style="font-size: small; color: #fff;">Powered by</span><br>&nbsp;&nbsp;<img style="width: 100px;" src="{{asset('image/omnilinkz-logo-wh.png')}}">
                    </a>
                  </div>
                </div>

              </div>
              <div class="col-md-7 col-8 p-2">
                <ul style="margin-left: 23px;">
                  <li style="display: block; margin-bottom: -15px;">
                    <p class="font-weight-bold" style="color: #fff;">@{{pagetitle}}</p>
                  </li>
                  <li style="display: block; margin-bottom: -15px; ">
                    <p class="font-weight-bold" style="color: #fff;">@{{pagelink}}</p>
                  </li>
                  <li style="display: block;">
                    <p class="font-weight-bold" style="color: #fff;">@{{telpon}}</p>
                  </li>
                </ul>
              </div>
            </div>
          </header>
          <div class="row">

            <div class="col-md-8" id="viewLink">
              <button type="button" class="btn btnview btn-light" style="margin-left: 19px;
              width: 139%; margin-bottom: 12px;">tes</button>
            </div>
            <div class="col-md-12" align="center">
              <div class="powered-omnilinks"><a href="#"><span style="font-size: small; color: #fff;">Powered by</span><br>&nbsp;&nbsp;<img style="width: 100px;" src="{{asset('image/omnilinkz-logo-wh.png')}}">
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
</div>
</section>
<script src="{{asset('js/farbtastic.js')}}"></script>
<script src="{{asset('js/biolinks.js')}}"></script>

<script type="text/javascript">
  var batas = 1;

  $(document).ready(function() {
    $('.outlined').click(function() {
      if ($(this).prop("checked") == true) {
        $(".mobile1").addClass("outlinedview");
      } else if ($(this).prop("checked") == false) {
        $(".mobile1").removeClass("outlinedview");
      }
    });

    $('.rounded').click(function() {
      if ($(this).prop("checked") == true) {
        $(".mobile1").addClass("roundedview");
      } else if ($(this).prop("checked") == false) {
        $(".mobile1").removeClass("roundedview");
      }
    });

    $("#powered").click(function(){
      if ($(this).prop("checked")==true) {
        $("#poweredview").children().show();
      }
      else if($(this).prop("checked")==false){
        $("#poweredview").children().hide(); 
      }
    });
  });

  $("body").on("click", "#savetemp", function() {
    tambahTemp();
    $('#pesanAlert').removeClass('alert-danger');
    $('#pesanAlert').children().remove();
  });

  $("body").on("click", "#addBanner", function() {
    tambahBanner();
    batas += 1;
    if (batas == 5) {
      $(this).attr('disabled', 'disabled');
    }
  });

  $("body").on("click", ".btn-deleteBanner", function() {
    $(this).parent().remove();
    batas -= 1;
    if (batas != 5) {
      $("#addBanner").removeAttr("disabled");
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

  $(document).on("click", "#btn-save-link", function(e) {
    tambahPages();
    $('#pesanAlert').removeClass('alert-danger');
    $('#pesanAlert').children().remove();
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
    $('#pesanAlert').addClass('alert-danger').html('<div class="resetedit">anda dalam mode edit tekan reset untuk membatalkan</div>');
    $('#script').val(script);
    $('#judul').val(title);
    $('#editidpixel').val(editidpixel);
  });

  $(document).on('click', '#solid', function() {
    $('#backtheme').val('');
  });

  let slideIndex = 1;
  showSlides(slideIndex);

  function plusSlides(n) {
    showSlides(slideIndex += n);
  }

  function currentSlide(n) {
    showSlides(slideIndex = n);
  }

  function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {
      slideIndex = 1
    }    
    if (n < 1) {
      slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) 
    {
      slides[i].style.display = "none";  
    }
    for (i = 0; i < dots.length; i++) 
    {
      dots[i].className = dots[i].className.replace(" activated", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " activated";
  }

    // $(document).on('click','.marker',function(){
    //      $('#backtheme').val('');
    // });
    $(document).on('click', '#gradient', function() {
      $('#backtheme').val('colorgradient1');
        //$('.mobile1').html('<div class="screen colorgradient1" id="phonecolor"></div>');
      });
    //  $('#powered').prop('disabled','disabled');
    // $(document).bind('contextmenu',function(e){
    //   e.preventDefault();
    // });
  </script>
  @endsection