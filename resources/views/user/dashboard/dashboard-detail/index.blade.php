@extends('layouts.app')

@section('content')
<?php use App\Pixel; ?>
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
              dataPoints: <?php echo json_encode($data['chart'], JSON_NUMERIC_CHECK); ?>,
            }]
          });

        chart.render();
        $(".canvasjs-chart-credit").hide();
        function toggleDataSeries(e){
          if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
          }
          else{
            e.dataSeries.visible = true;
          }
          chart.render();
          $(".canvasjs-chart-credit").hide();
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
          $(".canvasjs-chart-credit").hide();
          function toggleDataSeries(e){
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
              e.dataSeries.visible = false;
            }
            else{
              e.dataSeries.visible = true;
            }
            chart.render();
            $(".canvasjs-chart-credit").hide();
          }

          $('#total-click').html(data.total_click);
          $('#content').html(data.view);

          <?php if(Auth::user()->membership=='free') { ?>
            $('.show-chart').hide();
          <?php } ?>
      }
    });
  }

  function deleteLink() {
    $.ajax({
      type: 'GET',
      url: "<?php echo url('/dash/delete-link'); ?>",
      dataType: 'text',
      data: {
        id: "{{$data['id']}}",
        mode: "{{$data['mode']}}",
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
          var src = "{{asset('image/success.gif')}}"+"?a="+Math.random();;
          $('#img-success').attr('src',src);
          $('#delete-success').modal('show');
          setTimeout(function(){
            var url="<?php echo url('/')?>";
            window.location.href=url;
          }, 3000);
        }
      }
    });
  }

  function editLink() {
    var title = $('#title').val();
    var link = $('#link').val();
    var pixel = $('#pixel').val();

    $.ajax({
      type: 'GET',
      url: "<?php echo url('/dash/edit-link'); ?>",
      dataType: 'text',
      data: {
        id: "{{$data['id']}}",
        mode: "{{$data['mode']}}",
        title: title,
        link: link,
        pixel: pixel,
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

        $("#pesanAlert").html(data.message);
        $("#pesanAlert").show();

        if (data.status == 'success') {
          $("#pesanAlert").addClass("alert-success");
          $("#pesanAlert").removeClass("alert-danger");

          $('#link-title').html(title);
          $('#link-link').html(link);
          $('#link-linkhref').attr('href',link);
          $('.btn-copylink').attr('data-link',link);

          if(data.pixel==null){
            $('#link-pixel').html('');
          } else if(data.pixel.jenis_pixel=='fb'){
            $('#link-pixel').html('<i class="fab fa-facebook-f">&nbsp;</i>');
          } else if(data.pixel.jenis_pixel=='twitter'){
            $('#link-pixel').html('<i class="fab fa-twitter">&nbsp;</i>');
          } else if(data.pixel.jenis_pixel=='google'){
            $('#link-pixel').html('<i class="fab fa-google">&nbsp;</i>');
          } 
          
        } else {
          $("#pesanAlert").addClass("alert-danger");
          $("#pesanAlert").removeClass("alert-success");
        }
      }
    });
  }
</script>

