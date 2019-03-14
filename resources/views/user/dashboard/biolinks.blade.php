@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/dash.css')}}">
<script src="{{asset('js/biolinks.js')}}"></script>

<script type="text/javascript">
  function tambahPages()
  {
    $.ajax({
      type: 'POST',
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType: 'text',
      data:$("#savelink").serialize(),
      url:"<?php echo url('/save-link');?>",
      success: function(result)
      {  
         refreshwa();
         refreshpixel();
         var data=jQuery.parseJSON(result);
         if(data.status=="success")
         {
            $("#pesan").html(data.message);
            $("#pesan").addClass("alert-success");
            $("#pesan").show();
         }
      }
    });
  }

  function tambahpixel() {
    $.ajax({
      type : 'POST',
       headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       url : "<?php echo url ('/save-pixel')?>",
       dataType: 'text',
       data:$("#savepixel").serialize(),
       success : function(result)
       {
         $('#script').val("");
          $('#judul').val("");
          $('#editidpixel').val("");
        refreshpixel();
       },
    });
  }

  function refreshpixel() {
   //console.log($('#idpage').val());
    $.ajax({
      type : 'GET',
      data : {
        idpage:$('#idpage').val(),
      },
      url : "<?php echo url('/pixel/load-pixel'); ?>",
      dataType: 'text',
      success: function (result)
      {
        var data=jQuery.parseJSON(result);
         $('#content').html(data.view);
         //$('.pixellink').html(data.pixelink);
      }
    });
  }

  function delete_pixel(idpixel) {
    $.ajax({
      type: 'GET',
      data: {
       idpixel:idpixel,
      },
      url : "<?php echo url ('/pixel/deletepixel'); ?>",
      dataType: 'text',
      success: function (result)
      {  
          var data=jQuery.parseJSON(result);
          if(data.status=='success')
          {
            refreshpixel();  
          }   
      }
    });
  }

  function tambahwalink() {
    $.ajax({
      type : 'POST',
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
      data :$("#savewalink").serialize(),
      url  : "<?php echo url('/save-walink');?>",
      dataType:'text',
      success : function(result)
      {
           $('#nomorwa').val("");
          $('#pesan').val("");
          $('#demo').val("");
          refreshwa();
      }
    });
    
  }

  function refreshwa() {
    $.ajax({
      type : 'GET',
      url  : "<?php echo url('/walink/loadwalink');?>",
      dataType : 'text',
      success: function (result)
      {
        var data=jQuery.parseJSON(result);
        $('#contentwa').html(data.viewer);
      }
    });
  }

  function deletewalink(idwalink) {
    $.ajax({
      type : 'GET',
      data : {
      idwalink:idwalink,
      },
      url  :"<?php echo url('/walink/deletewalink');?>",
      dataType: 'text',
      success: function (result)
      {
        var data=jQuery.parseJSON(result);
        if(data.status=='success')
        {
          refreshwa();
         
        }
      }
    });
  }

  $(document).ready(function(){
    refreshpixel();
    refreshwa();

    $( ".sortable" ).sortable({
      handle: '.handle',
      cursor: 'move',
      axis: 'y',
      stop: function (event, ui) {
        var data = $(this).sortable('serialize');
        
        $.ajax({
          data: data+'&idpage='+$('#idpage').val(),
          type: 'GET',
          url: "<?php echo url('/save-order');?>"
        });
      }
    });
    $( ".sortable" ).disableSelection();
  });

 
</script>

<style type="text/css">
  .sortable { 
    list-style-type: none; 
    margin-left: -40px;
  }
  .handle {
    cursor: move;
    padding: 10px;
  }
</style>

<div class="notification container notif">
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>

    Masa trial anda akan berakhir dalam 5 hari. <span style="color:blue;">Subscribe</span>
    untuk terus menggunakan Omnilinks

  </div>
</div>


