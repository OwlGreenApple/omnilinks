@extends('layouts.app')

@section('content')
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
  });

  function refresh_page(){
    table.destroy();
    $.ajax({
      type : 'GET',
      url : "<?php echo url('/list-page/load-page') ?>",
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

      <h2><b>Pages</b></h2>  
      
      <h5>
        Show all pages 
      </h5>
      
      <hr>

      <div id="pesan" class="alert"></div>

      <br>  

      <form>


        <table class="table" id="myTable">
          <thead align="center">
            <th>
              Random Name
            </th>
            <th>
              Premium Name
            </th>
            <th>
              Click Link Counter
            </th>
            <th>
              Click Banner Counter
            </th>
            <th>
              Click Wa Counter
            </th>
            <th>
              Click Line Counter
            </th>
            <th>
              Click Telegram Counter
            </th>
            <th>
              Click Skype Counter
            </th>
            <th>
              Click FB Messenger Counter
            </th>
            <th>
              Click Youtube Counter
            </th>
            <th>
              Click FB Profile Counter
            </th>
            <th>
              Click Twitter Counter
            </th>
            <th>
              Click IG Counter
            </th>
            <th>
              Click Total Counter
            </th>
            <th>
              View Counter
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

</section>

@endsection