<div class="container main-cont">
  <div class="row notif">
    @if (session('error'))
    <div class="col-md-12 mb-3">
      <div class="alert alert-danger">
        <button type="button" class="close" aria-label="Close" data-dismiss="alert">
          <span aria-hidden="true">×</span>
        </button>
        {{ session('error') }} <a href="{{asset('/pricing')}}">Subscribe</a>
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

        <div class="ml-lg-auto ml-md-auto mr-3 ml-3 col-lg-4 col-md-5 col-12 pl-md-3 pl-0 pr-0 mb-3 mt-3 menu-nomobile">
          <p class="text-md-right text-lg-right ">
            @if(Auth::user()->membership=="free")
              <span class="txt-free header-status-account">
                <i class="fas fa-flag"></i>
                Free Account
              </span>
              <br>
              <span class="content-status-account">
              <i>~ Forever free.</i> <a href="{{url('pricing')}}">Upgrade</a>
              </span>
            @endif
            @if(Auth::user()->membership=="pro")
              <span class="text-success header-status-account">
                <i class="fas fa-trophy"></i>
                Pro Account
              </span>
              <br>
              <span class="content-status-account">
              <i>~ Valid until <?php echo Carbon::parse(Auth::user()->valid_until)->format('d M Y');?>.</i> <a href="{{url('pricing')}}">Extend</a>
              </span>
            @endif
            @if(Auth::user()->membership=="elite")
              <span class="txt-elite header-status-account">
                <i class="fas fa-star"></i>
                Elite Account
              </span>
              <br>
              <span class="content-status-account">
              <i>~ Valid until <?php echo Carbon::parse(Auth::user()->valid_until)->format('d M Y');?>.</i> <a href="{{url('pricing')}}">Extend</a>
              </span>
            @endif
          </p>
        </div> 
      </div>
    </div>

    <div class="col-md-12 pr-0 menu-mobile status-account-info" style="margin-top: 0px;">
      <p class="text-md-right text-lg-right ">
            @if(Auth::user()->membership=="free")
              <span class="txt-free header-status-account">
                <i class="fas fa-flag"></i>
                Free Account
              </span>
              <br>
              <span class="content-status-account">
              <i>~ Forever free.</i> <a href="{{url('pricing')}}">Upgrade</a>
              </span>
            @endif
            @if(Auth::user()->membership=="pro")
              <span class="text-success header-status-account">
                <i class="fas fa-trophy"></i>
                Pro Account
              </span>
              <br>
              <span class="content-status-account">
              <i>~ Valid until <?php echo Carbon::parse(Auth::user()->valid_until)->format('d M Y');?>.</i> <a href="{{url('pricing')}}">Extend</a>
              </span>
            @endif
            @if(Auth::user()->membership=="elite")
              <span class="txt-elite header-status-account">
                <i class="fas fa-star"></i>
                Elite Account
              </span>
              <br>
              <span class="content-status-account">
              <i>~ Valid until <?php echo Carbon::parse(Auth::user()->valid_until)->format('d M Y');?>.</i> <a href="{{url('pricing')}}">Extend</a>
              </span>
            @endif
          </p>
    </div>

    <div class="col-md-12">
      <div class="pt-md-1 pt-0" style="padding-bottom: 5px">
        <div class="row">
          <div class="col-12 col-md-6">
            <h4 style="color: #106BC8">
              <a href="{{url('/')}}">
                <button class="btn btn-default btn-back">
                  <i class="fas fa-arrow-circle-left"></i>
                  Back
                </button>
              </a>
            </h4>    
          </div>

          <div class="col-12 col-md-6 text-md-right">
            Last update : {{date('F d, Y',strtotime($data['updated_at']))}}
          </div>
        </div>
      
        <div class="row mb-4 mt-2">
          <div class="col-md-6 mb-2">
            <!--<div class="input-group">
              <?php  
                $category = $data['title'];
                if($mode=='link' or $mode=='banner'){
                  $category = $mode;
                } 
              ?>
              <h4>Kategori : {{ ucfirst($category) }}</h4>
            </div>-->

            <?php if (is_null($data['pagetitle'])) echo "<h2 class='title-dashboard-detail' style='opacity:0.5;'>Untitled</h2>"; echo "<h2 class='title-dashboard-detail'>".$data['pagetitle']."</h2>"; ?>
            <h2>
              <span id="link-title" class="title-dashboard-detail">
                {{$data['title']}}
              </span>  
            </h2>
            
            <a href="{{$data['link']}}" target="_blank" id="link-linkhref">
              <span id="link-link" style="color:#3490dc">
                {{$data['link']}}
              </span>
            </a> &nbsp;
            <span class="btn-copylink" data-link="{{$data['link']}}" style="cursor: pointer;">
              <i class="far fa-clone"></i>  
            </span>
            <br>   
          </div>
          
          <div class="col-md-6 text-md-right text-left">
            <button class="btn btn-success btn-edit" data-toggle="modal" data-target="#edit-link">
              <i class="fas fa-pencil-alt"></i>
              Edit
            </button>
            <button class="btn btn-danger btn-delete">
              <i class="fas fa-trash-alt"></i>
              Delete
            </button>
          </div>

        </div>
        

        <div style="clear: both;"></div>

        <div id="pesanAlert" class="alert" style="display: none;"></div>

      </div>

      <hr style="margin-bottom: 45px" class="show-chart">

      <?php 
        $pixel = Pixel::find($data['pixel_id']);
      ?>
      <div class="row" style="margin-bottom: 45px">
        <div class="col-md-6 mb-2"> 
          Created on : {{date('F d, Y',strtotime($data['created_at']))}} <br>
          Pixels : 
            <span id="link-pixel">
              @if(!is_null($pixel))
                @if($pixel->jenis_pixel=='fb')
                  <i class="fab fa-facebook-f">&nbsp;</i>
                @endif

                @if($pixel->jenis_pixel=='twitter')
                  <i class='fab fa-twitter'>&nbsp;</i>
                @endif

                @if($pixel->jenis_pixel=='google')
                  <i class="fab fa-google">&nbsp;</i>
                @endif
              @endif
            </span>
        </div>
        
        <div class="col-md-6 text-md-right text-left"> 
          <!--<a id="link-savepdf" href="{{url('pdf/'.$pageid.'/'.$id.'/'.$mode.'/'.$bulann.'/'.$tahun)}}" target="_blank">
            <button class="btn btn-primary">
              <i class="far fa-file-pdf"></i>
              Save As PDF
            </button>
          </a>-->
          <p style="display: inline;">Periode : </p>

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
        Apa Anda yakin untuk <i>menghapus</i> link berikut ?
        <br><br>
        <span class="txt-title">{{$data['title']}}</span> 
        <br>
        
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
        Link Title : <span class="txt-title">{{$data['title']}}</span>, berhasil <b>dihapus!</b><br>
        Anda akan diarahkan ke <i>halaman sebelumnya</i> dalam 3 detik

        <div class="col-12 text-center mb-4" style="margin-top: 30px">
          <a href="{{url('/')}}">
            Ke Halaman Sebelumnya
          </a>  
        </div>
      </div>

    </div>   
  </div>
