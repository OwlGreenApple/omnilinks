@extends('layouts.app')

@section('content')

<section id="tabs" class="col-md-10 offset-md-1 col-12 pl-0 pr-0 project-tab" style="margin-top:30px;margin-bottom: 120px;">
  <div class="container body-content-mobile main-cont">
    <div class="row">
    <div class="col-md-11">

      <h2><b>Catalogs</b></h2>  
      
      <h5>
        Show you all catalogs
      </h5>
      
      <hr>

      <div id="pesan"><!-- display status --></div>

      <form>
        <button type="button" class="btn btn-primary btn-add mb-3" data-toggle="modal" data-target="#add-catalog">
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

        <input type="hidden" name="id_delete" />
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


<!-- Modal Add / Edit Coupon -->
<div class="modal fade" id="add-catalog" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title catalog-box">
          Tambah Catalog
        </h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

        <div id="err"><!-- Display error --></div>

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
                   @if($coupons->count() > 0)
                      @foreach($coupons as $coupon)
                        <option value="{{$coupon->id}}">{{$coupon->kodekupon}}</option>
                      @endforeach
                   @endif
                  </select>
              </div> 

            </div>
          </div>

          <div class="form-group row coupon-link">
            <label class="col-md-4 col-12">
              <b>Coupon URL</b> 
            </label>

            <div class="col-md-8 col-12">
                <input type="text" name="coupon_link" class="form-control"/>
            </div>
          </div>   

          <div class="form-group row coupon-link">
            <label class="col-md-4 col-12">
              <b>Valid Until</b> 
            </label>

            <div class="col-md-8 col-12">
                <input type="text" name="valid_until" class="form-control formatted-date"/>
            </div>
          </div> 

          <div class="form-group row coupon-link">
            <label class="col-md-4 col-12">
              <b>Kode Kupon</b> 
            </label>

            <div class="col-md-8 col-12">
                <input type="text" name="coupon_code" class="form-control"/>
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
      </div>

      <input readonly="readonly" type="hidden" name="id_catalog" />

      <div class="modal-footer" id="foot">
        <button id="btn-add-ok" class="btn btn-primary">
          Save
        </button>
        <button class="btn" data-dismiss="modal">
          Cancel
        </button>
      </div>
    </div>
    </form>
      
  </div>
</div>
</section>

