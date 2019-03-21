@extends('layouts.app')

@section('content')
<script type="text/javascript">
    var currentPageLink = "";
    var currentPagePixel = "";
    var groupTab = "link";

    function loadSinglePixel() {
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
   
    function loadSingleLinks() {
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
            url: "<?php echo url('/save-singlelink')?>",
            data: $("#formlink").serialize(),
            dataType: 'text',
            success: function(result) {
                $('#titlelink').val("");
                $('#urllink').val("");
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
            url: "<?php echo url('/save-singlepixel') ?>",
            data: $("#formpixel").serialize(),
            dataType: 'text',
            success: function(result) {
                $('#titlepixel').val("");
                $('#script').val("");
                loadSinglePixel();
                loadSingleLinks();
            }
        });
    }

    $(document).ready(function() {
        loadSinglePixel();
        loadSingleLinks();
    });
</script>
<style type="text/css">
    .formin {
        margin-left: 20px;
        padding-left: 20px;
    }
    .btn-console{
        border-radius: 16px;
    }
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
      font-size: larger;
    }

</style>
<link rel="stylesheet" href="{{asset('css/dash.css')}}">

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
                      <a class="nav-link active" href=".links" role="tab" data-toggle="tab" id="link-tab">Link</a>
                      <a class="nav-link" href=".pixels" role="tab" data-toggle="tab" id="pixel-tab">Pixel</a>
                   </div>
                    <!-- Tab panes -->
                    <div class="tab-content" id="nav-tabContent">
                        <!--Tab Link-->
                        <div role="tabpanel" class="tab-pane fade in active show links" id="link">
                            <form method="post" id="formlink" novalidate>
                                {{ csrf_field() }}
                                <div class="form-group row" style="margin-top: 40px;">
                                    <label for="title" class="col-md-2 col-form-label labell">Your title
                                    </label>
                                    <input id="titlelink" type="text" class="col-md-6  form-control" name="title" placeholder="" required>
                                </div>

                                <div class="form-group row">
                                    <label for="url" class="col-md-2 col-form-label labell">Url
                                    </label>
                                    <input type="text" class="col-md-6 form-control" name="url" placeholder="" required id="urllink">
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-2 col-form-label labell">Pixel
                                    </label>
                                    <input type="hidden" name="idlink" id="idlink"> 
                                    <select name="idpixel" id="idpixel" class="col-md-6 form-control">

                                        <option value="">--Pilih--</option>
                                        @foreach($data_pixel as $pixel)
                                        <option value="{{$pixel->id}}">{{$pixel->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group row">
                                  <div class="col-md-3 offset-md-2">
                                 <button type="reset" class="btn btn-danger btn-lg btn-console btn-reset">RESET</button>
                                <button type="button" id="submitlink" class="btn btn-primary btn-lg btn-console">GENERATE</button>
                                  </div>
                                </div>
                            </form>
                        </div>

                        
                        <!--Tab Pixel-->
                        <div role="tabpanel" class="tab-pane fade pixels" id="pixel">
                            <form method="post" id="formpixel" novalidate>
                                {{ csrf_field() }}
                                <div class="form-group row" style="margin-top: 40px;">
                                    <label for="password-confirm" class="col-md-2 col-form-label labell">Your title
                                    </label>
                                    <input id="titlepixel" type="text" class="col-md-6 form-control" name="titlepixel" placeholder="" required>
                                </div>
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-2 float-right col-form-label labell">Pixel
                                    </label>
                                    <textarea name="script" id="script" class="col-md-6 form-control" required=""></textarea>
                                </div>
                                <input type="text" id="hiddenid" hidden="" name="hiddenid">
                                <div class="form-group row">
                                  <div class="col-md-3 offset-md-2">  
                                <button type="reset" class="btn btn-danger btn-console btn-lg btn-reset">RESET</button>
                                <button id="submitpixel" type="button" class="btn btn-primary btn-console btn-lg">CREATE</button>
                                  </div>
                                </div>
                            </form>
                        </div>

                    </div>
                  
                </div>
            </div>

            <div id="search-link" style="margin-bottom: 20px;">
                <span style="font-size: 30px; color: #3A84D1; ">Recent</span>
                <div style="float: right;">
                    <input type="search" name="carilink" placeholder="Search Link" class="carilink form-controll form-control" arial-label="Search" style="">
                    <button class="btn btn-success" id="carilink" type="button">Search</button>
                </div>
            </div>

            <div id="search-pixel" style="margin-bottom: 20px; display: none;" class="hidden">
                <span style="font-size: 30px; color: #3A84D1;">Recent</span>
                <div style="float: right;">
                    <input type="search" name="cari" placeholder="Search Pixel" class="cari form-controll form-control" arial-label="Search">
                    <button class="btn btn-success" id="caripixel" type="button">Search</button>
                </div>
            </div>

            
                    <!--table link-->
                    <div id="table-link">

                        <table class="table" >
                            <thead align="center">
                                <th class="">
                                    title
                                </th>
                                <th class="">
                                    pixel
                                </th>
                                <th class="">
                                    link
                                </th>
                                <th>
                                action
                                </th>
                            </thead>
                            <tbody id="contentlink">

                            </tbody>
                        </table>
                        <div id="pageer">

                        </div>
                    </div>

                    <div id="table-pixel" class="hidden" style="display: none;">
                        <table class="table">
                            <thead align="center">
                                <th class="">
                                    title
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
</section>

<script type="text/javascript">
    $("body").on("click", "#caripixel", function() {
        loadSinglePixel();
    });

    $("body").on("click", "#carilink", function() {
        loadSingleLinks();
    });

    $("body").on("click", ".btn-deletepixelsingle", function() {
        var idpixel = $(this).attr('dataid');
        deleteSinglePixel(idpixel);
    });
    $('body').on('click','.btn-deletelink',function(){
       var idlink=$(this).attr('datadeleteid');
        deleteLink(idlink);
    });
    $("body").on("click", "#submitlink", function() {
        tambahLink();
    });

    $("body").on("click", "#submitpixel", function() {
        tambahPixel();
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
    $(document).on('click', '#link-tab', function() {
        groupTab = "link";
        $('#table-pixel').hide();
        $('table-pixel').addClass('hidden');
        $("#table-link").show();
        $("#table-link").removeClass('hidden');
        $('#search-pixel').hide();
        $('search-pixel').addClass('hidden');
        $("#search-link").show();
        $("#search-link").removeClass('hidden');
        return false;
    });
    $(document).on('click', '#pixel-tab', function() {
        groupTab = "pixel";
        $('#table-link').hide();
        $('table-link').addClass('hidden');
        $("#table-pixel").show();
        $("#table-pixel").removeClass('hidden');
        $('#search-link').hide();
        $('#search-link').addClass('hidden');
        $("#search-pixel").show();
        $("#search-pixel").removeClass('hidden');
        return false;
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