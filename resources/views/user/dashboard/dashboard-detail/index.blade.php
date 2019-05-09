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
      success: function(data) {
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

    <div class="col-md-12">
      <button class="btnbio btncreate btncreate-bio">
        BIO LINK  
      </button>

      <a href="{{asset('/dash/newsingle')}}" style="text-decoration: none;">
        <button class="btnsingle btncreate">
          SINGLE LINK  
        </button>
      </a>

      <div style="padding-top: 49px; padding-bottom: 5px">
        <h4 style="color: #106BC8">
          <i class="fas fa-arrow-left"></i>&nbsp;
          <a href="{{url('dash')}}">
            KEMBALI
          </a>
        </h4>
        <br>  

        <h2>Omnilinkz Chart</h2>

        <div class="row mb-4 mt-5">
          <div class="col-md-6">
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
        <div class="col-md-9"> 
          <h2>{{$data['title']}}</h2>
          URL : {{$data['link']}}<br> 
          <br>  
          Created on : {{date('d F Y',strtotime($data['created_at']))}}
        </div>
        
        <div class="col-md-3" align="right"> 
          <a href="{{url('pdf/'.$pageid.'/'.$id.'/'.$mode.'/'.$bulann.'/'.$tahun)}}" target="_blank" style="float: right;">
            <button class="btn btn-primary">
              <i class="far fa-file-pdf"></i>
              Save As PDF
            </button>
          </a>
        </div>
      </div>

      <div class="row" style="margin-bottom: 45px">
        <div class="col-md-8">
          <div id="chartContainer" style="height:300px; width:100%;"></div>    
        </div>
        <div class="col-md-4 div-click" align="center">
          <span class="span-click">
            Total Click <br>
            <span id="total-click"></span> <br> 
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
      <button href="{{asset('/dash/new')}}" class="btn btn-primary btn-create-ok" data-dismiss="modal">
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
  });

  $('body').on('change','#tahun',function(e) 
  {
    refresh_page();
  });

  $('body').on('click','.btncreate-bio',function(e){
    e.preventDefault();
    $('#confirm-create').modal('show');
  });
  $('body').on('click','.btn-create-ok',function(e){

    let urla="<?php echo e(asset('/dash/new'))?>";
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