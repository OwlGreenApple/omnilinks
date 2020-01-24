@extends('layouts.app')

@section('content')
<section id="tabs" class="col-md-10 offset-md-1 col-12 pl-0 pr-0 project-tab" style="margin-top:30px;margin-bottom: 120px;">

  <div class="container body-content-mobile main-cont">
    <div class="row">
        <div class="col-md-11">
          <h2><b>Affliate</b></h2> 
          <h5>Show all affiliated users</h5>
       
          <hr>

          <div id="pesan" class="alert"></div>

          <br>  

          <table class="table" id="myTable">
            <thead align="center">
              <th>No</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Jumlah Komisi Yang Belum Dibayar</th>
              <th>Rincian Order</th>
            </thead>
            <tbody id="content"></tbody>
          </table>
        </div>
    </div>
  </div>
</section>

<!-- Modal Detail -->
<div class="modal fade" id="detail_modal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
          <div id="detail_affiliate"><!-- data detail --></div>
      </div>
      <div class="modal-footer" id="foot">
        <button class="btn btn-primary" data-dismiss="modal">
          Tutup
        </button>
      </div>
    </div>
      
  </div>
</div>

<script type="text/javascript">
  var table;

  $(document).ready(function() {
    table = $('#myTable').DataTable({
      destroy: true,
      "order": [],
    });
    $.fn.dataTable.moment( 'ddd, DD MMM YYYY' );

    refresh_page();

    $('.formatted-date').datepicker({
      dateFormat: 'yy/mm/dd',
    });
    detail_affiliate();
  });

  function refresh_page(){
    table.destroy();
    $.ajax({
      type : 'GET',
      url : "{{url('getaffiliate')}}",
      dataType: 'html',
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        $('#content').html(result);
        table = $('#myTable').DataTable({
                destroy: true,
                "order": [],
        });
      }
    });
  }

  function detail_affiliate()
  {
    $("body").on("click",".open_detail",function(){
        var userid = $(this).attr('id');
        $("#detail_modal").modal();
        $.ajax({
          type : 'GET',
          url : '{{url("detailaffiliate")}}',
          dataType : 'html',
          success : function(result)
          {
            $("#detail_affiliate").html(result);
          }
        });
      });
  }

</script>
@endsection
