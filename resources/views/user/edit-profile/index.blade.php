@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/dash.css')}}">

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

<style type="text/css">
  label {
    font-weight: 400;
  }
</style>

<section id="tabs" class="col-md-10 offset-md-1 col-12 pl-0 pr-0 project-tab" style="margin-top:30px;margin-bottom: 120px;min-height:100%;">
  <div class="container body-content-mobile main-cont">
    <div class="row">
    <div class="col-md-12">

      <h2><b>Account Profile</b></h2>

      <hr>  

      <div class="row">
        <div class="col-md-6 col-12">
          <p class="mb-3">  
            <?php  
              if($user->membership=="free"){
                $html = '<i class="fas fa-flag"></i>Free Account';
                $txt = '';
              } else if($user->membership=="basic"){
                $html = '<i class="fas fa-trophy"></i>Basic Account';
                $txt = 'text-success';
              } else {
                $html = '<i class="fas fa-star"></i>Elite Account';
                $txt = 'txt-elite';
              }
            ?>
            <span class="<?php echo $txt; ?> header-status-account">
              <?php echo $html ?>
            </span>
            <br>
            <span class="content-status-account" style="font-weight: 400">
              @if($user->membership=="free")
                Your Packages is <b>Forever free</b>.
              @else
                Your Packages Valid until <b><?php echo Carbon::parse($user->valid_until)->format('d M Y');?></b>.
              @endif
            </span>          
          </p>
        </div>

        <div class="col-md-6 col-12 mb-1">
            <a href="{{url('pricing')}}">
              <button class="btn btn-ugrades float-md-right mt-3 mt-md-0" style="color: #393939;background-color: #FEB340; ">
                <i class="fas fa-star"></i> Upgrade Packages
              </button>  
            </a>
        </div>
      </div>
      
      <div class="alert" id="pesan"></div>

      <form enctype="multipart/form-data" id="form-edit">
        @csrf

        <input type="file" name="fileprofpic" id="fileprofpic" accept="image/*" style="display:none">

        <label class="col-sm-4 col-form-label">
          <b>Edit your personal data</b>
        </label>
      
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
            Full Name
          </label>

          <div class="col-md-11">
            <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}">
          </div>
        </div>

        <br><br>

        <label class="col-sm-4 col-form-label">
          <b>Edit your password</b>
        </label>
        <div class="form-group">
          <label class="col-sm-4 col-form-label">
            Old Password
          </label>

          <div class="col-md-11">
            <input id="oldpassword" type="password" class="form-control" name="oldpassword">
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
              UPDATE PROFILE
            </button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>
</section>

<script type="text/javascript">
  $( "body" ).on( "click", "#btn-edit", function() {
    edit_profile();
  });
</script>
@endsection