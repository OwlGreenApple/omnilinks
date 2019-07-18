@extends('layouts.app')

@section('content')
<?php use App\Pixel; ?>
<link rel="stylesheet" href="{{asset('css/dash.css')}}">
<link rel="stylesheet" href="{{asset('css/sb-admin.css')}}">


<script type="text/javascript">
  $(document).ready(function() {
    refresh_page();
  });

  function refresh_page(){
    
    $.ajax({                                      
      url: "<?php echo url('/dash-detail/load-content-all'); ?>",
      type: 'get',
      data : {
        bulan : $('#bulan').val(),
        tahun : $('#tahun').val(),
        pageid : "{{$pageid}}",
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

  function deletePages() {
    $.ajax({
      type: 'GET',
      url: "<?php echo url('/dash/delete-pages'); ?>",
      dataType: 'text',
      data: {
        deletedataid: "{{$page->id}}",
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

  function deleteLink() {
    $.ajax({
      type: 'GET',
      url: "<?php echo url('/dash/delete-link'); ?>",
      dataType: 'text',
      data: {
        id: $('#id_delete').val(),
        mode: $('#mode').val(),
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
          refresh_page();
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
</script>

<div class="container main-cont">
  <div class="row notif">
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
            @if(Auth::user()->membership=="basic")
              <span class="text-success header-status-account">
                <i class="fas fa-trophy"></i>
                Basic Account
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

    <div class="col-md-12 pr-0 menu-mobile status-account-info" style="margin-top: 0px">
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
            @if(Auth::user()->membership=="basic")
              <span class="text-success header-status-account">
                <i class="fas fa-trophy"></i>
                Basic Account
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
      <div class="pt-md-5 pt-0" style="padding-bottom: 5px">
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
            Last update : {{date('F d, Y',strtotime($page->updated_at))}}
          </div>
        </div>
      
        <div class="row mb-4 mt-5">
          <div class="col-md-6 mb-2">
        
            <h2>{{$page->page_title}}</h2>
            
            <?php 
                $names = '';
                if($page->premium_id!=0){
                  $names = env('SHORT_LINK').'/'.$page->premium_names;
                } else {
                  $names = env('SHORT_LINK').'/'.$page->names;
                }
            ?>

            <a href="{{'https://'.$names}}" target="_blank" id="link-linkhref">
              <span id="link-link" style="color:#3490dc">
                {{$names}}
              </span>
            </a> &nbsp;
            <span class="btn-copylink" data-link="{{'https://'.$names}}" style="cursor: pointer;">
              <i class="far fa-clone"></i>  
            </span>
            <br>   
          </div>
          
          <div class="col-md-6 text-md-right text-left">
            <a href="{{url('biolinks').'/'.$page->uid}}">
              <button class="btn btn-success btn-edit">
                <i class="fas fa-pencil-alt"></i>
                Edit
              </button>  
            </a>
            
            <button class="btn btn-danger btn-delete">
              <i class="fas fa-trash-alt"></i>
              Delete
            </button>
          </div>

        </div>
        

        <div style="clear: both;"></div>

        <div id="pesanAlert" class="alert" style="display: none;"></div>

      </div>

      <hr style="margin-bottom: 45px">

      
      <div class="row" style="margin-bottom: 45px">
        <?php  
          $pixels = Pixel::where('users_id',Auth::user()->id)
                ->select('jenis_pixel')
                //->where('pages_id',$page->id)
                ->groupBy('jenis_pixel')
                ->get();
        ?>
        <div class="col-md-6 mb-2"> 
          Created on : {{date('F d, Y',strtotime($page->created_at))}} <br>
          Pixels : 
            @if($pixels->count())
              @foreach($pixels as $pixel)
                @if($pixel->jenis_pixel=='fb')
                  <i class="fab fa-facebook-f">&nbsp;</i>
                @endif

                @if($pixel->jenis_pixel=='twitter')
                  <i class='fab fa-twitter'>&nbsp;</i>
                @endif

                @if($pixel->jenis_pixel=='google')
                  <i class="fab fa-google">&nbsp;</i>
                @endif
              @endforeach
            @endif
        </div>
        
        <div class="col-md-6 text-md-right text-left"> 
         
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

      <div id="content"></div>

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
        <input type="hidden" name="mode" id="mode">
        <input type="hidden" name="type" id="type">

        Apa Anda yakin untuk <i>menghapus</i> <span class="txt-mode"></span> berikut ?
        <br><br>
        <span class="txt-title">{{$page->page_title}}</span> 
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
        <span class="txt-delete-success"></span>
    
        <div class="col-12 text-center mb-4" style="margin-top: 30px">
          <a id="link-modal" href="{{url('/')}}">
            Ke Halaman Sebelumnya
          </a>  
        </div>
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
    $('#type').val('page');
    $('.txt-title').html('{{$page->page_title}}');
    $('.txt-mode').html('page');
    $('#link-modal').html('Ke Halaman Sebelumnya');
    $('#link-modal').removeAttr("data-dismiss");  
    $('#link-modal').attr("href","<?php echo url('/') ?>");  

    var txt = 'Page Title : {{$page->page_title}}, berhasil <b>dihapus!</b><br>Anda akan diarahkan ke <i>halaman sebelumnya</i> dalam 3 detik';
    $('.txt-delete-success').html(txt);

    $('#confirm-delete').modal('show');
  });

  $('body').on('click','.btn-delete-link',function(e) 
  {
    $('#id_delete').val($(this).attr('data-id'));
    $('#mode').val($(this).attr('data-mode'));
    $('#type').val('link');

    $('.txt-title').html($(this).attr('data-title'));
    $('.txt-mode').html('link');
    $('#link-modal').html('Kembali ke Dashboard');
    $('#link-modal').attr("data-dismiss","modal");  
    $('#link-modal').attr("href","#");  

    var txt = 'Link Title : '+$(this).attr('data-title')+', berhasil <b>dihapus!</b><br>Anda akan diarahkan ke <i>Dashboard</i> dalam 3 detik';
    $('.txt-delete-success').html(txt);

    $('#confirm-delete').modal('show');
  });

  $('body').on('click','.btn-delete-ok',function(e) 
  {
    if($('#type').val()=='page'){
      deletePages();
    } else {
      deleteLink();
    }
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