@extends('layouts.app')

@section('content')
<?php use App\Helpers\Helper; ?>

<link rel="stylesheet" href="{{asset('css/dash.css')}}">
<link rel="stylesheet" href="{{asset('css/sb-admin.css')}}">

 
<script type="text/javascript">
  var currentPage="";
  var chart = '';

  function load_chart(){
    $.ajax({                                      
      url: "<?php echo url('/dash/load-chart'); ?>",
      type: 'get',
      data : {
        bulan : $('#bulan').val(),
        tahun : $('#tahun').val(),
      },
      dataType: 'json',
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(data) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');
        
        chart = new CanvasJS.Chart("chartContainer", {
              animationEnabled: true,
              axisX:{
                valueFormatString: "DD",
                title: "Hari",
              },
              axisY:{
                title: "Total Click",
              },
              legend:{
                cursor: "pointer",
                dockInsidePlotArea: true,
                itemclick: toggleDataSeries
              },              
              data: [
              {
                type: "area",       
                xValueType: "dateTime",
                xValueFormatString: "DD-MM-YYYY",
                dataPoints: data.chart,
              }]
            });

          chart.render();

          function toggleDataSeries(e){
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
              e.dataSeries.visible = false;
            }
            else{
              e.dataSeries.visible = true;
            }
            chart.render();
          }

          $('#total-click').html(data.total_click);

          <?php if(Auth::user()->membership=='free') { ?>
            $('.show-chart').hide();
          <?php } ?>
      }
    });
  }

  function refreshDashboard() {
    if(currentPage=="") {
      currentPage = "<?php echo url('/dash/load-dashboard'); ?>";
    }

    $.ajax({
      type: 'GET',
      url: currentPage,
      data : {
        keywords : $('#keywords').val(),
        bulan : $('#bulan').val(),
        tahun : $('#tahun').val(),
      },
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
        $('.pager').html(data.pager);
      }
    });
  }

  function deletePages(deletedataid) {
    $.ajax({
      type: 'GET',
      url: "<?php echo url('/dash/delete-pages'); ?>",
      dataType: 'text',
      data: {
        deletedataid: deletedataid,
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
        if (data.status == 'success') {
          refreshDashboard();
          var src = "{{asset('image/success.gif')}}"+"?a="+Math.random();;
          $('#img-success').attr('src',src);
          $('#delete-success').modal('show');
          setTimeout(function(){
            $('#delete-success').modal('hide')
          }, 3000);
        }
      }
    });
  }

  $(document).ready(function() {
    refreshDashboard();
    load_chart();
  });

</script>

