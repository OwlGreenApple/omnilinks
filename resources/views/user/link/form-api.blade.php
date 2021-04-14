 @if($pages->connect_activrespon > 0)
  <div class="col-lg-7 col-md-12 col-sm-12 col-12 mb-2 text-center header-txt"><h4><b id="act_text">{{ $pages->act_form_text }}</b></h4></div>

  <!-- bottom form title -->
  @if($pages->act_form_bottom !== null || $pages->act_form_bottom !== "")
    <div class="col-lg-7 col-md-12 col-sm-12 col-12 mb-2 text-center header-txt"><h4><b id="act_bottom_text">{{ $pages->act_form_bottom }}</b></h4></div>
  @endif

  <div style="padding-left : 30px;padding-right : 30px" class="err_connect col-lg-7 col-md-12 col-sm-12 col-12"><!-- notification --></div>
  <form id="connect_preview" class="col-lg-7 col-md-12 col-sm-12 col-12 mb-2">
    <div class="form-group mb-2">
      <div class="col-lg-12 mb-3">
        <input type="text" class="form-control" name="api_name" placeholder="Nama" maxlength="50" />
        <div class="error api_name"><!-- Error --></div>
      </div>

      <div class="col-lg-12 mb-3">
        <input type="email" class="form-control" name="api_email" placeholder="Email" />
        <div class="error api_email"><!-- Error --></div>
      </div>

      <div class="col-lg-12 mb-3">
        <input type="phone" class="form-control" name="api_phone" placeholder="Phone example : +628xxxxxxx" />
        <div class="error api_phone"><!-- Error --></div>
      </div>

      <div class="col-12 txthov">
       <button class="btn btn-block">Submit</button>
      </div>
    </div>
  </form>
@endif

<!-- form connect API mailchimp -->
@if($pages->connect_mailchimp > 0)
  <div class="col-lg-7 col-md-12 col-sm-12 col-12 mb-2 text-center header-txt"><h4><b id="mc_text">{{ $pages->mc_form_text }}</b></h4></div>

  @if($pages->mc_form_bottom !== null || $pages->mc_form_bottom !== "")
    <div class="col-lg-7 col-md-12 col-sm-12 col-12 mb-2 text-center header-txt"><h4><b id="mc_bottom_text">{{ $pages->mc_form_bottom }}</b></h4></div>
  @endif

  <div style="padding-left : 30px;padding-right : 30px" class="err_connect_mc col-lg-7 col-md-12 col-sm-12 col-12 mb-1"><!-- notification --></div>
  <form id="connect_mailchimp" class="col-lg-7 col-md-12 col-sm-12 col-12 mb-2">
    <div class="form-group mb-4">
      <div class="col-lg-12 mb-3">
        <input type="email" class="form-control" name="api_mc_email" placeholder="Email" />
        <div class="error api_mc_email"><!-- Error --></div>
      </div>

      <div class="col-lg-12 mb-3">
        <input type="text" class="form-control" name="api_mc_fname" placeholder="First Name" />
        <div class="error api_mc_fname"><!-- Error --></div>
      </div>

      <div class="col-lg-12 mb-3">
        <input type="phone" class="form-control" name="api_mc_lname" placeholder="Last Name" />
        <div class="error api_mc_lname"><!-- Error --></div>
      </div>

      <div class="col-12 txthov">
       <button class="btn btn-block">Submit</button>
      </div>
    </div>
  </form>
@endif

<script>
function sendAPImailchimp()
{
  $("#connect_mailchimp").submit(function(e){
    e.preventDefault();
    var data = $(this).serializeArray();
    data.push(
      {'name': 'pagename','value':'{{$pages->names}}'}
    );
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      data: data,
      url: "{{ url('save-mailchimp') }}",
      dataType: 'text',
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      }, 
      success: function(result) 
      {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        if(result.success == 0)
        {     
          $(".err_connect_mc").html('<div class="alert alert-danger mb-3">'+result.title+'</div>')
        }
        else if(result.success == 2)
        {
          $(".error").show();
          (result.api_mc_fname !== undefined)? $(".api_mc_fname").html(result.api_mc_fname):$(".api_mc_fname").html('');
          (result.api_mc_lname !== undefined)? $(".api_mc_lname").html(result.api_mc_lname):$(".api_mc_lname").html('');
          (result.api_mc_email !== undefined)? $(".api_mc_email").html(result.api_mc_email):$(".api_mc_email").html('');
          (result.pagename !== undefined)? $(".err_connect_mc").html('<div class="alert alert-danger mb-3">'+result.pagename+'</div>'):$(".err_connect_mc").html('');
        }
        else
        {
           $(".err_connect_mc").html('<div class="alert alert-success mb-3">Thank you for join us.</div>')
           $(".error").hide();
           empty_form();
          
        }
      },
      error : function(xhr){
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');
        console.log(xhr.responseText);
      }
    });
    //end ajax
  });
}


function sendAPIdata()
{
  $("#connect_preview").submit(function(e){
    e.preventDefault();
    var data = $(this).serializeArray();
    data.push(
      {'name': 'pagename','value':'{{$pages->names}}'}
    );
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      data: text,
      url: "{{ url('save-api') }}",
      dataType: 'json',
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
          $(".error").show();
          $(".api_name").html(result.name);
          $(".api_email").html(result.email);
          $(".api_phone").html(result.phone);
          (result.db !== undefined)?  $(".err_connect").html('<div class="alert alert-danger mb-3">'+result.db+'</div>'): $(".err_connect").html('');
        }
        else
        {
           $(".err_connect").html('<div class="alert alert-success mb-3">'+result.response+'</div>')
           $(".error").hide();
           empty_form();
        }
      },
      error : function(xhr){
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');
        console.log(xhr.responseText);
      }
    });
    //end ajax
  });
}
$(document).ready(function() {
    sendAPIdata();
    sendAPImailchimp();
});

</script>