<script type="text/javascript">
  var table;
  $(document).ready(function(){
    get_form();
    get_catalog_type();
    save_catalog();
    display_catalog();
    display_edit();
    display_delete();
    del_catalog()
  });

  function get_form()
  {
    $(".btn-add").click(function(){
      $("input, textarea").val('');
      $('select[name=catalog_type] > option[value="main"]').prop('selected','selected');
      get_catalog_type();
      $(".catalog-box").html('Tambah Katalog');
      $(".alert").hide();
    });
  }

  function get_catalog_type(){ 
    $("input, textarea").val('');
    $(".coupon_users_global").hide(); 
    $(".coupon-link").hide();
    $("input[name=coupon_link], input[name=valid_until], input[name=coupon_code]").prop('disabled',true);
    $("select[name='coupon_id']").prop('disabled', 'disabled'); 

    $("select[name=catalog_type]").change(function(){
      var val = $(this).val();
      if(val == 'coupon-global')
      {
        $(".coupon_users_global").show();
        $("select[name='coupon_id']").prop('disabled', false); 
        $(".coupon-link").hide();
        $("input[name=coupon_link], input[name=valid_until], input[name=coupon_code]").prop('disabled',true);
      }
      else if(val == 'other')
      {
        $(".coupon-link").show();
        $("input[name=coupon_link], input[name=valid_until], input[name=coupon_code]").prop('disabled',false);
        $(".coupon_users_global").hide();
        $("select[name='coupon_id']").prop('disabled', 'disabled'); 
      }
      else {
        $(".coupon-link").hide();
        $("input[name=coupon_link]").prop('disabled',true);
        $(".coupon_users_global").hide();
        $("select[name='coupon_id']").prop('disabled', 'disabled'); 
      }
    });
  }

  function save_catalog(){
    $("#formCatalog").on("submit",function(e){
      e.preventDefault();

      var formdata = new FormData(this);
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type : 'POST',
        url : "{{route('add_catalog')}}",
        processData: false,
        contentType: false,
        data: formdata,
        beforeSend: function()
        {
          $('#loader').show();
          $('.div-loading').addClass('background-load');
        },
        success: function(result) {
          $('#loader').hide();
          $('.div-loading').removeClass('background-load');

          if(result.status=='success'){
            $('#err').html(result.message);
            $('#err').removeClass('alert alert-warning');
            $('#err').addClass('alert alert-success');
            $('#err').show();
            refresh_page();

            if(result.ins == 1)
            {
              get_catalog_type();
            }

          } else {
            $('#err').html(result.message);
            $('#err').removeClass('alert alert-success');
            $('#err').addClass('alert alert-warning');
            $('#err').show();
          }
        }
      });  
    });

  }

  function display_edit()
  {
     $( "body" ).on( "click", ".btn-edit", function() {
      $(".catalog-box").html('Edit Katalog');

      $('input[name=id_catalog]').val($(this).attr('data-id'));
      $('input[name=catalog_label]').val($(this).attr('data-label'));
      $('select[name=catalog_type] > option[value='+$(this).attr('data-type')+']').prop('selected','selected');

      if($(this).attr('data-type') == 'coupon-global')
      {
        $(".coupon_users_global").show();
        $("select[name='coupon_id']").prop('disabled', false);
        $('select[name=coupon_id] > option[value='+$(this).attr('data-coupon-id')+']').prop('selected','selected'); 
        $(".coupon-link").hide();
        $("input[name=coupon_link], input[name=valid_until], input[name=coupon_code]").prop('disabled',true);
      }
      else if($(this).attr('data-type') == 'other'){
        $(".coupon-link").show();
        $("input[name=coupon_link]").val($(this).attr('data-link'));
        $("input[name=coupon_code]").val($(this).attr('data-coupon'));
        $("input[name=valid_until]").val($(this).attr('data-exp'));
        $("input[name=coupon_link],input[name=valid_until], input[name=coupon_code]").prop('disabled',false);
        $(".coupon_users_global").hide();
        $("select[name='coupon_id']").prop('disabled', 'disabled'); 
      } else {
        $(".coupon-link").hide();
        $("input[name=coupon_link]").prop('disabled',true);
        $(".coupon_users_global").hide();
        $("select[name='coupon_id']").prop('disabled', 'disabled'); 
      }
      $('textarea[name=deskripsi]').val($(this).attr('data-desc'));
    });
  }

  function display_catalog() {
    table = $('#myTable').DataTable({
      destroy: true,
      "order": [],
    });
    $.fn.dataTable.moment( 'ddd, DD MMM YYYY' );
    refresh_page();
  };

  $(function () {
      $('.formatted-date').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss'
      });
  });

  function refresh_page(){
    table.destroy();
    $.ajax({
      type : 'GET',
      url : "{{route('datacatalog')}}",
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

  function display_delete()
  {
    $("body").on("click",".btn-delete",function(){
      var id = $(this).attr('data-id');
      $("input[name=id_delete]").val(id);
    });
  }

  function del_catalog()
  {
    $("#btn-delete-ok").click(function(){
      delete_catalog();
    });
  }

  function delete_catalog(){
    $.ajax({
      type : 'GET',
      url : "{{url('del-catalog')}}",
      data: {
        id : $('input[name=id_delete]').val(),
      },
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        if(result.status=='success'){
          $('#pesan').html(result.message);
          $('#pesan').removeClass('alert alert-warning');
          $('#pesan').addClass('alert alert-success');
          $('#pesan').show();
          refresh_page();
        } else {
          $('#pesan').html(result.message);
          $('#pesan').removeClass('alert alert-success');
          $('#pesan').addClass('alert alert-warning');
          $('#pesan').show();
        }
      }
    });
  }

</script>
@endsection