<div class="container mb-5 main-cont" style="">
  <div class="row">
    @if (session('error'))
    <div class="col-md-12 mb-3">

      <!--@if(Auth::user()->membership=='free')
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <button type="button" class="close" aria-label="Close" data-dismiss="alert">
            <span aria-hidden="true">×</span>
          </button>
          <?php  
            $time = Helper::get_trial_time();
            echo $time;
          ?>
          
          <a href="{{url('pricing')}}">
            Subscribe
          </a>
          untuk terus menggunakan Omnilinkz
        </div>
      @endif-->

        <div class="alert alert-danger">
          <button type="button" class="close" aria-label="Close" data-dismiss="alert">
            <span aria-hidden="true">×</span>
          </button>
          {{ session('error') }} <a href="{{asset('/pricing')}}">Klik disini untuk upgrade</a>
        </div>
    </div>
    @endif

    <div class="col-md-12 pr-0 div-btn">
      <div class="row">
        <?php  
          $colbio = 'col-6';
          if(Auth::user()->membership=='free'){
            $colbio = 'col-12';
          }
        ?>
        <div class="col-lg-2 col-md-3 {{$colbio}} pl-md-3 pl-0 pr-0">
          <button class="btnbio btncreate btn-block btncreate-bio">
            + BIO LINK  
          </button>
        </div>

        @if(Auth::user()->membership!='free')
          <div class="col-lg-2 col-md-3 col-6 pr-md-3 pl-0 pr-0">
            <a href="{{asset('/singlelink')}}" style="text-decoration: none;">
              <button class="btnsingle btncreate btn-block">
                + SINGLE LINK  
              </button>
            </a>
          </div> 
        @endif 
        <div class="ml-lg-auto ml-md-auto mr-3 ml-3 col-lg-4 col-md-5 col-12 pl-md-3 pl-0 pr-0 mb-3 menu-nomobile">
          <p class="text-md-right text-lg-right ">
            @if($user->membership=="free")
              <span class="txt-free header-status-account">
                <i class="fas fa-flag"></i>
                Free Account
              </span>
              <br>
              <span class="content-status-account">
              <i>~ Forever free.</i> <a href="{{url('pricing')}}">Upgrade</a>
              </span>
            @endif
            @if($user->membership=="basic")
              <span class="text-success header-status-account">
                <i class="fas fa-trophy"></i>
                Basic Account
              </span>
              <br>
              <span class="content-status-account">
              <i>~ Valid until <?php echo Carbon::parse($user->valid_until)->format('d M Y');?>.</i> <a href="{{url('pricing')}}">Extend</a>
              </span>
            @endif
            @if($user->membership=="elite")
              <span class="txt-elite header-status-account">
                <i class="fas fa-star"></i>
                Elite Account
              </span>
              <br>
              <span class="content-status-account">
              <i>~ Valid until <?php echo Carbon::parse($user->valid_until)->format('d M Y');?>.</i> <a href="{{url('pricing')}}">Extend</a>
              </span>
            @endif
          </p>
        </div>
      </div>
    </div>

    <div class="col-md-12 pr-0 menu-mobile">
      <p class="text-md-right text-lg-right ">
            @if($user->membership=="free")
              <span class="txt-free header-status-account">
                <i class="fas fa-flag"></i>
                Free Account
              </span>
              <br>
              <span class="content-status-account">
              <i>~ Forever free.</i> <a href="{{url('pricing')}}">Upgrade</a>
              </span>
            @endif
            @if($user->membership=="basic")
              <span class="text-success header-status-account">
                <i class="fas fa-trophy"></i>
                Basic Account
              </span>
              <br>
              <span class="content-status-account">
              <i>~ Valid until <?php echo Carbon::parse($user->valid_until)->format('d M Y');?>.</i> <a href="{{url('pricing')}}">Extend</a>
              </span>
            @endif
            @if($user->membership=="elite")
              <span class="txt-elite header-status-account">
                <i class="fas fa-star"></i>
                Elite Account
              </span>
              <br>
              <span class="content-status-account">
              <i>~ Valid until <?php echo Carbon::parse($user->valid_until)->format('d M Y');?>.</i> <a href="{{url('pricing')}}">Extend</a>
              </span>
            @endif
          </p>
    </div>

    <hr>

    <div class="col-md-12">
      <div class="pt-md-1 pt-0" style="font-size: 25px; padding-bottom: 5px">
        <div class="text-md-left text-center">
          <p>Omnilinkz Chart</p>  
        </div>
        

        <div class="row mb-4 mt-2">
          <div class="col-md-6">
            <div class="input-group">
              <input type="text" id="keywords" name="search" class="form-cari form-control col-md-5" placeholder="Cari Link / Judul / Kategori" aria-label="Cari Link / Judul" aria-describedby="basic-addon2">

              <div class="btn-search input-group-append" style="cursor:pointer;">
                <span class="input-group-text" id="basic-addon2">
                  <i class="fas fa-search"></i>
                </span>
              </div>
            </div>  
          </div>
          
          <div class="col-md-6 text-md-right text-left mt-md-0 mt-3">
            <span style="font-size: 20px">Periode :</span><br class="menu-mobile">
            <select id="bulan" name="bulan" class="custom-select form-controll">
              <?php 
                $bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

                for($a=1;$a<=12;$a++) {
                  if($a==date("m")) { 
                    $pilih="selected";
                  } else {
                    $pilih="";
                  }
                  echo("<option value=\"".sprintf('%02d', $a)."\" $pilih>$bulan[$a]</option>"."\n");
                }
              ?>
            </select>

            <select id="tahun" name="tahun" class="custom-select form-controll">
              <?php
                $thn_skr = date('Y');
                for ($x = $thn_skr; $x >= 1980; $x--) {
              ?>
                  <option value="<?php echo $x ?>">
                    <?php echo $x ?>    
                  </option>
              <?php
                }
              ?>
            </select> 
          </div>
            
        </div>
        

        <div style="clear: both;"></div>

      </div>

      <hr style="margin-bottom: 45px">

    <div class="row show-chart">
      <div class="col-md-8 order-md-1 order-2">
        <div id="chartContainer" style="height:300px; width:100%; margin-bottom:40px"></div>    
      </div>
      <div class="col-md-4 div-click order-md-2 order-1 text-md-center mb-5">
        <span class="span-click">
          Total Click <br class="menu-nomobile">
          <span id="total-click" class="float-md-none float-right"></span> <br> 
          dalam 30 hari
        </span>
      </div>
    </div>

    <div class="pager menu-mobile"></div>

    <div class="" id="content"></div>

    <div class="pager"></div>

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
        <input type="hidden" name="id_delete" id="id_delete">
        Apa Anda yakin untuk <i>menghapus</i> link berikut beserta detail didalamnya?
        <br><br>
        
                <img id="img-pic" src="" class="picture-sm">
                <div id="img-default" class="picture-sm" style="margin: 0 auto;display: none;"></div>
        <br><br>
        
        Page Title : <span class="txt-title"></span> <br>
        <span id="txt-link"></span><br>
        Created on : <span id="txt-created"></span>

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
        Page Title : <span class="txt-title"></span>, berhasil <b>dihapus!</b><br>
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

