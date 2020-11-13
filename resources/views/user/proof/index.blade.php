@extends('layouts.app')

@section('content')

<div id="apf" class="container mb-5 main-cont">

    <div class="col-md-9 pr-0 div-btn mx-auto mb-5">
        <div class="row">
          <div class="col-lg-4 col-md-3 pl-md-3 pl-0 pr-0">
            <h4>Total Credits : <b class="current_point">{{ $total_proof_credit }}</b></h4>
          </div>

          <div class="ml-lg-auto ml-md-auto mr-3 ml-3 col-lg-4 col-md-5 col-12 pl-md-3 pl-0 pr-0 mb-3 text-right">
            <a href="{{ url('proof_history') }}" class="btn btn-primary btn-lg">History</a>
          </div>
        </div>
    </div>

    <div class="col-md-12 pr-0 div-btn mx-auto mt-3 mb-3">
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-3 col-3">
            <div class="shop">
              <div>1</div>
              <button type="button" class="btn btn-success">Beli</button>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-3">
            <div class="shop">
              <div>2</div>
              <button type="button" class="btn btn-success">Beli</button>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-3">
            <div class="shop">
              <div>3</div>
              <button type="button" class="btn btn-success">Beli</button>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-3">
            <div class="shop">
              <div>3</div>
              <button type="button" class="btn btn-success">Beli</button>
            </div>
          </div>
          <!-- --> 
        </div>
    </div>

    <div class="col-md-12 pr-0 div-btn mx-auto mt-5">
      <span id="notifier"><!-- display message --></span>
      <div class="table-responsive" id="content"><!-- display table --></div>
    </div>
<!-- -->   
</div>

<!-- modal to add credit --> 
<div class="modal fade" id="modal_credit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Silahkan isi jumlah credit untuk <b>menambahkan</b>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div>Page: <b class="pg_name"></b></div>
        <div>Jumlah Credit: <b class="pg_credit"></b></div>
      </div>

      <div class="modal-body">
        <span class="notif"><!-- notif --></span>
        <input min="0" type="number" class="form-control" name="nominal" value="0" />
        <span class="error alo-id"><!-- error id --></span>
        <span class="error alo-nominal"><!-- error id --></span>
        <span class="error alo-page"><!-- error id --></span>
      </div>
      <div class="modal-footer">
        <button id="save_credit_add" type="button" class="btn btn-success">Tambah</button>
      </div>
    </div>
  </div>
</div>

<!-- modal to substract credit --> 
<div class="modal fade" id="modal_credit_subs" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Silahkan isi jumlah credit untuk <b>mengurangi</b>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div>Page: <b class="pg_name"></b></div>
        <div>Jumlah Credit: <b class="pg_credit"></b></div>
      </div>

      <div class="modal-body">
        <span class="notif"><!-- display error --></span>
        <input min="0" type="number" class="form-control" name="nominal_subs" value="0" />
        <span class="error alo-id"><!-- error id --></span>
        <span class="error alo-nominal"><!-- error id --></span>
        <span class="error alo-page"><!-- error id --></span>
      </div>
      <div class="modal-footer">
        <button id="save_credit_subs" type="button" class="btn btn-danger">Kurangi</button>
      </div>
    </div>
  </div>
</div>

<!-- javascript -->   
<script type="text/javascript">
  
  $(function(){
    get_links();
    open_modal_credit();
    addPoint();
    substractPoint();
  });

  function addPoint()
  {
    $("#save_credit_add").click(function(){
      var nominal = $("input[name='nominal']").val();
      var id = $(this).attr('data-id');
      var page = $(this).attr('data-page');
      counting_point(id,nominal,page,1);
    });
  }

  function substractPoint()
  {
    $("#save_credit_subs").click(function(){
      var nominal = $("input[name='nominal_subs']").val();
      var id = $(this).attr('data-id');
      var page = $(this).attr('data-page');
      counting_point(id,nominal,page,0);
    });
  }

  function counting_point(id,nominal,page,purpose)
  {
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'POST',
      url: '{{ url("counting_point") }}',
      data: {id : id,nominal : nominal, purpose : purpose, page : page},
      dataType:'json',
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) 
      {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');
        
        if(result.err == 0)
        {
            $("#notifier").html('<div class="alert alert-success">Data nominal anda telah di alokasikan.</div>');
            $("#modal_credit , #modal_credit_subs").modal('hide');
            $(".current_point").html(result.point);
            get_links();
        }
        
        if(result.err == 1)
        {
            $(".notif").html('<div class="alert alert-danger">Server kami terlalu sibuk. mohon di coba lagi nanti.</div>');
        }

        if(result.err == 2)
        {
            $(".notif").html('<div class="alert alert-danger">Jumlah invalid.</div>');
        }

        if(result.err == 3)
        {
            $(".notif").html('<div class="alert alert-danger">Credit and tidak cukup, silahkan top up lagi</div>');
        }

        if(result.err == 4)
        {
            $(".alo-id").html('<div>'+result.id+'</div>');
            $(".alo-nominal").html('<div>'+result.nominal+'</div>');
            $(".alo-page").html('<div>'+result.page+'</div>');
        }
       
        $(".alert, .error").delay(5000).fadeOut(2000);
      },
      error:function(xhr,throwable,err)
      {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');
        // console.log(xhr.responseText);
      }
    });
  }

  function open_modal_credit()
  {
    $("body").on("click",".add",function()
    {
      var id = $(this).attr('id');
      id = id.split("_");
      $("#save_credit_add").attr('data-id',id[1]);
      var page = $("#pg_"+id[1]).text();
      var credit = $("#cd_"+id[1]).text();
      $("#save_credit_add").attr('data-page',page);
      $(".pg_name").html(page); 
      $(".pg_credit").html(credit);
      $("#modal_credit").modal();
    });

    $("body").on("click",".subs",function()
    {
      var id = $(this).attr('id');
      id = id.split("_");
      $("#save_credit_subs").attr('data-id',id[1]);
      var page = $("#pg_"+id[1]).text();
      var credit = $("#cd_"+id[1]).text();
      $("#save_credit_subs").attr('data-page',page);
      $(".pg_name").html(page); 
      $(".pg_credit").html(credit);
      $("#modal_credit_subs").modal();
    });
  }

  function get_links()
  {
    $.ajax({
      type : 'GET',
      url : '{{ url("display_links") }}',
      dataType : 'html',
      success : function(result)
      {
        $("#content").html(result);
      },
      error : function(xhr)
      {
        console.log(xhr.responseText);
      }
    });
  }
</script>
@endsection