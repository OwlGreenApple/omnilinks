@extends('layouts.app')

@section('content')
<?php use App\Helpers\Helper; ?>
<link rel="stylesheet" href="{{asset('css/dash.css')}}">
<link rel="stylesheet" href="{{asset('css/farbtastic.css')}}">
<link rel="stylesheet" href="{{asset('css/theme.css')}}">

<style type="text/css">
  @media screen and (max-width: 768px) {
    .menu-nomobile{
      display: none;
    }

    .menu-mobile {
      display: block;
    }
  }
</style>

<script type="text/javascript">
  var currentPage = '';
  var status = 'not-sort';
  var act = '';

  function refreshHistory() {
    if(currentPage=="") {
      currentPage = "<?php echo url('load-credit-history'); ?>";
    }

    $.ajax({
      type: 'GET',
      data: {
        bulan: $('#bulan').val(),
        tahun: $('#tahun').val(),
        status: status,
        act: act,
      },
      url: currentPage,
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
        $('#pager').html(data.pager);
      }
    });
  }

  function save_ads() {
    $.ajax({
      type: 'GET',
      url: "<?php echo url('/save-ads'); ?>",
      data: $('#saveads').serialize(),
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
        $("#pesan").html(data.message);
        $("#pesan").show();
        if (data.status == "success") {
          $('#ads_id').val(data.ads.id);
          $("#pesan").addClass("alert-success");
          $("#pesan").removeClass("alert-danger");
          var src = "{{asset('image/success.gif')}}"+"?a="+Math.random();;
          $('#img-success').attr('src',src);
          $('#save-success').modal('show');
          setTimeout(function(){
            $('#save-success').modal('hide')
          }, 3000);
        } else {
          $("#pesan").addClass("alert-danger");
          $("#pesan").removeClass("alert-success");
        }
      }
    });
  }

  function check_remaining(input,result){
    var maxLength = 100;
    var textlen = maxLength - $(input).val().length;

    if($(input).val().length==''){
      $(result).text(maxLength);
    } else {
      $(result).text(textlen);  
    }
  }
</script>