<div class="modal fade" id="confirm-create" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modaltitle">
         Create BioLink  Confirmation
        </h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        Are you sure you want to Create a Bio?
      </div>
      <div class="modal-footer" id="foot">
        <button href="{{asset('/biolinks')}}" class="btn btn-primary btn-create-ok" data-dismiss="modal">
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
  $('#keywords').on('keypress touchend', function (e) {
    if (e.which == 13) {
      refreshDashboard();
      return false;    //<---- Add this line
    }
  });

  $('body').on('click','.btn-search',function(e){
    refreshDashboard();
  });

  $(document).on('click', '.pagination a', function (e) {
    e.preventDefault();
    currentPage = $(this).attr('href');
    refreshDashboard();
  });

  $('body').on('change','#bulan',function(e) 
  {
    refreshDashboard();
    load_chart();
  });

  $('body').on('change','#tahun',function(e) 
  {
    refreshDashboard();
    load_chart();
  });

  $('body').on('click','.btn-deletePage',function(e) 
  {
    e.preventDefault();
    e.stopPropagation();
    var deleteid = $(this).attr('deletedataid');
    $('#id_delete').val(deleteid);
    $('.txt-title').html($(this).attr('data-title'));
    $('#txt-link').html($(this).attr('data-link'));
    $('#txt-created').html($(this).attr('data-created'));
    var imgsrc = $('.img-'+deleteid).attr('src');
    if(imgsrc){
      $('#img-default').hide();
      $('#img-pic').show();
      $('#img-pic').attr('src',imgsrc);
    } else {
      $('#img-default').show();
      $('#img-pic').hide();
    }
    

    $('#confirm-delete').modal('show');
  });

  $('body').on('click','.btncreate-bio',function(e){
    e.preventDefault();
    $('#confirm-create').modal('show');
  });
  $('body').on('click','.btn-create-ok',function(e){

    let urla="<?php echo e(asset('/biolinks'))?>";
    window.location.href=urla;
  });
  $('body').on('click','.btn-delete-ok',function(e) 
  {
    var iddeletepages = $('#id_delete').val();
    deletePages(iddeletepages);
  });

  $('body').on('click','.btn-editPage',function(e){
    e.preventDefault();
    e.stopPropagation();
    var uid = $(this).attr('data-id');
    window.location.href="{{url('/biolinks/')}}"+'/'+uid;
  });

  $('body').on('click','.btn-viewall',function(e){
    e.preventDefault();
    e.stopPropagation();
    var uid = $(this).attr('data-id');
    window.location.href="{{url('/dash-detail/')}}"+'/'+uid;
  });

  $('body').on('click','.btn-pdf',function(e){
    e.preventDefault();
    e.stopPropagation();
    var url = $(this).attr('data-url');
    window.open(url);
  });

  $('body').on('click','.single-report',function(e){
    e.preventDefault();
    e.stopPropagation();
    var url = $(this).attr('data-url');
    window.location.href = url;
    //window.open(url);
  });

  $('body').on('click','.link-header',function(e) {
    //e.stopPropagation();
    var id = $('#linkHeader').attr('dataid');
    if ($(this).parent().find('.content-link').hasClass('hidden')) {
      $(this).parent().find('.content-link').show(id);
      $(this).parent().find('.content-link').removeClass('hidden');
      return false;
    } else {
      $(this).parent().find('.content-link').hide(id);
      $(this).parent().find('.content-link').addClass('hidden');
      return false;
    }
  });

  $( "body" ).on( "click", ".btn-copylink", function(e) 
  {
    e.preventDefault();
    e.stopPropagation();

    var id = $(this).attr("data-id");
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
</script>
@endsection