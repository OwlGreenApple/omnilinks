@extends('layouts.app')

@section('content')
<script type="text/javascript">
  function edit_profile(){
    $.ajax({
      type : 'POST',
      url : "<?php echo url('/edit-profile/edit') ?>",
      data: $('#form-edit').serialize(),
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

<div class="col-md-10 offset-md-1 mb-5" style="height:100%; margin-top:45px">
  <div class="row justify-content-center">
    <div class="col-md-12">

      <h2><b>Edit Profile</b></h2>

      <h5>
        Edit your personal data
      </h5>

      <hr>  

      <div class="alert" id="pesan"></div>

      <form enctype="multipart/form-data" id="form-edit">
        @csrf

        <input type="file" name="fileprofpic" id="fileprofpic" accept="image/*" style="display:none">

        <div class="form-group">
          <label class="col-sm-4 col-form-label">
            Full Name
          </label>

          <div class="col-md-11">
            <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-4 col-form-label">
            Username
          </label>

          <div class="col-md-11">
            <input id="username" type="text" class="form-control" name="username" value="{{$user->username}}">
          </div>
        </div>
            
        <div class="form-group">
          <label class="col-sm-4 col-form-label">
            Email
          </label>

          <div class="col-md-11">
            <input id="email" type="text" class="form-control" name="email" value="{{$user->email}}">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-4 col-form-label">
            New Password
          </label>

          <div class="col-md-11">
            <input id="password" type="password" class="form-control" name="password">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-4 col-form-label">
            Confirm New Password
          </label>

          <div class="col-md-11">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  required>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
            <button type="button" class="btn btn-primary" id="btn-edit">
              Update Profile
            </button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>

<script type="text/javascript">
  $( "body" ).on( "click", "#btn-edit", function() {
    edit_profile();
  });
</script>
@endsection