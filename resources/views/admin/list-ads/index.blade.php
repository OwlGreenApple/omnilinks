@extends('layouts.app')

@section('content')
<script type="text/javascript">
  var table;
  var tableLog;

  $(document).ready(function() {
    table = $('#myTable').DataTable({
                responsive : true,
                destroy: true,
                "order": [],
            });

    tableLog = $('#tableLog').DataTable({
                responsive : true,
                destroy: true,
                "order": [],
            });

    $.fn.dataTable.moment( 'ddd, DD MMM YYYY' );

    refresh_page();

    $('.formatted-date').datepicker({
      dateFormat: 'yy/mm/dd',
    });
  });

  function refresh_page(){
    table.destroy();
    $.ajax({
      type : 'GET',
      url : "<?php echo url('/list-ads/load-ads') ?>",
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

        table = $('#myTable').DataTable({
                  responsive : true,
                  destroy: true,
                  "order": [],
                });
      }
    });
  }


  function get_log(){
    tableLog.destroy();

    $.ajax({
      type : 'GET',
      url : "<?php echo url('/list-ads/view-log') ?>",
      data : { id : $('#idlog').val() },
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
        $('#content-log').html(data.view);

        tableLog = $('#tableLog').DataTable({
                      responsive : true,
                      destroy: true,
                      "order": [],
                  });
      }
    });
  }
</script>

<section id="tabs" class="col-md-10 offset-md-1 col-12 pl-0 pr-0 project-tab" style="margin-top:30px;margin-bottom: 120px;">
  <div class="container body-content-mobile main-cont">
    <div class="row">

    <div class="col-md-11">

      <h2><b>Ads</b></h2>  
      
      <h5>
        Show you all ads
      </h5>
      
      <hr>

      <div id="pesan" class="alert"></div>


      <form>
        <table class="table" id="myTable">
          <thead align="center">
            <th>
              Email
            </th>
            <th>
              Headline
            </th>
            <th>
              Credit
            </th>
            <th>
              Click
            </th>
            <th>
              View
            </th>
            <th>
              Created
            </th>
            <th>
              Action
            </th>
            <th>
              Link
            </th>
            <th>
              Description
            </th>
          </thead>
          <tbody id="content"></tbody>
        </table>

        <div id="pager"></div>
        <p>
        Grand Total all click : <span id="grand-total-all-click"></span><br>
        Grand Total all view : <span id="grand-total-all-view"></span><br>
        </p>
      </form>
    </div>
  </div>
</div>

<!-- Modal View Log -->
<div class="modal fade" id="view-log" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modaltitle">
          Ads Log 
        </h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <table class="table" id="tableLog">

          <input type="hidden" name="idlog" id="idlog">

          <thead align="center">
            <th>jml_credit</th>
            <th>is_view</th>
            <th>is_click</th>
            <th>description</th>
            <th>credit_before</th>
            <th>credit_after</th>
            <th>Created_at</th>
          </thead>
          <tbody id="content-log"></tbody>
        </table>
      </div>
    </div>
      
  </div>
</div>


<script type="text/javascript">

  $( "body" ).on( "change", "#unlimited", function() {
    if(this.checked) {
      $('#valid_until').val('');
      $('#valid_until').prop('disabled', true);
    } else {
      $('#valid_until').prop('disabled', false);
    }
  });

  $( "body" ).on( "click", ".btn-log", function() {
    $('#idlog').val($(this).attr('data-id'));
    get_log();
  });
</script>
@endsection