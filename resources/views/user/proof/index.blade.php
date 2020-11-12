@extends('layouts.app')

@section('content')

<div id="apf" class="container mb-5 main-cont">

    <div class="col-md-9 pr-0 div-btn mx-auto mb-5">
        <div class="row">
          <div class="col-lg-4 col-md-3 pl-md-3 pl-0 pr-0">
            <h4>Total Credits : <b>{{ $total_proof_credit }}</b></h4>
          </div>

          <div class="ml-lg-auto ml-md-auto mr-3 ml-3 col-lg-4 col-md-5 col-12 pl-md-3 pl-0 pr-0 mb-3 text-right">
            <a href="#" class="btn btn-primary btn-lg">History</a>
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
      <div class="table-responsive" id="content"><!-- display table --></div>
    </div>
<!-- -->   
</div>

<!-- modal to add credit --> 
<div class="modal fade" id="modal_credit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><h5>Silahkan isi jumlah credit untuk <b>menambahkan</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input min="0" type="number" class="form-control" name="nominal" />
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
        <h5 class="modal-title"><h5>Silahkan isi jumlah credit untuk <b>mengurangi</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input min="0" type="number" class="form-control" name="nominal_subs" />
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
      counting_point(id,nominal,1);
    });
  }

  function substractPoint()
  {
    $("#save_credit_subs").click(function(){
      var nominal = $("input[name='nominal_subs']").val();
      var id = $(this).attr('data-id');
      counting_point(id,nominal,0);
    });
  }

  function counting_point(id,nominal,purpose)
  {
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'POST',
      url: '{{ url("counting_point") }}',
      data: {id : id,nominal : nominal, purpose : purpose},
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
        
        if(result.error == 1)
        {
            $("#notif").html('<div class="alert alert-danger">Server kami terlalu sibuk. mohon di coba lagi nanti.</div>');
        }
        else if(result.error == 2)
        {
            $("#notif").html('<div class="alert alert-danger">Jumlah invalid.</div>');
        }
        else
        {
            $("#notif").html('<div class="alert alert-success">Data nominal anda telah di alokasikan.</div>');
            get_links();
        }
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
      $("#modal_credit").modal();
    });

    $("body").on("click",".subs",function()
    {
      var id = $(this).attr('id');
      id = id.split("_");
      $("#save_credit_subs").attr('data-id',id[1]);
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