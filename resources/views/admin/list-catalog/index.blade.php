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
      url : "<?php echo url('/list-coupon/load-coupon') ?>",
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

  function delete_kupon(){
    $.ajax({
      type : 'GET',
      url : "<?php echo url('/list-coupon/delete') ?>",
      data: {
        id : $('#id_delete').val(),
      },
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

        if(data.status=='success'){
          $('#pesan').html(data.message);
          $('#pesan').removeClass('alert-warning');
          $('#pesan').addClass('alert-success');
          $('#pesan').show();

          refresh_page();
        } else {
          $('#pesan').html(data.message);
          $('#pesan').removeClass('alert-success');
          $('#pesan').addClass('alert-warning');
          $('#pesan').show();
        }
      }
    });
  }

  function edit_kupon(){
    $.ajax({
      type : 'GET',
      url : "<?php echo url('/list-coupon/edit') ?>",
      data: $('#formKupon').serialize(),
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
        
        if(data.status=='success'){
          $('#pesan').html(data.message);
          $('#pesan').removeClass('alert-warning');
          $('#pesan').addClass('alert-success');
          $('#pesan').show();

          refresh_page();
        } else {
          $('#pesan').html(data.message);
          $('#pesan').removeClass('alert-success');
          $('#pesan').addClass('alert-warning');
          $('#pesan').show();
        }
      }
    });  
  }
</script>

<section id="tabs" class="col-md-10 offset-md-1 col-12 pl-0 pr-0 project-tab" style="margin-top:30px;margin-bottom: 120px;">
  <div class="container body-content-mobile main-cont">
    <div class="row">
    <div class="col-md-11">

      <h2><b>Catalogs</b></h2>  
      
      <h5>
        Show you all catalogs
      </h5>
      
      <hr>

      <div id="pesan" class="alert"></div>

      <br>  

      <form>

        <button type="button" class="btn btn-primary btn-add mb-3" data-toggle="modal" data-target="#add-coupon">
          <i class="fas fa-plus"></i> Add Catalog
        </button>

        <table class="table" id="myTable">
          <thead align="center">
            <th>
              Label Catalog
            </th>
            <th>
              Type
            </th>
            <th>
              Image
            </th>
            <th>
              Deskripsi
            </th>
            <th>
              Action
            </th>
          </thead>
          <tbody id="content"></tbody>
        </table>

        <div id="pager"></div>    
      </form>
    </div>
  </div>
</div>

<!-- Modal Confirm Delete -->
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
        <button class="btn btn-primary" id="btn-delete-ok" data-dismiss="modal">
          Yes
        </button>
        <button class="btn" data-dismiss="modal">
          Cancel
        </button>
      </div>
    </div>
      
  </div>
</div>

<!-- Modal Add Coupon -->
<div class="modal fade" id="add-coupon" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          Tambah Catalog
        </h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="formCatalog">          
          <div class="form-group row">
            <label class="col-md-4 col-12">
              <b>Catalog Label</b>
            </label>

            <div class="col-md-8 col-12">
              <input type="text" name="catalog_label" class="form-control"/>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-4 col-12">
              <b>Type</b> 
            </label>

            <div class="col-md-8 col-12">
              <select class="form-control" name="catalog_type">
                <option value="main">Main</option>
                <option value="coupon-global">Coupon-Global</option>
                <option value="other">Other</option>
                <option value="auto-generate">Auto Generate</option>
              </select>

              <div class="mt-2 coupon_users_global">
                 <select name="coupon_id" class="form-control">
                    <option>Special-aaaa</option>
                  </select>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-4 col-12">
              <b>Image</b> 
            </label>

            <div class="col-md-8 col-12">
                <input type="file" name="catalog_image" class="form-control" />
            </div>
          </div>  

          <div class="form-group row">
            <label class="col-md-4 col-12">
              <b>Deskripsi</b> 
            </label>
            
            <div class="col-md-12 col-12">
              <textarea class="form-control" name="deskripsi"></textarea>
            </div>
          </div>
        </form>
      </div>

      <div class="modal-footer" id="foot">
        <button class="btn btn-primary" id="btn-add-ok" data-dismiss="modal">
          Add
        </button>
        <button class="btn" data-dismiss="modal">
          Cancel
        </button>
      </div>
    </div>
      
  </div>
</div>
</section>

<script type="text/javascript">
  $(document).ready(function(){
    get_catalog_type();
    add_catalog();
  });

  function get_catalog_type(){ 
    $(".coupon_users_global").hide(); 
    $("select[name=catalog_type]").change(function(){
      var val = $(this).val();
      if(val == 'coupon-global')
      {
        $(".coupon_users_global").show(); 
      }
      else {
        $(".coupon_users_global").hide(); 
      }
    });
  }

  function add_catalog(){

   // $("#formCoupon")
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
      type : 'POST',
      url : "{{route('add_catalog')}}",
      data: new FormData($(this)),
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        /*var data = jQuery.parseJSON(result);
        
        if(data.status=='success'){
          $('#pesan').html(data.message);
          $('#pesan').removeClass('alert-warning');
          $('#pesan').addClass('alert-success');
          $('#pesan').show();

          refresh_page();
        } else {
          $('#pesan').html(data.message);
          $('#pesan').removeClass('alert-success');
          $('#pesan').addClass('alert-warning');
          $('#pesan').show();
        }*/
      }
    });  
  }

  $( "body" ).on( "click", ".btn-edit", function() {
    $('#title-coupon').html('Edit Kupon');
    $('#kodekupon').val($(this).attr('data-kodekupon'));
    $('#diskon_value').val($(this).attr('data-nominal'));
    $('#diskon_percent').val($(this).attr('data-persen'));
    $('#valid_until').val($(this).attr('data-validuntil'));
    $('#valid_to').val($(this).attr('data-validto'));
    $('#keterangan').val($(this).attr('data-keterangan'));
    $('#package_id').val($(this).attr('data-paket'));
    
    $('#id_edit').val($(this).attr('data-id'));

    $('#add-coupon').modal('show');
  });

  $( "body" ).on( "click", ".btn-add", function() 
  {
    $('#title-coupon').html('Tambah Kupon');
    
    $('#kodekupon').val('');
    $('#diskon_value').val(0);
    $('#diskon_percent').val(0);
    $('#valid_until').val('');
    $('#valid_to').val('all');
    $('#keterangan').val('');
    $('#package_id').val(0);

    $('#id_edit').val('');

    $('#add-coupon').modal('show');
  });

  $( "body" ).on( "click", "#btn-add-ok", function() 
  {
    if($('#id_edit').val()==''){
      add_kupon();
    } else {
      edit_kupon();
    }
  });

  $( "body" ).on( "click", ".btn-delete", function() {
    $('#id_delete').val($(this).attr('data-id'));
  });

  $( "body" ).on( "click", "#btn-delete-ok", function() {
    delete_kupon();
  });

</script>
@endsection