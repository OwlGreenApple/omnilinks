@extends('layouts.app')
@section('content')
<link href="{{ asset('css/style-pricing.css') }}" rel="stylesheet">
<script src="{{ asset('js/custom.js') }}"></script>

<style type="text/css">
  .card {
    border-radius: 0px;
    border: 1px solid #106BC8;
  }

  .mb30 {
    margin-bottom: 50px;
  }

  .txt-poin {
    font-size: 20px;
    font-weight: 100;
  }

  .idr {
    font-size: 23px;
    font-weight: 100;  
  }
</style>

<section class="page-title ads">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1>
          Omnilinkz Ads <br>
          Pricing Packages
        </h1>
        
        <p class="pg-title">
          Pilih paket Ads Omnilinkz <br> bergantung pada kebutuhan iklan Anda 
          <span class="tooltipstered" title="Sistem perhitungan point: <br> - View 1 point <br> - Click 2 point">
            <i class="fas fa-question-circle icon-reflink"></i>
          </span>
        </p>

      </div>
    </div>
  </div>
</section>

<div class="offset-md-2 col-md-8 mb30" align="center">
  <div class="row mb-md-0 mb-5 pricing-box">

    <div class="col-lg-4 col-md-12 col-12">
      <div class="card">
        <div class="card-body">
         
          <div class="col-md-12">
            <span class="harga ads">
              5.000
            </span><br>
            <span class="txt-poin">
              points
            </span>
          </div>

          <hr class="orn">

          <span class="idr">
            IDR 62.500.-  
          </span>
          
          <br>
          <a href="{{'ads-pricing/5'}}">
            <button class="btn btn-block btn-upgrade-big btn-danger">
              TOP UP
            </button>      
          </a>
      
        </div>
      </div>
    </div> 

    <div class="col-lg-4 col-md-12 col-12">
      <div class="card primary ads card-ribbon">

        <div class="corner-ribbon top-right bg-blue">
          START HERE
        </div>

        <div class="card-body">
          <div class="col-md-12">
            <span class="harga ads">
              10.000
            </span><br>
            <span class="txt-poin">
              points
            </span>
          </div>

          <hr class="orn">

          <span class="idr">
            IDR 115.000.-  
          </span>

          <a href="{{'ads-pricing/6'}}">
            <button class="btn btn-block btn-upgrade-big bg-blue">
              TOP UP
            </button>
          </a>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-12 col-12">
      <div class="card card-ribbon">
        <div class="card-body">
          <div class="col-md-12">
            <span class="harga ads">
              20.000
            </span><br>
            <span class="txt-poin">
              points
            </span>
          </div>

          <hr class="orn">
          
          <span class="idr">
            IDR 210.000.-  
          </span>

          <a href="{{'ads-pricing/7'}}">
            <button class="btn btn-block btn-upgrade-big bg-light-green">
              TOP UP
            </button>  
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="offset-lg-1 col-lg-10 offset-md-2 col-md-8 mb30" align="center">
  <div class="row mb-md-0 mb-5 pricing-box">

    <div class="col-lg-3 col-md-12 col-12">
      <div class="card">
        <div class="card-body">
         
          <div class="col-md-12">
            <span class="harga ads">
              25.000
            </span><br>
            <span class="txt-poin">
              points
            </span>
          </div>

          <hr class="orn">

          <span class="idr">
            IDR 237.500.-  
          </span>
          
          <br>
          <a href="{{'ads-pricing/8'}}">
            <button class="btn btn-block btn-upgrade-big bg-tosca">
              TOP UP
            </button>
          </a>
  
        </div>
      </div>
    </div> 

    <div class="col-lg-3 col-md-12 col-12">
      <div class="card primary ads card-ribbon">

        <div class="corner-ribbon top-right bg-purple">
          BEST SELLER
        </div>

        <div class="card-body">
          <div class="col-md-12">
            <span class="harga ads">
              50.000
            </span><br>
            <span class="txt-poin">
              points
            </span>
          </div>

          <hr class="orn">

          <span class="idr">
            IDR 425.000.-
          </span>

          <a href="{{'ads-pricing/9'}}">
            <button class="btn btn-block btn-upgrade-big bg-purple">
              TOP UP
            </button>
          </a>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-12 col-12">
      <div class="card primary ads card-ribbon">
        <div class="corner-ribbon top-right bg-pink">
          SMART DEAL
        </div>

        <div class="card-body">
          <div class="col-md-12">
            <span class="harga ads">
              75.000
            </span><br>
            <span class="txt-poin">
              points
            </span>
          </div>

          <hr class="orn">
          
          <span class="idr">
            IDR 562.500.-
          </span>

          <a href="{{'ads-pricing/10'}}">
            <button class="btn btn-block btn-upgrade-big bg-pink">
              TOP UP
            </button>  
          </a>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-12 col-12">
      <div class="card primary ads card-ribbon">
        <div class="corner-ribbon top-right orange">
          BEST DEAL
        </div>

        <div class="card-body">
          <div class="col-md-12">
            <span class="harga ads">
              100K
            </span><br>
            <span class="txt-poin">
              points
            </span>
          </div>

          <hr class="orn">
          
          <span class="idr">
            IDR 650.000.-
          </span>

          <a href="{{'ads-pricing/11'}}">
            <button class="btn btn-block btn-upgrade-big premium">
              TOP UP
            </button>  
          </a>
        </div>
      </div>
    </div>
  </div>
</div>  

@endsection