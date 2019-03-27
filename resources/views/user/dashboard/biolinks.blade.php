@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/dash.css')}}">
<script src="{{asset('js/biolinks.js')}}"></script>

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
            data: $("#savelink").serialize()+'&'+$('.sortable-msg').sortable('serialize')+'&'+$('.sortable-link').sortable('serialize')+'&'+$('.sortable-sosmed').sortable('serialize'),
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
        refreshpixel();
        refreshwa();
        $('.infooter').remove();
          $( ".sortable-msg" ).sortable({
      handle: '.handle',
      cursor: 'move',
      axis: 'y',
      stop: function (event, ui) {
        var data = $(this).sortable('serialize');
        //save_order(data);
      }
    });
    $( ".sortable-msg" ).disableSelection();
    //$( ".sortable-msg" ).draggable();

    $( ".sortable-link" ).sortable({
      handle: '.handle',
      cursor: 'move',
      axis: 'y',
      stop: function (event, ui) {
        var data = $(this).sortable('serialize');
        //save_order(data);
      }
    });
    $( ".sortable-link" ).disableSelection();
    //$( ".sortable-link" ).draggable();
    $( ".sortable-sosmed" ).sortable({
      handle: '.handle',
      cursor: 'move',
      axis: 'y',
      stop: function (event, ui) {
        var data = $(this).sortable('serialize');
        //save_order(data);
      }
    });
    $( ".sortable-sosmed" ).disableSelection();

   

    $('#colorpicker').farbtastic('#colour');
    //$.farbtastic('#colorpicker','.screen');
    //$('#colorpicker').farbtastic('.screen');
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
          }

        $("#wizard-picture").on('change', function(){
        readURL(this);
          });
      });
  
