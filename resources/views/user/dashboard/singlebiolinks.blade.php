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
      success:function(result){
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
      success: function(result) {
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
      success: function(result) {
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
    success:function(result)
    {
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
      success: function(result) {
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
      success: function(result) {
                //$('#formlink').load();
                loadSingleLinks();
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
      success: function(result) {
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

.table td, .table th{
  border: none;
}
.table thead th {
  background-color: #F0F0F0;
  border: none;
}
table tr:nth-child(odd) td
{
  background-color:#F6F6F6;

}
table tr:nth-child(even) td
{
 background-color:#F0F0F0;
}
.btn-primary{
  background-color: #106BC8;
}
.labell{
  font-size: 16px;
}

</style>

<section id="tabs" class="project-tab">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="notif">
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <button type="button" class="close" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>Masa trial anda akan berakhir dalam 5 hari. <span style="color:#2C8EF2;">Subscribe</span>
            untuk terus menggunakan Omnilinks
          </div>
        </div>
        <div id="pesan" class="alert"></div>

        <div class="card carddash" style="margin-bottom:20px;">
          <div class="card-body">
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
              <a class="nav-link active" href=".links" data-target=".links" role="tab" data-toggle="tab" id="link-tab">
                Link
              </a>
              <a class="nav-link" href=".pixels" data-target=".pixels" role="tab" data-toggle="tab" id="pixel-tab">
                Pixel
              </a>
            </div>

            <!-- Tab panes -->
            <div class="tab-content mt-4" id="nav-tabContent">
              <!--Tab Link-->
              <div role="tabpanel" class="tab-pane fade in active show links" id="link">
                <form method="post" id="formlink" novalidate>
                  {{ csrf_field() }}
                  <div class="form-group row">
                    <label for="title" class="col-md-2 col-form-label labell gray-txt text-right">
                      Your Title
                    </label>
                    <input id="titlelink" type="text" class="col-md-6  form-control" name="title" placeholder="" required>
                  </div>

                  <div class="form-group row">
                    <label for="url" class="col-md-2 col-form-label labell gray-txt text-right">
                      URL
                    </label>
                    <input type="text" class="col-md-6 form-control" name="url" placeholder="" required id="urllink">
                  </div>

                  <div class="form-group row">
                    <label for="password-confirm" class="col-md-2 col-form-label labell gray-txt text-right">
                      Pixel
                    </label>

                    <select name="idpixel" id="idpixel" class="col-md-6 form-control">

                    </select>
                  </div>
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


              <!--Tab Pixel-->
              <div role="tabpanel" class="tab-pane fade pixels" id="pixel">
                <form method="post" id="formpixel" novalidate>
                  {{ csrf_field() }}
                  <div class="form-group row">
                    <label for="password-confirm" class="col-md-2 col-form-label labell gray-txt text-right">
                      Your Title
                    </label>
                    <input id="titlepixel" type="text" class="col-md-6 form-control" name="titlepixel" placeholder="" required>
                  </div>
                  <div class="form-group row">
                    <label for="password-confirm" class="col-md-2 float-right col-form-label labell gray-txt text-right">
                      Pixel
                    </label>
                    <textarea name="script" id="script" class="col-md-6 form-control" required=""></textarea>

                  </div>
                  <input type="text" id="hiddenid" hidden="" name="hiddenid">
                  <div class="form-group row">
                    <div class="col-md-3 offset-md-2">  
                      <button type="reset" class="btn btn-danger btncreate btn-reset">
                        RESET
                      </button>
                      <button id="submitpixel" type="button" class="btn btn-primary btncreate btnbio">
                        CREATE
                      </button>
                    </div>
                  </div>
                </form>
              </div>

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
              <div style="float: right;">
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
                    <th class="">
                      Pixel
                    </th>
                    <th class="">
                      Link
                    </th>
                    <th>
                      Action
                    </th>
                  </thead>
                  <tbody id="contentlink">

                  </tbody>
                </table>
                <div id="pageer">

                </div>
              </div>
            </div>
          </div>
          
          <div class="pixels2">
            <div id="search-pixel" style="margin-bottom: 20px">
              <span class="blue-txt" style="font-size: 24px">
                Recent
              </span>
              <div style="float: right;">
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

                    </th>
                    <th class="">
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
<script type="text/javascript">
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
    $('#pesan').addClass('alert-danger').html('<div class="resetedit">anda dalam mode edit tekan reset untuk membatalkan</div>');
    console.log(ideditpixel);
    $('#hiddenid').val(ideditpixel);
    $('#titlepixel').val(title);
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