</div>

<!-- Modal Add User -->
<div class="modal fade" id="edit-link" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modaltitle">
          Edit Link
        </h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="formEdit">
          @csrf

          @if($data['mode']=='link' or $data['mode']=='banner')
            <div class="form-group row">
              <label class="col-md-3 col-12">
                <b>Title</b> 
              </label>
              <div class="col-md-9 col-12">
                <input type="text" class="form-control" name="title" id="title" value="{{$data['title']}}">
              </div>
            </div>
          @endif

          <div class="form-group row">
            <label class="col-md-3 col-12">
              <b>Link</b> 
            </label>
            <div class="col-md-9 col-12">
              <input type="text" class="form-control" name="link" id="link" value="{{$data['link']}}">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-12">
              <b>Pixel</b> 
            </label>
            <div class="col-md-9 col-12">
              <select class="form-control" name="pixel" id="pixel">
                <option <?php if($data['pixel_id']==0 or is_null($data['pixel_id'])) echo 'selected' ?> value="0">
                  -- Pilih Pixel Retargetting --
                </option>
                @foreach($pixels as $pixel)
                  <option <?php if($pixel->id==$data['pixel_id']) echo 'selected' ?> value="{{$pixel->id}}">
                    {{$pixel->title}}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer" id="foot">
        <button class="btn btn-primary" id="btn-edit-ok" data-dismiss="modal">
          Edit
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

<script type="text/javascript">
  $('body').on('click','.btn-delete',function(e) 
  {
    $('#confirm-delete').modal('show');
  });

  $('body').on('click','.btn-delete-ok',function(e) 
  {
    deleteLink();
  });

  $('body').on('click','#btn-edit-ok',function(e) 
  {
    editLink();
  });

  $( "body" ).on( "click", ".btn-copylink", function(e) 
  {
    e.preventDefault();
    e.stopPropagation();

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