<div class="container">
  <div class="row">
    <div class="col-md-6">

      <div id="pesan" class="alert"></div>
        
      <div class="card" style="margin-bottom:20px;">
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
   
            <!-- Tab Link -->
            <div role="tabpanel" class="tab-pane fade in active show" id="link">
              <form method="post" id="savelink" novalidate>
                {{ csrf_field() }}

                <input type="hidden" name="uuid" value="{{$uuid}}">

                <!-- Messengers -->
                <label class="mb-3" for="" style="font-weight:bold;">
                  Messengers :
                </label>
                <button type="button" class="float-right btn btn-primary btn-sm"  id="tambah">
                  <i class="fas fa-plus"></i>
                </button>

                <div class="hid">
                  <ul class="sortable">
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
                          <div class="offset-md-1 offset-1 col-md-11 col-11">
                            <select name="wapixel" class="form-control">
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

                    <li id="msg-telegram">
                      <div id="telegram" class="messengers hidden" style=" display:none;">

                        <div class="row">
                          <div class="col-md-1 col-1 pl-md-3 pl-2">
                            <span class="handle">
                              <i class="fas fa-bars"></i>
                            </span>
                          </div>

                          <div class="col-md-11 col-11">     
                            <div class="input-group margin" >
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <i class="fab fa-telegram-plane"></i>
                                </div>
                              </div>

                              <input type="text" name="telegram" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan nomor telegram" >

                              <button type="button" class="btn  btn-primary" id="deletetelegram">
                                <i class="fas fa-trash-alt"></i>
                              </button>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="offset-md-1 offset-1 col-md-11 col-11">
                            <select name="telegrampixel" class="form-control">
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

                    <li id="msg-skype">
                      <div id="skype" class="messengers hidden" style="display:none;">

                        <div class="row">
                          <div class="col-md-1">
                            <span class="handle">
                              <i class="fas fa-bars"></i>
                            </span>    
                          </div>
                          <div class="col-md-11">
                            <div class="input-group margin" >
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <i class="fab fa-skype"></i>
                                </div>
                              </div>

                              <input type="text" name="skype" onkeypress="return hanyaAngka(event)" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan nomor Skype">

                              <button id="deleteskype" class="btn btn-primary" type="button">
                                <i class="fas fa-trash-alt"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="offset-md-1 col-md-11">
                            <select name="skypepixel" class="form-control">
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
                </div> 

                <!--Links-->
                <label for="" style="font-weight:bold;">
                  Links :
                </label>

                <button type="button" class="float-right mb-3 btn btn-primary btn-sm"  id="addlink">
                  <i class="fas fa-plus"></i> 
                  Add Link
                </button>

                <br>

                <div class="a">
                  <div class="input-stack">
                    <input type="text" name="title[]" value="" placeholder="Title" class="form-control" >
                    <input type="text" name="url[]" value="" placeholder="http://url..." class="form-control" style="margin-bottom:20px;">
                    <button class="deletelink btn btn-primary" type="button">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </div>
                </div>

                <!--social media-->
                <label for="" style="font-weight:bold">
                  Social Media
                </label>
                <button type="button" class="float-right mb-3 btn btn-primary btn-sm" id="sm">
                  <i class="fas fa-plus"></i>
                </button>

                <div id="youtube" class="socialmedia">
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
  
                <div id="fb" class="socialmedia hidden" style="display:none;">
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

                <div id="twitter" class="socialmedia hidden" style=" display:none;">
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

                <div id="ig" class="socialmedia hidden" style=" display:none;">
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

                <div class="as">
                  <hr class="own">
                  <button type="button" id="btn-save-link" class="btn btn-primary btn-biolinks ">
                    <i class="far fa-save" style="margin-right:5px;"></i>
                    SAVE
                  </button>
                </div>
              </form>
            </div>

            <!-- Tab WA Link -->
            <div role="tabpanel" class="tab-pane fade " id="walink">
              <form id="savewalink" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="uuidpixel" value="{{$uuid}}">

                <span class="" style="color:blue">
                  WhatsApp Link Creator
                </span>

                <br>

                <span>Masukkan Nomor WA</span>
                <input type="text" name="nomorwa" id="nomorwa" class="">
                <button type="reset" class="btn btn-danger" style="margin-top: 10px; margin-bottom: 10px;">
                  Reset
                </button>

                <div class="card">
                  <span class="card-header">
                    Masukkan Pesan
                  </span>
                  <textarea class="card-body form-control" name="pesan" id="pesan">
                  </textarea>
                </div>

                <input type="text" name="editidwa" hidden id="editidwa">
                <textarea id="demo" hidden="" name="textlink">
                </textarea>

                <button type="button" class="btn btn-primary btn-biolinks" id="generate" style="margin-top: 20px;">
                  SAVE & CREATE LINK
                </button>
              </form>

              <div class="margin" style="margin-top: 47px;">
                <span style="color:blue;">
                  Recent WhatsApp Link Creator
                </span>

                <div class="accordion" id="accordionExample">
                  <div id="contentwa"></div>
                </div>    
              </div>
            </div>
  
            <!-- Tab Pixel --> 
            <div class="tab-pane fade" id="pixel">
              <form id="savepixel" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="uuidpixel" value="{{$uuid}}">
                <input type="hidden" name="idpage" id="idpage" value="{{$pageid}}">

                <span style="color:blue;">
                  Pixel Retargetting
                </span>
                <textarea class="card-body form-control" name="script" id="script" ></textarea>

                <div class="title" style="margin-top: 20px;">
                  <span>Title</span>
                  <input type="text" name="title" placeholder="Masukkan Judul" id="judul">
                  <input type="text" name="editidpixel" hidden id="editidpixel" >
                  <button type="button" id="btnpixel" class="btn btn-primary">
                    Save
                  </button>
                  <button type="reset" class="btn btn-warning">
                    Reset
                  </button>
                </div>
              </form>

              <hr class="own">

              <span style="color:blue;">
                Recent Pixel Retargetting
              </span>

              <div class="accordion" id="accordionExample">
                <div id="content"></div>
              </div>        
            </div>

            <!-- TAB 4 -->
            <div role="tabpanel" class="tab-pane fade" id="style">
              <form method="post" action="{{url('save-template')}}" novalidate>
                {{ csrf_field() }}
                <input type="hidden" name="" value="{{$uuid}}">
                <div class="mb-5 form-group">
                  <label>
                    Bio Link alias:
                  </label>
                  <div>
                    <div class="">
                      <span>Omni.by/</span>
                      <input type="text" name="judul" value=""   class="form-control" placeholder="Masukkan judul">
                      <input type="text" name="link"  value=""   class="form-control" placeholder="masukkan link">
                      <input type="number" name="nomor" value="" class="form-control" placeholder="masukkan nomor">  
                    </div>
                  </div>
                </div>

                <label class="switch">
                  <input type="checkbox">
                  <span class="slider round"></span>
                </label> &nbsp;Rounded buttons<br>

                <label class="switch">
                  <input type="checkbox" name="rounded">
                  <span class="slider round"></span>
                </label> &nbsp; outlinend buttons

                <div class="as">
                  <hr class="own">
                  <button type="submit" class="btn btn-primary btn-biolinks ">
                    <i class="far fa-save" style="margin-right:5px;"></i>
                    SAVE
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>  
    </div>
  </div>
