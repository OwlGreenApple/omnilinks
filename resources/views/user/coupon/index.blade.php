@extends('layouts.app')

@section('content')
<script type="text/javascript">

  $(document).ready(function() {
  });

</script>

<section id="tabs" class="col-md-10 offset-md-1 col-12 pl-0 pr-0 project-tab" style="margin-top:30px;margin-bottom: 120px;">
  <div class="container body-content-mobile main-cont">
    <div class="row">
    <div class="col-md-11">

      <h2><b>Coupons</b></h2>  
      
      <h5>
        Show you all coupons
      </h5>
      
      <hr>

      <div id="pesan" class="alert"></div>

      <br>  

      <form>

        <button type="button" class="btn btn-primary btn-add mb-3" data-toggle="modal" data-target="#add-coupon">
          <i class="fas fa-plus"></i> Add Coupons
        </button>

        <table class="table" id="myTable">
          <thead align="center">
            <th>
              Kode Kupon
            </th>
            <th>
              Diskon (Nominal)
            </th>
            <th>
              Diskon (Persen)
            </th>
            <th>
              Valid Until
            </th>
            <th>
              Valid To
            </th>
            <th>
              Keterangan 
            </th>
            <th>
              Paket
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


</section>


@endsection