@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/dash.css')}}">
<link rel="stylesheet" href="{{asset('css/sb-admin.css')}}">


<script type="text/javascript">
  $(document).ready(function() {
    refresh_page();
      /*var chart = new CanvasJS.Chart("chartContainer", {
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
              dataPoints: <?php /*echo json_encode($data['chart'], JSON_NUMERIC_CHECK)*/; ?>,
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
        }*/
  });

  function refresh_page(){
    
    $.ajax({                                      
      url: "<?php echo url('/dash-detail/load-content'); ?>",
      type: 'get',
      data : {
        bulan : $('#bulan').val(),
        tahun : $('#tahun').val(),
        pageid : "{{$pageid}}",
        id: "{{$id}}",
        mode: "{{$mode}}",
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
          $('#content').html(data.view);

          <?php if(Auth::user()->membership=='free') { ?>
            $('.show-chart').hide();
          <?php } ?>
      }
    });
  }
</script>

<div class="container">
  <div class="row notif">
    <div class="col-md-12 mb-3">
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="close" aria-label="Close" data-dismiss="alert">
          <span aria-hidden="true">×</span>
        </button>
        Masa trial anda akan berakhir dalam 5 hari. <span style="color:blue;">Subscribe</span>
        untuk terus menggunakan Omnilinks
      </div>
      @if (session('error'))
      <div class="alert alert-danger">
        <button type="button" class="close" aria-label="Close" data-dismiss="alert">
          <span aria-hidden="true">×</span>
        </button>
        {{ session('error') }} <a href="{{asset('/pricing')}}">Subscribe</a>
      </div>
      @endif
    </div>

    <div class="col-md-12 pr-0 div-btn">
      <div class="row">
        <div class="col-lg-2 col-md-3 col-6 pl-md-3 pl-0 pr-0">
          <button class="btnbio btn-block btncreate btncreate-bio">
            BIO LINK  
          </button>
        </div>
        <div class="col-lg-2 col-md-3 col-6 pr-md-3 pl-0 pr-0">
          <a href="{{asset('/singlelink')}}" style="text-decoration: none;">
            <button class="btnsingle btn-block btncreate">
              SINGLE LINK  
            </button>
          </a>
        </div>  
      </div>
    </div>

    <div class="col-md-12">
      <div class="pt-md-5 pt-0" style="padding-bottom: 5px">
        <h4 style="color: #106BC8">
          <i class="fas fa-arrow-left"></i>&nbsp;
          <a href="{{url('/')}}">
            KEMBALI
          </a>
        </h4>
        <br>  

        <div class="text-md-left text-center">
          <h2>Omnilinkz Detailed Chart</h2>
        </div>

        <div class="row mb-4 mt-5">
          <div class="col-md-6 mb-2">
            <div class="input-group">
              <?php  
                $category = $data['title'];
                if($mode=='link' or $mode=='banner'){
                  $category = $mode;
                } 
              ?>
              <h4>Kategori : {{ ucfirst($category) }}</h4>
            </div>  
          </div>
          
          <div class="col-md-6 text-md-right text-left">
            <h4 style="display: inline;">Periode : </h4>

            <select id="bulan" name="bulan" class="custom-select form-controll">
              <?php 
              $bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

              for($a=1;$a<=12;$a++) {
                if($a==$bulann) { 
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
                <option value="<?php echo $x ?>" <?php if($x==$tahun) echo 'selected' ?>>
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

      <div class="row" style="margin-bottom: 45px">
        <div class="col-md-9 mb-2"> 
          <h2>{{$data['title']}}</h2>
          URL : {{$data['link']}}<br> 
          <br>  
          Created on : {{date('d F Y',strtotime($data['created_at']))}}
        </div>
        
        <div class="col-md-3 text-md-right text-left"> 
          <a id="link-savepdf" href="{{url('pdf/'.$pageid.'/'.$id.'/'.$mode.'/'.$bulann.'/'.$tahun)}}" target="_blank">
            <button class="btn btn-primary">
              <i class="far fa-file-pdf"></i>
              Save As PDF
            </button>
          </a>
        </div>
      </div>

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

      <div>
        <table class="table mb-5"> 
          <thead>
            <th>Days</th>
            <th>Total Clicks</th>
          </thead>
          <tbody id="content"></tbody>
        </table>
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
  $('body').on('change','#bulan',function(e) 
  {
    refresh_page();
    var link = "{{url('pdf/'.$pageid.'/'.$id.'/'.$mode)}}";
    link = link + '/' + $(this).val() + '/' + $('#tahun').val();
    $('#link-savepdf').attr('href',link);
  });

  $('body').on('change','#tahun',function(e) 
  {
    refresh_page();
    var link = "{{url('pdf/'.$pageid.'/'.$id.'/'.$mode)}}";
    link = link + '/' +$('#bulan').val() + '/' + $(this).val();
    $('#link-savepdf').attr('href',link);
  });

  $('body').on('click','.btncreate-bio',function(e){
    e.preventDefault();
    $('#confirm-create').modal('show');
  });
  $('body').on('click','.btn-create-ok',function(e){

    let urla="<?php echo e(asset('/biolinks'))?>";
    window.location.href=urla;
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
    window.open(url);
  });
</script>
@endsection