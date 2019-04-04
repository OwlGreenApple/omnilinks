@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/dash.css')}}">
<link rel="stylesheet" href="{{asset('css/sb-admin.css')}}">

 
<script type="text/javascript">
  // var currentPage="";
  function refreshDashboard() {
    // if(currentPage=="")
    // {
    //   currentPage=;
    // }

    $.ajax({
      type: 'GET',
      url: "<?php echo url('/dash/load-dashboard'); ?>",
      dataType: 'text',
      success: function(result) {
        var data = jQuery.parseJSON(result);
        $('#content').html(data.view);
        //$('#pager').html(data.pager);
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
      success: function(result) {
        var data = jQuery.parseJSON(result);
        if (data.status == 'success') {
          refreshDashboard();
        }
      }
    });
  }

  $(document).ready(function() {
    refreshDashboard();
  });

</script>

<style type="text/css">
  
.invalid-feedback {
  display: none;
  width: 100%;
  margin-top: 0.25rem;
  font-size: 80%;
}
.fa-search {
  width: 15px;
  margin: -25px 10px;
  float: right;
}  
</style>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>


<div class="container">
  <div class="row notif">
    <div class="col-md-12 mb-3">
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="close" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        Masa trial anda akan berakhir dalam 5 hari. <span style="color:blue;">Subscribe</span>
        untuk terus menggunakan Omnilinks
      </div>
    </div>

    <div class="col-md-12">
      <a href="{{asset('/dash/new')}}" style="text-decoration: none;">
        <button class="btnbio btncreate">
          BIO LINK  
        </button>
      </a>

      <a href="{{asset('/dash/newsingle')}}" style="text-decoration: none;">
        <button class="btnsingle btncreate">
          SINGLE LINK  
        </button>
      </a>

      <div style="padding-top: 49px; font-size: 25px;">
        <p>Omnilinkz Chart</p>

        <div class="row mb-4 mt-5">
          <div class="col-md-6">
            <div class="input-group">
              <input type="text" name="search" class="form-cari form-control col-md-5" placeholder="Cari Link / Judul" aria-label="Cari Link / Judul" aria-describedby="basic-addon2">

              <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">
                  <i class="fas fa-search"></i>
                </span>
              </div>
            </div>  
          </div>
          
          <div class="col-md-6 text-md-right text-left">
            <select name="bulan" class="custom-select form-controll">
              <?php 
                $bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

                for($a=1;$a<=12;$a++) {
                  if($a==date("m")) { 
                    $pilih="selected";
                  } else {
                    $pilih="";
                  }
                  echo("<option value=\"$a\" $pilih>$bulan[$a]</option>"."\n");
                }
              ?>
            </select>

            <select name="tahun" class="custom-select form-controll">
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

      <hr>

    <div class="row">
          <div class="col-md-6">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-chart-area"></i>
                Area Chart Example</div>
              <div class="card-body">
                <div id="chart"></div>
              </div>
              <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
          </div>
    </div>

      <div id="content"></div>
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
        <button class="btn" data-dismiss="modal">
          Cancel
        </button>
      </div>
    </div>
      
  </div>
</div>

<!-- Modal Delete Confirmation -->
<div class="modal fade" id="confirm-delete" role="dialog">
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
        <input type="hidden" name="id_delete" id="id_delete">
      </div>
      <div class="modal-footer" id="foot">
        <button class="btn btn-primary btn-delete-ok" data-dismiss="modal">
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
  
$.getJSON(
    'https://cdn.jsdelivr.net/gh/highcharts/highcharts@v7.0.0/samples/data/usdeur.json',
    function (data) {

        Highcharts.chart('chart', {
            chart: {
                zoomType: 'x'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                        'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: 'Exchange rate'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                type: 'area',
                name: 'USD to EUR',
                data: data
            }]
        });
    }
);
</script>
<script type="text/javascript">
  $('body').on('click','.btn-deletePage',function(e) 
  {
    e.preventDefault();
    e.stopPropagation();
    $('#id_delete').val($(this).attr('deletedataid'));
    $('#confirm-delete').modal('show');
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
    window.location.href="{{url('/dash/new/')}}"+'/'+uid;
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