<section id="tabs" class="col-md-10 offset-md-1 col-12 pl-0 pr-0 project-tab main-cont">
  <div class="container body-content-mobile" style="margin-top: 80px">
    <div class="row">
      <div class="col-md-12">
        <h2>Ads Manager</h2>
        <hr class="mt-5 mb-4" style="width: 100%">
      </div>

      <input type="hidden" name="ads_id" id="ads_id" value="<?php if(!is_null($ads)) echo $ads->id ?>">  
      
      <div class="col-md-6">
        <span style="font-size: 16px">
          Available Credit Points <br>
          <span class="credit-poin" style="font-size: 35px; color:#1E88F5; font-family: 'SourceSansPro-Bold';">
            <?php  
              if(is_null($ads)){
                echo '0';
              } else {
                echo $ads->credit;
              }
            ?>
          </span> <span style="font-size: 25px">pts</span>
        </span> 
      </div>

      <div class="col-md-6 mt-3 mt-md-0 text-md-right">
        <button class="btn btn-topup" style="color: #393939; background-color: #FEB340;">
          <i class="fas fa-bookmark"></i> Top Up Points
        </button>  
      </div>

      <div class="col-md-12">
        
        <div id="pesan" class="alert mt-3"></div>

        <ul class="mb-4 nav nav-tabs">
          <li class="nav-item">
            <a href="#ads" class="nav-link link active show" role="tab" data-toggle="tab">
              Ads
            </a>
          </li>

          <li class="nav-item">
            <a href="#credit-history" class="nav-link link" role="tab" data-toggle="tab">
              Credit History
            </a>
          </li>
        </ul>

        <div class="tab-content" id="myTabContent" style="margin-bottom: 150px">
          <!-- Ads -->
          <div role="tabpanel" class="tab-pane fade in active show" id="ads">
            <div class="row">
              <div class="col-lg-8 col-md-7 col-12">
                <form id="saveads">
                  {{ csrf_field() }}

                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-lg-6 col-md-12 mb-0">
                        Your Headline <br>
                      </label>

                      <label class="col-lg-6 col-md-12 text-lg-right" style="font-weight:200">
                        <i>
                          <span class="head-remaining"></span>
                          Characters Remaining
                        </i>
                      </label>

                      <div class="col-md-12">
                        <input type="text" name="headline" value="<?php if(!is_null($ads)) echo $ads->headline ?>" id="headline-1-view" placeholder="Headline" class="form-control focushead" maxLength="100">
                      </div>
                    </div>     
                  </div>
                  
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-lg-6 mb-0">
                        Your Description
                      </label>

                      <label class="col-lg-6 col-md-12 text-lg-right" style="font-weight:200">
                        <i>
                          <span class="desc-remaining"></span>
                          Characters Remaining
                        </i>
                      </label>

                      <div class="col-md-12">
                        <input type="text" name="description" value="<?php if(!is_null($ads)) echo $ads->description ?>" id="desc-1-view" placeholder="Description" class="form-control focusdesc" maxLength="100">
                      </div>
                    </div>  
                  </div>
                                

                  <div class="form-group">
                    <label class="col-sm-12 col-form-label">
                      Redirect Link
                    </label>

                    <div class="col-md-12">
                      <input type="text" name="redirect" value="<?php if(!is_null($ads)) echo $ads->link ?>" id="redirect" placeholder="ex: https://some-url.com" class="form-control">
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-5 col-12">
                    <button type="button" class="btn btn-primary btn-block btn-save-ads">   
                      SAVE ADS
                    </button>
                  </div>   
                </form>
              </div>
              
              <!--phone-->
              <div class="col-lg-4 col-md-5 mt-5 mt-md-0 text-center">
                <div class="d-inline-block">
                  <div class="center preview-center">
                    <div class="mobile ads">
                      <div class="mobile1 ads">
                        <div class="screen colorgradient1 ads" id="phonecolor" style="border:none; overflow-y:auto; ">
                          <div class="col-md-12 mb-4 mt-4" align="center" id="poweredview">
                            <div class="powered-omnilinks">
                              <a href="#">
                                <span style="font-size:11px; color: #fff;">
                                  powered by
                                </span>
                                <br>&nbsp;&nbsp;
                                <img style="width: 110px;" src="{{asset('image/omnilinkz-logo-wh.png')}}">
                                </a>
                            </div>
                          </div>

                          <!--screen-->
                          <div class="offset-md-1 col-md-10 text-center redirect-ads">
                            <span href="#" class="headline-1-view-get" style="font-size: 13px;display: block;color: #1E88F5">
                              Your Headline Here
                            </span>
                            <span href="#" class="desc-1-view-get" style="font-size: 12px; font-weight: 200;display: block">
                              Your Description Here
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>  
            </div>
          </div>
      
          <!-- Credit History -->
          <div role="tabpanel" class="tab-pane fade" id="credit-history">
            <div class="row mb-3">
              <div class="col-md-6">
                Sistem perhitungan point : <br>
                - <i>View</i> 1 point <br>
                - <i>Click</i> 2 point
              </div>
              <div class="col-md-6 mt-3 mb-3 mt-md-0 mb-md-0 text-md-right">
                <p style="display: inline;">Periode : </p>
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
            <table class="table responsive" id="myTable">
              <thead align="center">
                <th class="header" action="date">Date</th>
                <th class="menu-nomobile header">Details</th>
                <th class="menu-nomobile header" action="click">Clicks</th>
                <th class="menu-nomobile header" action="view">View</th>
                <th class="header" action="selisih">Point Used</th>
              </thead>
              <tbody id="content"></tbody>
            </table>
            <div id="pager"></div>
          </div>
        </div>
      </div>

      <!-- untuk preview di mobile -->
      <div class="preview-mobile preview-none">
      </div>

    </div>
  </div>

</section>

<!-- Modal Save Success -->
<div class="modal fade" id="save-success" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content content-premiumid">
      <div class="modal-header header-premiumid">
        <h5 class="modal-title" id="modaltitle">
          Save Ads Success
        </h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body text-center">
        <img id="img-success" src="{{asset('image/success.gif')}}" style="max-width: 100px"><br>
        Save Ads <b>success!</b><br>
        Anda akan diarahkan ke <i>Ads manager</i> dalam 3 detik

        <div class="col-12 text-center mb-4" style="margin-top: 30px">
          <a href="#" data-dismiss="modal">
            Ke Ads manager
          </a>  
        </div>
      </div>

    </div>   
  </div>
</div>

<!-- Modal Top Up -->
<div class="modal fade" id="topup" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content content-premiumid">
      <div class="modal-header header-premiumid">
        <h5 class="modal-title" id="modaltitle">
          Top Up 
        </h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body text-center">
        Anda harus membuat Ads terlebih dahulu sebelum melakukan Top Up.

        <div class="col-12 text-center mb-4" style="margin-top: 30px">
          <a href="#" data-dismiss="modal">
            Ke Ads manager
          </a>  
        </div>
      </div>

    </div>   
  </div>