</div>

<script type="text/javascript">
  $( "body" ).on( "click", ".btn-delete", function() {
    var idpixel = $(this).attr('dataid');
    delete_pixel(idpixel); 
  });

  $("body").on("click",".btn-deletewa",function(){
    var idwalink=$(this).attr('dataidwa');
    deletewalink(idwalink);
  });

  $(document).on('click', '#generate', function (e){
    var nomor=$('#nomorwa').val();
    var message=$('#pesan').val();
    var convert=encodeURI(message);
    var link ="https://api.whatsapp.com/send?phone="+nomor+"&text="+convert+"";
    console.log(link);
    $('#demo').html(link);
    tambahwalink();
  });

  $(document).on("click","#btnpixel",function(e){
    tambahpixel();
  });

  $(document).on("click","#btn-save-link",function(e){
    tambahPages();
  });

  $(document).on('click','.btn-editwa',function(e){
    var editnomorwa=$(this).attr("datanomorwa");
    var editpesan=$(this).attr("datapesan");
    var editidwa=$(this).attr("dataeditwa");
    $('#editidwa').val(editidwa);
    $('#nomorwa').val(editnomorwa);
    $('#pesan').val(editpesan);
  });

  $(document).on('click','.btn-editpixel',function(e){
    var script=$(this).attr("datascriptpixel");
    var title=$(this).attr("dataedittitle");
    var editidpixel=$(this).attr("dataeditpixelid");
    $('#script').val(script);
    $('#judul').val(title);
    $('#editidpixel').val(editidpixel);
  });
</script>

@endsection

