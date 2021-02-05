 @if($pages->connect_activrespon > 0)
  <div class="col-lg-7 col-md-12 col-sm-12 col-12 mb-2 text-center header-txt"><h4><b>{{ $pages->act_form_text }}</b></h4></div>
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
  <div class="col-lg-7 col-md-12 col-sm-12 col-12 mb-2 text-center header-txt"><h4><b>{{ $pages->mc_form_text }}</b></h4></div>
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