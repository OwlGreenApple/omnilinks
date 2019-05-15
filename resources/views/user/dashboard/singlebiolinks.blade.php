@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/dash.css')}}">

<script type="text/javascript">
  var currentPageLink = "";
  var currentPagePixel = "";
  var groupTab = "link";

  function loadPixelLink()
  {
    $.ajax({
      type: 'GET',
      url: '<?php echo url('/pixel/loadPixelLink'); ?>',
      dataType:'text',
      beforeSend: function() {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success:function(result){
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        var data=jQuery.parseJSON(result);
        $('#idpixel').html(data.view);
      }
    });      
  }

  function loadSinglePixel() 
  {
    if (currentPagePixel == "") {
      currentPagePixel = "<?php echo url('/pixel/load-singlepixel'); ?>";
    }

    $.ajax({
      type: 'GET',
      data: {
        cari: $('.cari').val(),
      },
      url: currentPagePixel,
      dataType: 'text',
      beforeSend: function() {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        var data = jQuery.parseJSON(result);
        $('#contentpixel').html(data.view);
        $('#pager').html(data.pager);
      }
    });
  }

  function loadSingleLinks() 
  {
    if (currentPageLink == "") {
      currentPageLink = "<?php echo url('/dash/newsingle/load-singlelink')?>";
    }

    $.ajax({
      type: 'GET',
      data: {
        carilink: $('.carilink').val(),
      },
      url: currentPageLink,
      dataType: 'text',
      beforeSend: function() {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        var data = jQuery.parseJSON(result);
        $('#contentlink').html(data.view);
        $('#pageer').html(data.pager);
      }
    });
  }

  function deleteLink(idlink)
  {
    $.ajax({
     type:'GET', 
     data:{
      idlink:idlink,  
    },
    url:"<?php echo url('/link/deletesinglelink');?>",
    dataType:'text',
    beforeSend: function() {
      $('#loader').show();
      $('.div-loading').addClass('background-load');
    },
    success:function(result) {
      $('#loader').hide();
      $('.div-loading').removeClass('background-load');

      var data = jQuery.parseJSON(result);
      if(data.status=="success"){
        loadSingleLinks();
      }
    }
  });
  }

  function deleteSinglePixel(idpixel) {
    $.ajax({
      type: 'GET',
      data: {
        idpixel: idpixel,
      },
      url: "<?php echo url('/pixel/deletesinglepixel');?>",
      dataType: 'text',
      beforeSend: function() {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        var data = jQuery.parseJSON(result);
        if (data.status == "success") {
          loadSinglePixel();
        }
      }
    });
  }

  function tambahLink() {
    $.ajax({
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "<?php echo url('/save-singlelink'); ?>",
      data: $("#formlink").serialize(),
      dataType: 'text',
      beforeSend: function() {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        var data = jQuery.parseJSON(result);
        if (data.status=="success") {
          $("#pesan").html(data.message);
          $("#pesan").addClass("alert-success");
          loadSingleLinks();
        }
        else if(data.status=="gagal"){
          $("#confirm-error").modal('show');
            // loadSingleLinks();
          }
        }
     });
  }

  function tambahPixel() {
    $.ajax({
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "<?php echo url('/save-singlepixel'); ?>",
      data: $("#formpixel").serialize(),
      dataType: 'text',
      beforeSend: function() {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        $('#titlepixel').val("");
        $('#script').val("");
        loadSinglePixel();
        loadSingleLinks();
        loadPixelLink();
      }
    });
  }

  $(document).ready(function() {
    $('.pixels2').hide();
    loadSinglePixel();
    loadSingleLinks();
    loadPixelLink();
  });
</script>
<style type="text/css">
.text-card{
  margin-left: 20px;
}

.btn-primary{
  background-color: #106BC8;
}
.labell{
  font-size: 16px;
}
.btn-copy {
  cursor: pointer;
}

</style>

<section id="tabs" class="offset-md-1 col-md-10" style="margin-bottom: 50px;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <button type="button" class="close" aria-label="Close" data-dismiss="alert">
            <span aria-hidden="true">×</span>
          </button>
          Masa trial anda akan berakhir dalam 5 hari. <span style="color:blue;">Subscribe</span>
          untuk terus menggunakan Omnilinks
        </div>

        <div id="pesan" class="alert"></div>
        
        <div class="card carddash" style="margin-bottom:50px;">
          <div class="card-body">
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
              <a class="nav-link active" href=".links" data-target=".links" role="tab" data-toggle="tab" id="link-tab">
                Link
              </a>

              @if((Auth::user()->membership=='basic') OR (Auth::user()->membership=='elite'))
                <a class="nav-link" href=".pixels" data-target=".pixels" role="tab" data-toggle="tab" id="pixel-tab">
                  Pixel
                </a>
              @endif

            </div>

            <!-- Tab panes -->
            <div class="tab-content mt-4" id="nav-tabContent">
              <!--Tab Link-->
              <div role="tabpanel" class="tab-pane fade in active show links" id="link">
                <form method="post" id="formlink" novalidate>
                  {{ csrf_field() }}
                  <div class="form-group row">
                    <label for="title" class="col-lg-2 col-md-3 col-form-label labell gray-txt text-md-right text-left">
                      Your Title
                    </label>
                    <div class="col-md-6 col-12">
                      <input id="titlelink" type="text" class="col-md-12  form-control" name="title" placeholder="" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="url" class="col-lg-2 col-md-3 col-form-label labell gray-txt text-md-right text-left">
                      URL
                    </label>
                    <div class="col-md-6 col-12">
                      <input type="text" class="col-md-12 form-control" name="url" placeholder="" required id="urllink">  
                    </div>
                  </div>

                  @if((Auth::user()->membership=='basic') OR (Auth::user()->membership=='elite'))
                    <div class="form-group row">
                      <label for="password-confirm" class="col-lg-2 col-md-3 col-form-label labell gray-txt text-md-right text-left">
                        Pixel
                      </label>

                      <div class="col-md-6 col-12">
                        <select name="idpixel" id="idpixel" class="col-md-12 form-control">
                        </select>  
                      </div>
                    </div>
                  @endif

                  <input type="text" hidden="" name="idlink" id="idlink"> 

                  <div class="form-group row">
                    <div class="col-md-10 offset-md-2">
                      <button type="reset" class="btn btn-danger btn-console btn-reset btncreate">
                        RESET
                      </button>
                      <button type="button" id="submitlink" class="btn btn-console btnbio btncreate">
                        GENERATE
                      </button>
                    </div>
                  </div>
                </form>
              </div>

              @if((Auth::user()->membership=='basic') OR (Auth::user()->membership=='elite'))
                <!--Tab Pixel-->
                <div role="tabpanel" class="tab-pane fade pixels" id="pixel">
                  <form method="post" id="formpixel" novalidate>
                    {{ csrf_field() }}
                    <div class="form-group row">
                      <label for="password-confirm" class="col-lg-2 col-md-3 col-form-label labell gray-txt text-md-right text-left">
                        Your Title
                      </label>
                      <div class="col-md-6 col-12">
                        <input id="titlepixel" type="text" class="col-md-12 form-control" name="titlepixel" placeholder="" required>  
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-2 col-md-3 float-right col-form-label labell gray-txt text-md-right text-left">
                        Jenis
                      </label>
                      <div class="col-md-6 col-12">
                        <select name="jenis_pixel" id="jenis_pixel" class="col-md-12 form-control">
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
                    <div class="form-group row">
                      <label for="password-confirm" class="col-lg-2 col-md-3 float-right col-form-label labell gray-txt text-md-right text-left">
                        Pixel
                      </label>
                      <div class="col-md-6 col-12">
                        <textarea name="script" id="script" class="col-md-12 form-control" required=""></textarea>  
                      </div>
                    </div>
                    <input type="text" id="hiddenid" hidden="" name="hiddenid">
                    <div class="form-group row">
                      <div class="col-md-3 offset-md-2">  
                        <button type="reset" class="btn btn-danger btncreate btn-reset btn-console">
                          RESET
                        </button>
                        <button id="submitpixel" type="button" class="btn btn-primary btncreate btnbio btn-console">
                          CREATE
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              @endif
            </div>

          </div>
        </div>

        <div class="tab-content">
          <!--Tab Link-->
          <div class="links2">
            <div id="search-link" style="margin-bottom: 20px;">
              <span class="blue-txt" style="font-size: 24px">
                Recent
              </span>
              <div class="float-none float-md-right">
                <input type="search" name="carilink" placeholder="Search Link" class="carilink form-controll form-control" arial-label="Search" style="background-color: #fff;">
                <button class="btn btn-success" id="carilink" type="button">Search</button>
              </div>
            </div> 

            <!--table link-->
            <div id="table-link-save">
              <div id="table-link">

                <table class="table" >
                  <thead align="center">
                    <th class="">
                      Title
                    </th>
                    @if((Auth::user()->membership=='basic') OR (Auth::user()->membership=='elite'))
                      <th class="menu-nomobile">
                        Pixel
                      </th>
                    @endif
                    <th class="menu-nomobile">
                      Link
                    </th>
                    <th>
                      Action
                    </th>
                  </thead>
                  <tbody id="contentlink">

                  </tbody>
                </table>

                <div id="pageer"></div>

              </div>
            </div>
          </div>

          @if((Auth::user()->membership=='basic') OR (Auth::user()->membership=='elite'))
            <div class="pixels2">
              <div id="search-pixel" style="margin-bottom: 20px">
                <span class="blue-txt" style="font-size: 24px">
                  Recent
                </span>
                <div class="float-none float-md-right">
                  <input type="search" name="cari" placeholder="Search Pixel" style="background-color: #fff;" class="cari form-controll form-control" arial-label="Search">
                  <button class="btn btn-success" id="caripixel" type="button">Search</button>
                </div>
              </div>

              <!--table pixel-->
              <div id="table-pixel-save">
                <div id="table-pixel">
                  <table class="table">
                    <thead align="center">
                      <th class="">
                        Title
                      </th>
                      <th class="menu-nomobile">
                        Last Modified
                      </th>
                      <th class="">
                        Action
                      </th>
                    </thead>
                    <tbody id="contentpixel"></tbody>
                  </table>
                  <div id="pager"></div>
                </div>
              </div>
            </div>
          @endif
        </div>

      </div>
    </div>
  </div>
</section>

<!-- Modal Delete Confirmation -->
<div class="modal fade" id="confirm-delete-pixel" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modaltitle">
          Delete Confirmation
        </h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete?
        <input type="hidden" name="id_deletepixel" id="id_deletepixel">
      </div>
      <div class="modal-footer" id="foot">
        <button class="btn btn-danger btn-delete-pixel" data-dismiss="modal">
          Yes
        </button>
        <button class="btn" data-dismiss="modal">
          Cancel
        </button>
      </div>
    </div>

  </div>
</div>

<div class="modal fade" id="confirm-error" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modaltitle">
          Error message
        </h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        maaf anda sudah tidak bisa membuat link ini lagi mohon untuk upgrade Omnilinks <a href="{{asset('/pricing')}}" target="_blank">Upgrade</a>
      </div>
      
    </div>

  </div>
</div>

<!-- Modal Delete Confirmation -->
<div class="modal fade" id="confirm-delete-link" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modaltitle">
          Delete Confirmation
        </h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete?
        <input type="hidden" name="id_deletelink" id="id_deletelink">
      </div>
      <div class="modal-footer" id="foot">
        <button class="btn btn-danger btn-delete-link" data-dismiss="modal">
          Yes
        </button>
        <button class="btn" data-dismiss="modal">
          Cancel
        </button>
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
          Copy 
        </h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        Copy berhasil!
      </div>
      <div class="modal-footer" id="foot">
        <button class="btn btn-primary" data-dismiss="modal">
          OK
        </button>
        <button class="btn" data-dismiss="modal">
          Cancel
        </button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
  $( "body" ).on( "click", ".view-details", function() {
    var id = $(this).attr('data-id');

    $('.details-'+id).toggleClass('d-none');
  });

  $( "body" ).on( "click", ".view-details-pixel", function() {
    var id = $(this).attr('data-id');

    $('.details-pixel-'+id).toggleClass('d-none');
  });

  $( "body" ).on( "click", ".btn-copy", function(e) 
  {
    e.preventDefault();
    e.stopPropagation();

    var link = $(this).attr("data-copy");

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

  /*$('.nav-tabs a').click(function () {
    console.log($(this).data("second-tab"));
    $(this).tab('show');
    $("<a>").attr("href", $(this).data("second-tab")).tab("show");
  })*/

  $(document).on('click', '#link-tab', function() {
    groupTab = "link";
    /*$('#table-pixel-save').children().remove();
    $('#table-link-save').html('<div id="table-link"><table class="table"><thead align="center"><th class="">Title</th><th class="">Pixel</th><th class="">Link</th><th>Action</th></thead><tbody id="contentlink"></tbody></table><div id="pageer"></div></div>');
    loadSingleLinks();
    $('#formpixel').trigger('reset');
    $('#search-pixel').hide();
    $('#search-pixel').addClass('hidden');
    $("#search-link").show();
    $("#search-link").removeClass('hidden');
    //return false;*/
    $('.links2').show();
    $('.pixels2').hide();
  });

  $(document).on('click', '#pixel-tab', function() {
    groupTab = "pixel";
    /*$('#table-link-save').children().remove();
    $('#table-pixel-save').html('<div id="table-pixel"><table class="table"><thead align="center"><th class="">Title</th><th class="">Last Modified</th><th class="">Action</th></thead><tbody id="contentpixel"></tbody></table><div id="pager"></div></div>');
    loadSinglePixel();
    $("#formlink").trigger('reset');
    $('#search-link').hide();
    $('#search-link').addClass('hidden');
    $("#search-pixel").show();
    $("#search-pixel").removeClass('hidden');
    //return false;*/
    $('.pixels2').show();
    $('.links2').hide();
  });

  $("body").on("click", "#caripixel", function() {
    loadSinglePixel();
  });

  $("body").on("click", "#carilink", function() {
    loadSingleLinks();
  });

  $("body").on("click", ".btn-deletepixelsingle", function(e) {
    e.preventDefault();
    e.stopPropagation();
    $('#id_deletepixel').val($(this).attr('dataid'));
    $('#confirm-delete-pixel').modal('show');
  });
  $("body").on("click",".btn-delete-pixel",function(e){
    var iddeletepixel = $('#id_deletepixel').val();
    deleteSinglePixel(iddeletepixel);
  });

  $('body').on('click','.btn-deletelink',function(e){
    e.preventDefault();
    e.stopPropagation();
    $('#id_deletelink').val($(this).attr('datadeleteid'));
    $('#confirm-delete-link').modal('show');

  });
  $('body').on('click','.btn-delete-link',function(){
    var idlink=$('#id_deletelink').val();
    deleteLink(idlink); 
  });
  $("body").on("click", "#submitlink", function() {
    tambahLink();
    $('#pesan').removeClass('alert-danger');
    $('#pesan').children().remove();
  });

  $("body").on("click", "#submitpixel", function() {
    tambahPixel();
    $('#pesan').removeClass('alert-danger');
    $('#pesan').children().remove();
  });

  $("body").on("click",".btn-editlink",function(){
    var ideditlink=$(this).attr('dataeditid');
    var datatitle=$(this).attr('datatitle');
    var dataurl=$(this).attr('datalink');
    var datapixel=$(this).attr('datapixelid');
    var textpixel=$(this).attr('textpixel');
    $('#pesan').addClass('alert-danger').html('<div class="resetedit">anda dalam mode edit tekan reset untuk membatalkan</div>');
    $('#titlelink').val(datatitle);
    $('#urllink').val(dataurl);
    $('#idlink').val(ideditlink);
    $('#idpixel').val(datapixel);

  });

  $('.btn-reset').click(function(){
    $('#pesan').removeClass('alert-danger');
    $('#pesan').children().remove();
  });

  $("body").on("click", ".btn-editpixel", function() {
    var ideditpixel = $(this).attr('dataeditid');
    var title = $(this).attr('datatitle');
    var script = $(this).attr('datascript');
    var jenis = $(this).attr('datajenis');

    $('#pesan').addClass('alert-danger').html('<div class="resetedit">anda dalam mode edit tekan reset untuk membatalkan</div>');
    console.log(ideditpixel);
    $('#hiddenid').val(ideditpixel);
    $('#titlepixel').val(title);
    $('#jenis_pixel').val(jenis);
    $('#script').val(script);
  });

  $(document).on('click', '.pagination a', function(e) {
    e.preventDefault();
    if (groupTab == "link") {
      currentPageLink = $(this).attr('href');
      loadSingleLinks();
    } else {
      currentPagePixel = $(this).attr('href');
      loadSinglePixel();
    }
  });
</script>
@endsection