</div>

<script src="{{asset('js/farbtastic.js')}}"></script>
<script src="{{asset('js/biolinks.js')}}"></script>
<noscript>Jalankan Javascript di browser anda</noscript>
<script type="text/javascript">
  $( "body" ).on( "click", ".btn-topup", function() {
    if($('#ads_id').val()==''){
      $('#topup').modal('show');
    } else {
      var url = "<?php echo url('ads-pricing') ?>";
      window.location.href=url;  
    }
  });

  $( "body" ).on( "click", ".view-details", function() {
    var id = $(this).attr('data-id');

    $('.details-'+id).toggleClass('d-none');
  });

  $('body').on('click', '.btn-preview', function() {
    $('.preview-mobile').html($('.mobile1').html());
    $('.preview-mobile').toggleClass('preview-none');
  });

  $('body').on('click', '.btn-save-ads', function() {
    save_ads();
  });

  $('body').on('change','#bulan',function(e) 
  {
    refreshHistory();
  });

  $('body').on('change','#tahun',function(e) 
  {
    refreshHistory();
  });

  $(document).on('click', '.pagination a', function (e) {
    e.preventDefault();
    currentPage = '<?php echo url('load-credit-history'); ?>'+$(this).attr('href');
    refreshHistory();
  });

  $(document).ready(function() {
    <?php 
    $dt1 = Carbon::createFromFormat('Y-m-d H:i:s', $user->valid_until);
    $dt2 = Carbon::now();
    if ( ($user->membership=='free') && ($dt2->gt($dt1)) ) {
    ?>
    $('#modal-freetrial-expired').modal({
      backdrop: 'static',
      keyboard: false
    });
    <?php } ?>
    refreshHistory();

    check_remaining('.focushead','.head-remaining');
    check_remaining('.focusdesc','.desc-remaining');
    
    /*var tval = $('.focushead').val(),
        tlength = tval.length,
        set = 100,
        remain = parseInt(set - tlength);
    $('.head-remaining').text(remain);

    var tval = $('.focusdesc').val(),
        tlength = tval.length,
        set = 100,
        remain = parseInt(set - tlength);
    $('.desc-remaining').text(remain);*/


    <?php if(!is_null($ads)) { ?>
      $('.headline-1-view-get').html('{{$ads->headline}}');
      $('.desc-1-view-get').html('{{$ads->description}}');
    <?php } ?>

    $(document).on('focus','.focushead',function(){
      let inputlinkview=$(this);
      let getoutputviewlink=inputlinkview.attr('id');
      let outputviewlink=$('.'+getoutputviewlink+'-get');
      $(document).on('keyup',inputlinkview,function(){
         outputviewlink.text(inputlinkview.val());
         if (inputlinkview.val()=='') {
          outputviewlink.text('Your Headline Here');
         }
      });
    });

    $(document).on('focus','.focusdesc',function(){
      let inputlinkview=$(this);
      let getoutputviewlink=inputlinkview.attr('id');
      let outputviewlink=$('.'+getoutputviewlink+'-get');
      $(document).on('keyup',inputlinkview,function(){
         outputviewlink.text(inputlinkview.val());
         if (inputlinkview.val()=='') {
          outputviewlink.text('Your Description Here');
         }
      });
    });

    $('.focushead').keyup(function(e) {
      check_remaining('.focushead','.head-remaining');
    });

    $('.focusdesc').keyup(function(e) {
      check_remaining('.focusdesc','.desc-remaining');
    });

  });

  //function saat klik header table (sort asc)
    $(document).on('click', 'th.header', function (e) {
      if(!$(this).hasClass("asc")){
        status = 'asc';
        act = $(this).attr('action');
        
        refreshHistory();

        $("th").removeClass("asc");
        $("th").removeClass("desc");
        $(this).addClass("asc");
      }
    });

    //function saat klik header table (sort desc)
    $(document).on('click', 'th.asc', function (e) {
      if(!$(this).hasClass("desc")) {
        status = 'desc';
        act = $(this).attr('action');

        refreshHistory();

        $("th").removeClass("asc");
        $("th").removeClass("desc");
        $(this).addClass("desc");
      }
    });
</script>
@endsection
