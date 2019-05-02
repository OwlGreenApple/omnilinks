@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/dash.css')}}">
<link rel="stylesheet" href="{{asset('css/farbtastic.css')}}">
<link rel="stylesheet" href="{{asset('css/theme.css')}}">
<style type="text/css">
  .form-control{
    border-radius: unset;
  }
  .messengers.links-num-2 .link 
  {
    max-width: 49%; 
  }
  .messengers.links-num-1 .link
  {
    max-width: 99%; 
  }
  .messengers.links-num-3 .link 
  {
    max-width: 32.33333%; 
  }
</style>
<script type="text/javascript">
  var picker;
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

  

  $(document).ready(function() {
    loadPixelPage();
    refreshpixel();
    refreshwa();

    <?php if($pages->is_rounded) {?>
      $(".mobile1").addClass("roundedview");
    <?php } ?>

    <?php if($pages->is_outlined) {?>
      $(".mobile1").addClass("outlinedview");
    <?php } ?>

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

    function onColorChange(color) {
      // dosomeStuff();
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
    
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
          $('#viewpicture').attr('src', e.target.result).fadeIn('slow');

          $('#viewpicture').show();
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#wizard-picture").on('change', function() {
      readURL(this);
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
                <a href="#link" class="nav-link link" role="tab" data-toggle="tab">
                  Link
                </a>
              </li>
              @if((Auth::user()->membership=='basic') OR (Auth::user()->membership=='elite'))
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

                  <div class="hid">
                    <ul class="sortable-msg">
                      <li id="msg">
                        <div id="wa" class="messengers div-table">
                          <div class="div-cell">
                            <span class="handle">
                              <i class="fas fa-bars"></i>
                            </span>
                          </div>

                          <div class="div-cell">
                            <div class="col-md-12 col-12 pr-0  pl-0">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <i class="fab fa-whatsapp"></i>
                                  </div>
                                </div>
                                <input type="text" name="wa" class="form-control wa-input" value="{{$pages->wa_link}}" id="inlineFormInputGroupUsername" onkeypress="return hanyaAngka(event)" placeholder="masukkan nomor whatsapp">
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
                                <input type="text" name="telegram" class="form-control telegram-input" id="inlineFormInputGroupUsername" value="{{$pages->telegram_link}}" placeholder="masukkan nomor telegram">
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
                                <input type="text" name="skype" onkeypress="return hanyaAngka(event)" class="form-control skype-input" id="inlineFormInputGroupUsername" value="{{$pages->skype_link}}" placeholder="masukkan nomor Skype">
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
                      <?php $utl=0; ?>
                        @foreach($links as $link)
                        <?php 
                        $utl+=1; ?>
                          <li class="link-list" link-id="link-url-update-<?=$utl?>">
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
                                    <input type="hidden" name="deletelink[]" class="delete-link" value="">
                                    <input type="text" name="title[]" value="{{$link->title}}" id="title-<?=$utl?>-view-update" placeholder="Title" class="form-control focuslink-update">
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
                        @endforeach
                      @else

                        <li class="link-list" link-id="link-url-1">
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
                                  <input type="hidden" name="deletelink[]" class="deletelink" value="">
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
                    <li id="sosmed-youtube">
                      <div id="youtube" class="socialmedia div-table mb-4">
      
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

                    <li id="sosmed">
                      <div id="fb" class="socialmedia div-table hidden" style="display: none;" data-type="fb">
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

                    <li id="sosmed">
                      <div id="twitter" class="socialmedia div-table hidden" style="display: none;" data-type="twitter">
              
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

                    <li id="sosmed">
                      <div id="ig" class="socialmedia div-table hidden" style="display: none;" data-type="ig">
              
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

                  <div class="as col-md-12 text-right">
                    <button type="button" id="btn-save-link" class="btn btn-primary btn-biolinks ">
                      <i class="far fa-save" style="margin-right:5px;"></i>
                      SAVE
                    </button>
                  </div>
                </form>
              </div>
      @if((Auth::user()->membership=='basic') OR (Auth::user()->membership=='elite'))
              <!-- TAB 2 -->
              <div role="tabpanel" class="tab-pane fade " id="walink">
                <form id="savewalink" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="uuidpixel" value="{{$uuid}}">
                  <span class="blue-txt">
                    WhatsApp Link Creator
                  </span>
                  
                  <div class="form-group mt-3 mb-4 row">
                    <label for="nomorwa" class="control-label col-md-5">
                       Masukkan Nomor WA
                    </label>
                    <div class="col-md-7 row">
                      <input type="text" name="nomorwa" id="nomorwa" class="form-control col-md-9" onkeypress="return hanyaAngka(event)">
                      <div class="col-md-3">
                        <button type="reset" class="btn btn-danger btn-reset">
                          Reset
                        </button>
                      </div>
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

                  <div class="col-md-12 pr-0 text-right">
                    <button type="button" class="btn btn-primary btn-biolinks" id="generate" style="margin-top: 20px;">
                      SAVE & CREATE LINK
                    </button>  
                  </div>
                </form>

                <div class="margin" style="margin-top: 47px;">
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
                <form id="savepixel" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="uuidpixel" value="{{$uuid}}">
                  <input type="hidden" name="idpage" id="idpage" value="{{$pageid}}">
                  <span class="blue-txt">
                    Pixel Retargetting
                  </span>
                  <textarea class="form-control mt-3" name="script" id="script" style="height:100px"></textarea>

                  <div class="title form-inline mb-5 mt-3">
                    <span class="mr-2">
                      Title
                    </span>

                    <input type="text" class="form-control col-md-5 mr-2" name="title" placeholder="Masukkan Judul" id="judul">
                    <input type="text" name="editidpixel" hidden id="editidpixel">

                    <button type="button" id="btnpixel" class="btn btn-primary mr-2">
                      Save
                    </button>
                    <button type="reset" class="btn btn-danger btn-reset">
                      Reset
                    </button>
                  </div>
                </form>

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
                    <div class="container">
                      <div class="row mt-5">
                        <div class="col-md-4 picture-container">
                          <div class="picture">
                            @if(is_null($pages->image_pages))
                            <img src="https://institutogoldenprana.com.br/wp-content/uploads/2015/08/no-avatar-25359d55aa3c93ab3466622fd2ce712d1.jpg" class="picture-src" id="wizardPicturePreview" title="">
                            @else
                            <img src="<?php echo url(Storage::disk('local')->url('app/'.$pages->image_pages)); ?>" class="picture-src" id="wizardPicturePreview" title="">
                            @endif
                            <input type="file" name="imagepages" id="wizard-picture" class="" accept=".png, .jpg">
                          </div>
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
                          <input type="number" name="nomor" id="telpon" value="" class="form-control" placeholder="masukkan nomor" style="margin-bottom: 5px">
                          @else
                          <input type="number" name="nomor" id="telpon" value="{{$pages->telpon_utama}}" class="form-control" placeholder="masukkan nomor" style="margin-bottom: 5px">
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
                                    <select name="bannerpixel[]" id="bannerpixel" class="form-control bannerpixel">
                                    </select>
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
                                    <select name="bannerpixel[]" id="bannerpixel" class="form-control bannerpixel">
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
                    <label class="switch">
                      <input type="checkbox" name="rounded" class="rounded" value="<?php if($pages->is_rounded) echo '1'; ?>" <?php if($pages->is_rounded) echo 'checked';?>>
                      <span class="slider round"></span>
                    </label>&nbsp;Rounded buttons
                    &nbsp;&nbsp;
                    <a href="" class="nav-link">Custom Color</a>
                    <br>
                    <label class="switch">
                      <input type="checkbox" name="outlined" class="outlined" value="<?php if($pages->is_outlined) echo '1'; ?>" <?php if($pages->is_outlined) echo 'checked'; ?>>
                      <span class="slider round"></span>
                    </label>&nbsp;Outlined buttons
                    &nbsp;&nbsp;
                    <a href="" class="nav-link">Custom Color</a>
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
                            <input type="text" id="color" name="color" value="#123456">
                          </div>
                        </div>
                      </div>
                      <label class="switch mb-4">
                        <input type="checkbox" name="powered" id="powered" value="powered" checked="">
                        <span class="slider round"></span>
                      </label> &nbsp; Powered By Omnilinks<br>
                      <div class="col-md-12 text-right">
                        <button type="button" class="btn btn-primary btn-biolinks" id="savetemp">
                          <i class="far fa-save" style="margin-right:5px;"></i>
                          SAVE
                        </button>  
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
      <div class="col-md-6">
        <div class="fixed">
          <div class="center">
            <div class="mobile">
              <div class="mobile1">
                <div class="screen colorgradient1" id="phonecolor" style="border:none; overflow-y:auto; ">
                  <!--screen-->
                  <header class="container" style="padding-top: 17px; padding-bottom: 12px;">
                    <div class="row">
                      <div class="col-md-2 col-3">
                        @if(is_null($pages->image_pages))
                        <img id="viewpicture" src="" style="border-radius: 50%; width: 82px; height: 82px; margin-left: 13px; display: none;">
                        @else
                        <img id="viewpicture" src="<?php echo url(Storage::disk('local')->url('app/'.$pages->image_pages)); ?>" style="border-radius: 50%; width: 82px; height: 82px; margin-left: 13px;">
                        @endif
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
                      @if($banner->count())
                      <?php $ut=0 ?>
                       @foreach($banner as $ban)
                       <?php $ut+=1; ?>
                        <div class="mySlides mylides fit" id="picture-id-<?=$ut?>-get">
                          <img src="<?php  echo url(Storage::disk('local')->url('app/'.$ban->images_banner)); ?>" class="imagesize  input-picture-<?=$ut?>-get" id="image-update-<?=$ut?>" value="ada"> 
                        </div>                       
                       @endforeach
                        @else
                        @if((Auth::user()->membership=='basic') OR (Auth::user()->membership=='elite'))
                        <div class="mySlides mylides fit " id="picture-id-6-get">
                          <img id="picture-6" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRNL6cJAzJjtpG83icr-1rMhNvRDAp1eDH80z826LwYjmgFo8XQ" class="imagesize input-picture-6-get" value="ada" >
                        </div>
                        @endif
                      @endif
                      </div>
                     @if((Auth::user()->membership=='basic') OR (Auth::user()->membership=='elite'))
                      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                      <a class="next" onclick="plusSlides(1)">&#10095;</a>
                    @endif
                    </div>
                    <br>

                    <div style="text-align:center ; margin-top: -25px;" id="dot-view"></div>
                  </div>
                  <div class="links messengers links-num-1 "id="getview" style="font-size: xx-small; margin-top: 12px; margin-left: 15px; margin-right: 10px;">
                 <div class="link shown-mes" id="waviewid" >
                      <a href="#" class="btn btn-md btnview btn-light" style="
                      width: 100%;  padding-left: 2px;" id="walinkview"><i class="fab fa-whatsapp"></i><span class="txthov" style="font-size: xx-small;"> Whatsapp</span></a>
                    </div>
                    <div class="link hiddens" id="telegramviewid" style="display: none;">
                      <a href="#" class="btn btn-md btnview btn-light" style="
                      width: 100%;  padding-left: 2px;" id="telegramlinkview"><i class="fab fa-telegram-plane"></i><span class="txthov" style="font-size: xx-small;"> Telegram</span></a>
                    </div> 
                     <div class="link hiddens" id="skypeviewid" style="display: none;">
                      <a href="#" class="btn btn-md btnview btn-light" style="
                      width: 100%;  padding-left: 2px;" id="skypelinkview"><i class="fab fa-skype"></i><span class="txthov" style="font-size: xx-small;"> Skype</span></a>
                    </div>
                </div>
                <div class="row" style="font-size: xx-small; margin-left: 3px; margin-right: 2px; font-weight: 700;">
                <div class="col-md-12" id="viewLink">
                  @if($links->count())
                  <?php $utlq=0  ?>
                  @foreach($links as $link)
                  <?php $utlq+=1 ?>
                  <button type="button" class="btn btn-light btnview title-<?=$utlq?>-view-update-get" id="link-url-update-<?=$utlq?>-get" style="width:100%; margin-bottom: 12px;">{{$link->title}}</button>
                  @endforeach
                  @else
                  <button type="button" class="btn btn-light btnview title-1-view-get" id="link-url-1-preview" style="width: 100%; margin-bottom: 12px;">masukkan link</button>
                  @endif
                </div>
                </div>
                    <div class="row rows " style="padding-left: 27px; padding-right: 44px;">
                     <div class="col-md-3 linked shown-sm" id="youtubeviewid">
                       <a href="#" title="Youtube"><i class="fab fa-youtube" style="color: #fff;"></i></a>
                     </div>
                     <div class="col-md-3 linked hiddensm " id="facebookviewid" style="display: none;">
                       <a href="#" title="fb" ><i class="fab fa-facebook-f" style="color: #fff;"></i></a>
                     </div>
                     <div class="col-md-3 linked hiddensm" id="twitterviewid" style=" display: none;">
                       <a href="#" title="Twitter"  ><i class="fab fa-twitter-square" style="color: #fff;"></i></a>
                     </div>
                      <div class="col-md-3 linked hiddensm" id="instagramviewid"  style=" display: none;">
                       <a href="#" title="ig" ><i class="fab fa-instagram" style="color: #fff; "></i></a>  
                      </div>  
                   </div>
                   <div class="col-md-12" align="center" id="poweredview">
                    <div class="powered-omnilinks">
                      <a href="#">
                        <span style="font-size: small; color: #fff;">
                          Powered by
                        </span>
                        <br>&nbsp;&nbsp;
                        <img style="width: 100px;" src="{{asset('image/omnilinkz-logo-wh.png')}}">
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
<noscript>Jalankan Javascript di browser anda</noscript>
<script type="text/javascript">
  var elhtml;
  let idpic=6;
  let counterBanner=0;
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

      // let inputtitlelink=$('input[name="title[]"]');
      // let output=$('input[name="[titlelinkoutput[]"]');
      // if (inputtitlelink.length==output.length) 
      // {

      // }
      
      // console.log(inputtitlelink[0]);
    //let idlinkview=$('#title-'+execute+'-view');
$(document).on('focus','.focuslink',function(){
    let inputlinkview=$(this);
    let getoutputviewlink=inputlinkview.attr('id');
    let outputviewlink=$('.'+getoutputviewlink+'-get');
    //console(outputviewlink);
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
  let outputviewlink=$('.'+getoutputviewlink+'-get');
  $(document).on('keyup',inputlinkview,function(){
    outputviewlink.text(inputlinkview.val());
    if (inputlinkview.val()=='') {
      outputviewlink.text('Masukkan Link');
    }
  });
});


    $('.outlined').click(function() {
      if ($(this).prop("checked") == true) {
        $(".mobile1").addClass("outlinedview");
        $(this).val(1);
      } else if ($(this).prop("checked") == false) {
        $(".mobile1").removeClass("outlinedview");
        $(this).val(0);
      }
    });

    $('.rounded').click(function() {
      if ($(this).prop("checked") == true) {
        $(".mobile1").addClass("roundedview");
        $(this).val(1);
      } else if ($(this).prop("checked") == false) {
        $(".mobile1").removeClass("roundedview");
        $(this).val(0);
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
      $('#color').val("<?php echo $pages->color_picker; ?>");
      $("#solid").click();
    <?php } ?>
    <?php if (!is_null($pages->template)) { ?>
      $('#backtheme').val("<?php echo $pages->template; ?>");
      $("#gradient").click();
    <?php } ?>
  });

  // Add the following code if you want the name of the file appear on select
  $(document).on("change", ".custom-file-input",function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });

  $("body").on("click", "#savetemp", function() {
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
      elhtml = '<div class="div-table list-banner mb-4" picture-id="picture-id-'+idpic+'"><div class="div-cell"><input type="text" name="judulBanner[]" value="" class="form-control" placeholder="Judul banner"><input type="hidden" name="idBanner[]" value=""><input type="hidden" name="statusBanner[]" class="statusBanner" value=""><input type="text" name="linkBanner[]" value="" class="form-control" placeholder="masukkan link"><select name="bannerpixel[]" id="bannerpixel" class="form-control bannerpixel"></select><div class="custom-file"><input type="file" name="bannerImage[]" class="custom-file-input pictureClass" id="input-picture-'+idpic+'" aria-describedby="inputGroupFileAddon01"><label class="custom-file-label" for="inputGroupFile01">Choose file</label></div></div><div class="div-cell cell-btn btn-deleteBanner"><span><i class="far fa-trash-alt"></i></span></div></div>';
     $el = $(".div-banner").append(elhtml);
     loadPixelPage();
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

  $(document).on("click", "#btn-save-link", function(e) {
    tambahPages();
    tambahTemp();
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
    slides[slideIndex-1].style.display = "block";
    //slides[slideIndex-1].value='block';   
    dots[slideIndex-1].className +=" activated";
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

 
    // $(document).on('click','.marker',function(){
    //      $('#backtheme').val('');
    // });
    //  $('#powered').prop('disabled','disabled');
    // $(document).bind('contextmenu',function(e){
    //   e.preventDefault();
    // });
</script>
@endsection