</script>
<style type="text/css">
     .sortable-msg, .sortable-link, .sortable-sosmed { 
    list-style-type: none; 
    margin-left: -40px;
  }
  .handle {
    cursor: move;
    padding: 10px;
  }
  .theme-take{
    width: 19%;
    display: inline-block;
    padding: 10px;
    border: 2px solid transparent;
    transition: all .15s ease-in-out;
  }
  .mrgtp{
    margin-top: 3.25rem !important;
  }
  .theme1{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(339deg, #21d4fd, #b721ff);
  }
   .theme2{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(134deg, #00b4db, #1094c2);
  }

   .theme3{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
 background-image: linear-gradient(139deg, #25b7b2, #3b9893);
  }
   .theme4{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(133deg, #fc7a3c, #ed4d55);
  }
   .theme5{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(312deg, #aa19e7, #2333bf);
  }
   .theme6{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(133deg, #ae92d3, rgba(153, 85, 242, 0.99));
  }
   .theme7{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(to bottom, #f7971e, #ffd200);
  }
   .theme8{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(45deg, #05a907, #17abaa);
  }
   .theme9{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
   background-image: linear-gradient(229deg, #ff4e50, #ff8158 41%, #f9d423);
  }
   .theme10{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
   background-image: linear-gradient(229deg, #1353b9, #38aee9 44%, #0ae68f);
  }

.theme11{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
   background-image: linear-gradient(to bottom, #fe8c00, #f83600);
  }
   .theme12{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(134deg, #0e76ef, #4497f1 52%, #137bf5);
  }
   .theme13{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
   background-image: linear-gradient(45deg, #2c1872, rgba(186, 55, 143, 0.98) 38%, rgba(235, 96, 79, 0.97) 66%, rgba(250, 218, 93, 0.95));
  }
   .theme14{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
   background-image: linear-gradient(to bottom, #1a2980, #26d0ce);
  }
   .theme15{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(to bottom, #52c234, #061700);
  }
   .theme16{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(to bottom, #e65c00, #f9d423);
  }
   .theme17{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
   background-image: linear-gradient(to bottom, #4ecdc4, #556270);
  }
   .theme18{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
   background-image: linear-gradient(to bottom, #f7ff00, #db36a4);
  }
   .theme19{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(to bottom, #1e3c72, #2a5298);
  }
   .theme20{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(to bottom, #1d976c, #93f9b9);
  }

  .theme21{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(133deg, #c2ffd8, #465efb);
  }
   .theme22{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(133deg, #97abff, #123597);
  }
   .theme23{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(133deg, #3b2667, #bc78ec);
  }
   .theme24{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
 background-image: linear-gradient(133deg, #dac72c, #49c628);
  }
   .theme25{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(133deg, #f761a1, #8c1bab);
  }
   .theme26{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
   background-image: linear-gradient(133deg, #ffdb01, #0e197d);
  }
   .theme27{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(133deg, #f05f57, #360940);
  }
   .theme28{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
   background-image: linear-gradient(133deg, #ff6fd8, #3813c2);
  }
   .theme29{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(133deg, #ffa8a8, #fcff00);
  }
   .theme30{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
   background-image: linear-gradient(133deg, #3c8ce7, #00eaff);
  }

  .theme31{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(to top, #7028e4, #e5b2ca);
  }
   .theme32{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(to bottom, #fbc2eb, #a18cd1);
  }
   .theme33{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(to top, #ffb199, #ff0844);
  }
   .theme34{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
   background-image: linear-gradient(296deg, #fbab7e, #f7ce68);
  }
   .theme35{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
 background-image: linear-gradient(227deg, #ae8b9c, #8baaaa); 
  }
   .theme36{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
   background-image: linear-gradient(227deg, #7de2fc, #b9b6e5);
  }
   .theme37{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(to left, #b12a5b, #cf556c 25%, #ff8c7f 63%, #ff8177);
  }
   .theme38{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
   background-image: linear-gradient(to left, #f9d423, #f83600);
  }
   .theme39{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
 background-image: linear-gradient(to top, #009efd, #2af598);
  }
   .theme40{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(to top, #04befe, #4481eb);
  }

  .theme41{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
   background-image: linear-gradient(to bottom, #f857a6, #ff5858);
  }
   .theme42{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
   background-image: linear-gradient(to left, #517fa4, #243949);
  }
   .theme43{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(to top, #fa71cd, #c471f5);
  }
   .theme44{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
   background-image: radial-gradient(circle at 50% 50%, #16d9e3, #46aef7);
  }
   .theme45{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(to left, #6a11cb, #2575fc);
  }
   .theme46{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
 background-image: linear-gradient(227deg, #7742b2, #f180ff 52%, #fd8bd9);
  }
   .theme47{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
 background-image: linear-gradient(to top, #f9f047, #0fd850);
  }
   .theme48{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
 background-image: linear-gradient(to bottom, #00ecbc, #007adf);
  }
   .theme49{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
  background-image: linear-gradient(227deg, #a445b2, #d41872 52%, #ff0066);
  }
   .theme50{
  width: 70.3px;
  height: 62px;
  border-radius: 8px;
  cursor: pointer;
 background-image: linear-gradient(to bottom, #56ab2f, #a8e063);
  }

</style>
<link rel="stylesheet" href="{{asset('css/farbtastic.css')}}">
<link rel="stylesheet" href="{{asset('css/dash.css')}}">

<link rel="stylesheet" href="{{asset('css/template.css')}}">

<section id="tabs" class="project-tab">
    <div class="container">
        <div class="row notif">
            <div class="col-md-12">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>Masa trial anda akan berakhir dalam 5 hari. <span style="color:blue;">Subscribe</span>
                    untuk terus menggunakan Omnilinks
                </div>
            </div>
            <div class="col-md-6">

                <div id="pesan" class="alert"></div>
                 <div id="pesanAlert" class="alert"></div>

                <div class="card carddash" style="margin-bottom:20px;">
                    <div class="card-body">

                        <ul class="mb-4 nav nav-tabs">
                            <li class="nav-item">
                                <a href="#link" class="active nav-link link" role="tab" data-toggle="tab">Link</a>
                            </li>
                            <li class="nav-item">
                                <a href="#walink" class="nav-link link" role="tab" data-toggle="tab">WA Link Creator</a>
                            </li>
                            <li class="nav-item">
                                <a href="#pixel" class="nav-link link" role="tab" data-toggle="tab">Pixel</a>
                            </li>
                            <li class="nav-item">
                                <a href="#style" class="nav-link link" role="tab" data-toggle="tab">Tampilan</a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <!-- tab 1-->
                            <div role="tabpanel" class="tab-pane fade in active show" id="link">
                                <form method="post" id="savelink" action="{{url('save-link')}}" novalidate>
                                    {{ csrf_field() }}
                                    <!--messengers!-->
                                    <input type="hidden" name="uuid" value="{{$uuid}}">
                                    <label class="mb-3" for="" style="font-weight:bold;">Messengers :</label>
                                    <button type="button" class="float-right btn btn-primary btn-sm" id="tambah"><i class="fas fa-plus"></i>
                                    </button>

                             <div class="hid">
                                 <ul class="sortable-msg">
                                      <li id="msg-wa">
                                        <div id="wa" class="messengers">
                                            <div class="row">
                                              <div class="col-md-1 col-1 pl-md-3 pl-2">
                                                <span class="handle">
                                                  <i class="fas fa-bars"></i>
                                                </span>
                                              </div>
                                              <div class="col-md-11 col-11">
                                                <div class="input-group margin ">
                                                  <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                      <i class="fab fa-whatsapp"></i>
                                                    </div>
                                                  </div>

                                                  <input type="text" name="wa" class="form-control" id="inlineFormInputGroupUsername" onkeypress="return hanyaAngka(event)" placeholder="masukkan nomor whatsapp">
                                                
                                                  <button type="button" class="btn btn-primary" id="deletewa">
                                                    <i class="fas fa-trash-alt"></i>
                                                  </button>
                                                </div>
                                              </div>
                                            </div>

                                        <div class="row">
                                            <div class="offset-md-1 col-md-11 offset-1 col-11">
                                                <select name="wapixel" class="form-control">
                                                <option value="">--Pilih Pixel Yang telah dibuat--</option>
                                                @foreach($pixels as $pixel)
                                                <option value="{{$pixel->id}}">{{$pixel->title}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                    <li id="msg">
                                        <div id="telegram" class="messengers hidden" style=" display:none;">
                                            <div class="row">
                                                 <div class="col-md-1 col-1 pl-md-3 pl-2">
                                                    <span class="handle">
                                                      <i class="fas fa-bars"></i>
                                                    </span>
                                                  </div>

                                        <div class="col-md-11 col-11">    
                                            <div class="input-group margin">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fab fa-telegram-plane"></i>
                                                    </div>
                                                </div>

                                                <input type="text" name="telegram" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan nomor telegram">
                                                <button type="button" class="btn  btn-primary" id="deletetelegram"><i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                           <div class="row">
                                               <div class="offset-md-1 offset-1 col-md-11 col-11">
                                                 <select name="telegrampixel" class="form-control">
                                                <option value="">--Pilih Pixel Yang telah dibuat--</option>
                                                @foreach($pixels as $pixel)
                                                <option value="{{$pixel->id}}">{{$pixel->title}}</option>
                                                @endforeach
                                                 </select>   
                                               </div>
                                           </div>
                                        </div>
                                    </li>

                                    <li id="msg">
                                        <div id="skype" class="messengers hidden" style="display:none;">
                                            <div class="row">
                                                <div class="col-md-1 pl-md-3 pl-2">
                                                    <span class="handle">
                                                      <i class="fas fa-bars"></i>
                                                    </span>
                                                </div>
                                            

                                          <div class="col-md-11 col-11">
                                            <div class="input-group margin">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fab fa-skype"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="skype" onkeypress="return hanyaAngka(event)" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan nomor Skype">
                                                <button id="deleteskype" class="btn btn-primary" type="button"><i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                            </div>
                                        </div>

                                         <div class="row">
                                            <div class="offset-md-1 offset-1 col-md-11 col-11">
                                            <select name="skypepixel" class="form-control">
                                                <option value="">--Pilih Pixel Yang telah dibuat--</option>
                                                @foreach($pixels as $pixel)
                                                <option value="{{$pixel->id}}">{{$pixel->title}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                         </div>
                                        </div>
                                        </li>
                                    </ul>
                                </div>

                                    <!--Links-->

                                    <label class="mb-3" for="" style="font-weight:bold;">Links :</label>
                                    <button type="button" class="float-right btn btn-primary btn-sm" id="addlink"><i class="fas fa-plus"></i> Add Link
                                    </button><br>

                                    <div>
                                    <ul class="sortable-link a">       
                                        @foreach($links as $link)
                                         <li id="link-wa">
                                            <div class="row">
                                                <div class="col-md-1 col-1 pl-md-3 pl-2">
                                                     <span class="handle">
                                                        <i class="fas fa-bars"></i>
                                                      </span>  
                                                </div>
                                     <div class="col-md-11 col-11"> 
                                        <div class="input-stack">
                                            <input type="hidden" name="idlink[]" value="{{$link->id}}">
                                            <input type="text" name="title[]" value="{{$link->title}}" placeholder="Title" class="form-control">
                                            <input type="text" name="url[]" value="{{$link->link}}" placeholder="http://url..." class="form-control" style="margin-bottom:20px;">
                                            <button class="deletelink btn btn-primary" type="button"><i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                 </li>
                               @endforeach
                                        <li id="link-wa">
                                          <div class="row">
                                                <div class="col-md-1 col-1 pl-md-3 pl-2">
                                                     <span class="handle">
                                                        <i class="fas fa-bars"></i>
                                                      </span>  
                                                </div>
                                    <div class="col-md-11 col-11"> 
                                        <div class="input-stack">
                                            <input type="hidden" name="idlink[]" value="new">
                                            <input type="text" name="title[]" value="" placeholder="Title" class="form-control">
                                            <input type="text" name="url[]" value="" placeholder="http://url..." class="form-control" style="margin-bottom:20px;">
                                            <button class="deletelink btn btn-primary" type="button"><i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                    </div>
                                   </li>
                                    </ul>
                                </div>

                                    <!--social media-->

                 <label class="mb-3" for="" style="font-weight:bold">
                  Social Media
                </label>
                <button type="button" class="float-right btn btn-primary btn-sm" id="sm">
                  <i class="fas fa-plus"></i>
                </button>

                <ul class="sortable-sosmed">
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
                            <input type="text" name="youtube" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan channel youtube url" >
                            <button id="deleteyoutube" class="btn btn-primary" type="button">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                          </div>
                        </div>  
                      </div>
                      
                      <div class="row">
                        <div class="offset-md-1 col-md-11 offset-1 col-11">
                          <select name="youtubepixel" class="form-control">
                            <option value="">
                              --Pilih Pixel Yang telah dibuat--
                            </option>
                            @foreach($pixels as $pixel)
                              <option value="{{$pixel->id}}">
                                {{$pixel->title}}
                              </option>
                            @endforeach
                          </select>
                        </div>  
                      </div>
                    </div>
                  </li>
                  
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
                            <input type="text" name="fb" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan username facebook" >
                            <button id="deletefb" class="btn btn-primary" type="button">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                          </div>    
                        </div>
                      </div>

                      <div class="row">
                        <div class="offset-md-1 col-md-11 offset-1 col-11">
                          <select name="fbpixel" class="form-control">
                            <option value="">
                              --Pilih Pixel Yang telah dibuat--
                            </option>
                            @foreach($pixels as $pixel)
                              <option value="{{$pixel->id}}">
                                {{$pixel->title}}
                              </option>
                            @endforeach
                          </select>    
                        </div>
                      </div>
                    </div>
                  </li>
                
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
                            <button id="deletetwitter"  class="btn btn-primary" type="button">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="offset-md-1 col-md-11 offset-1 col-11">
                          <select name="twitterpixel" class="form-control">
                            <option value="">
                              --Pilih Pixel Yang telah dibuat--
                            </option>
                            @foreach($pixels as $pixel)
                              <option value="{{$pixel->id}}">
                                {{$pixel->title}}
                              </option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div> 
                  </li>
                
                  <li id="sosmed">
                    <div id="ig" class="socialmedia hidden" style=" display:none;" data-type="ig">
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
                            <button id="deleteig"  class="btn btn-primary" type="button">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="offset-md-1 col-md-11 offset-1 col-11">
                          <select name="igpixel" class="form-control">
                            <option value="">
                              --Pilih Pixel Yang telah dibuat--
                            </option>
                            @foreach($pixels as $pixel)
                              <option value="{{$pixel->id}}">
                                {{$pixel->title}}
                              </option>
                            @endforeach
                          </select>
                        </div>  
                      </div>
                    </div> 
                  </li>
                </ul>
                                    <div class="as">
                                        <hr class="own">
                                        <button type="button" id="btn-save-link" class="btn btn-primary btn-biolinks "><i class="far fa-save" style="margin-right:5px;"></i>SAVE</button>
                                    </div>
                                </form>
                            </div>

                            <!-- TAB 2 -->

                            <div role="tabpanel" class="tab-pane fade " id="walink">
                                <form id="savewalink" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="uuidpixel" value="{{$uuid}}">
                                    <span class="" style="color:blue">WhatsApp Link Creator</span><br>
                                    <span>Masukkan Nomor WA</span>
                                    <input type="number" name="nomorwa" id="nomorwa" class="">
                                    <button type="reset" class="btn btn-danger btn-reset" style="margin-top: 10px; margin-bottom: 10px;">Reset</button>
                                    <div class="card">
                                        <span class="card-header">Masukkan Pesan</span>
                                        <textarea class="card-body form-control" name="pesan" id="pesan-wa"> </textarea>
                                    </div>
                                    <input type="text" name="editidwa" hidden="" id="editidwa">
                                    <textarea id="demo" hidden="" name="textlink"></textarea>
                                    <button type="button" class="btn btn-primary btn-biolinks" id="generate" style="margin-top: 20px;">SAVE & CREATE LINK</button>
                                </form>
                                <div class="margin" style="margin-top: 47px;">
                                    <span style="color:blue;">Recent WhatsApp Link Creator</span>
                                    <div class="accordion" id="accordionExample">
                                        <div id="contentwa">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 3 -->

                            <div class="tab-pane fade" id="pixel">
                                <form id="savepixel" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="uuidpixel" value="{{$uuid}}">
                                    <input type="hidden" name="idpage" id="idpage" value="{{$pageid}}">
                                    <span style="color:blue;">Pixel Retargetting</span>
                                    <textarea class="card-body form-control" name="script" id="script"></textarea>
                                    <div class="title" style="margin-top: 20px;">
                                        <span>Title</span>
                                        <input type="text" name="title" placeholder="Masukkan Judul" id="judul">
                                        <input type="text" name="editidpixel" hidden id="editidpixel">
                                        <button type="button" id="btnpixel" class="btn btn-primary">Save</button>
                                        <button type="reset" class="btn btn-warning btn-reset">Reset</button>
                                    </div>
                                </form>
                                <hr class="own">
                                <span style="color:blue;">Recent Pixel Retargetting</span>
                                <div class="accordion" id="accordionExample">
                                    <div id="content">

                                    </div>
                                </div>
                            </div>

                            <!-- TAB 4 -->

                            <div role="tabpanel" class="tab-pane fade" id="style">
                                <form method="post" id="saveTemplate" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="uuidtemp" value="{{$uuid}}">
                                    <div class="mb-5 form-group">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-4 picture-container">
                                                    <div class="picture">
                                                        <img src="" class="picture-src" id="wizardPicturePreview" title="">
                                                        <input type="file" name="imagepages" id="wizard-picture" class="" accept=".png, .jpg, .jpeg">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="judul" value="" class="form-control" placeholder="Masukkan judul" style="margin-bottom: 5px">
                                                    <input type="text" name="link" value="" class="form-control" placeholder="masukkan link" style="margin-bottom: 5px">
                                                    <input type="number" name="nomor" value="" class="form-control" placeholder="masukkan nomor" style="margin-bottom: 5px">
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="button" class="float-right mb-3 btn btn-primary btn-sm" id="addBanner"><i class="fas fa-plus"></i>
                                                    </button>
                                                    <span style="color:blue;">Banner</span>
                                                    <div class="contentBanner">
                                                        <div class="c">
                                                            <input type="text" name="judulBanner[]" value="" class="form-control" placeholder="Judul banner">
                                                            <input type="text" name="linkBanner[]" value="" class="form-control" placeholder="masukkan link">
                                                            <select name="bannerpixel[]" class="form-control">
                                                                <option value="">--Pilih Pixel Yang telah dibuat--</option>
                                                                @foreach($pixels as $pixel)
                                                                <option value="{{$pixel->id}}">{{$pixel->title}}</option>
                                                                @endforeach
                                                            </select>
                                                            <input type="file" name="bannerImage[]" value="Upload">
                                                            <button class="btn btn-primary btn-deleteBanner"><i class="fa fa-trash-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      
                                        <input type="text" name="backtheme" id="backtheme" readonly="true" hidden="" value="colorgradient1">  
                                        <label class="switch">
                                            <input type="checkbox" name="rounded" value="rounded-p" >
                                            <span class="slider round"></span>
                                        </label> &nbsp;Rounded buttons<br>
                                        <label class="switch">
                                            <input type="checkbox" name="outlined" value="outlined">
                                            <span class="slider round"></span>
                                        </label>
                                        &nbsp; Outlined buttons
                                        <div class="as">
                                        
                                                                                        <!-- Bootstrap CSS -->
                                                <ul class="nav nav-tabs" role="tablist">
                                                  <li class="nav-item">
                                                    <a class="nav-link active" href="#buzz" id="gradient" role="tab" data-toggle="tab">GRADIENT</a>
                                                  </li>
                                                  <li class="nav-item">
                                                    <a class="nav-link" href="#references" id="solid" role="tab" data-toggle="tab">SOLID</a>
                                                  </li>
                                                </ul>
                                                <!-- Tab panes -->
                                                <div class="tab-content">

                                                    <!--theme color -->
                                                  <div role="tabpanel" class="tab-pane fade in active show" id="buzz">

                                                      <div class="theme mrgtp">
                                                          <div class="theme-take">
                                                              <div class="theme1"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme2"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme3"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme4"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme5"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme6"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme7"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme8"></div>
                                                          </div>
                                                         <div class="theme-take">
                                                              <div class="theme9"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme10"></div>
                                                          </div>
                                                           <div class="theme-take">
                                                              <div class="theme11"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme12"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme13"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme14"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme15"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme16"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme17"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme18"></div>
                                                          </div>
                                                         <div class="theme-take">
                                                              <div class="theme19"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme20"></div>
                                                          </div>
                                                        
                                                          <div class="theme-take">
                                                              <div class="theme21"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme22"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme23"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme24"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme25"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme26"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme27"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme28"></div>
                                                          </div>
                                                         <div class="theme-take">
                                                              <div class="theme29"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme30"></div>
                                                          </div>
                                                     
                                                       <div class="theme-take">
                                                              <div class="theme31"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme32"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme33"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme34"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme35"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme36"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme37"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme38"></div>
                                                          </div>
                                                         <div class="theme-take">
                                                              <div class="theme39"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme40"></div>
                                                          </div>
                                                     
                                                       <div class="theme-take">
                                                              <div class="theme41"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme42"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme43"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme44"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme45"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme46"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme47"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme48"></div>
                                                          </div>
                                                         <div class="theme-take">
                                                              <div class="theme49"></div>
                                                          </div>
                                                          <div class="theme-take">
                                                              <div class="theme50"></div>
                                                          </div>
                                                     
                            
                                                      </div>
                                                  </div>

                                                  <div role="tabpanel" class="tab-pane fade" id="references">
                                                    <div align="center">
                                                    <div id="colorpicker"></div>
                                                    <input type="text" id="colour" name="colour" value="#123456" readonly="">
                                                  </div>
                                                  </div>
                                                </div>
                                            <label class="switch">
                                            <input type="checkbox" name="powered" id="powered" value="powered" disabled="disabled" checked="">
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
                                <div class="screen colorgradient1" id="phonecolor">
                                <!--screen-->
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
        console.log(link);
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
    $('.btn-reset').click(function(){
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
     $(document).on('click','#solid',function(){
      $('#backtheme').val('');
    });
     // $(document).on('click','.marker',function(){
     //      $('#backtheme').val('');
     // });
      $(document).on('click','#gradient',function(){
        $('#backtheme').val('colorgradient1');
        $('.mobile1').html(' <div class="screen colorgradient1" id="phonecolor"></div>');
    });
    //  $('#powered').prop('disabled','disabled');
      $(document).bind('contextmenu',function(e){
        e.preventDefault();
      });
</script>
@endsection