@extends('layouts.app')

@section('content')
<!--header-->
<section class="header">
        <div class="row">
            <div class="col-md-6 detailheader">
                <h1 class="txt" style="font-size: 48px;">All-In-One Instagram<br>Bio Link</h1>
                <h2 class="txt">Sub Heading Title here</h2>
            <a href="" class="btn btnget">
                GET STARTED
            </a>
            </div>
            <div class="col-md-6">
            </div>
    </div>
    </section>
    <!--content1-->
    <section>
            <div class="row">
            <div class="col-md-6 leftcontent">
                <div class="leftimg">
                    <img src="{{asset('image/thumb-01.png')}}" alt="">
                </div>
            </div>   
            <div class="col-md-6 rightcontent">
            <h1 class="txtsection" style="font-size: 48px;">Multiple Link On <br>Your Bio</h1>
                <h2 class="txtsection">Sub Heading Title Goes here</h2>
            <a href="" class="btn btncontent1">
                GET STARTED
            </a>
            </div>
        </div>
    </section>
    <!--content2-->
        <section>
            <div class="row">
            <div class="col-md-6 leftcontent2">
            <h1 class="txtsection" style="font-size: 48px;">Omnilinks Data<br><div style="margin-left: 86px; padding-left: 51px;">Analystik</div></h1>
                <h2 class="txtsection">Sub Heading Title Goes here</h2>
            <a href="" class="btn btncontent1" style="margin-left: 140px;">
                GET STARTED
            </a>
            </div>   
            <div class="col-md-6 rightcontent2">
            <div class="leftimg">
                    <img src="{{asset('image/thumb-02.png')}}" alt="">
                </div>
              
            </div>
        </div>
    </section>
    <!--content3/footer content-->
    <section class="secfoot">
        <div class="row">
            <div class="col-md-6">
        <h1 class="txtsecfoot" style="font-size:41px;">Start Make Your Own Now</h1>
            </div>
            <div class="col-md-6">
                <a href="" class="btn btnget" style="margin-left:156px;">Start Now</a>
            </div>
        </div>
    </section>
@endsection
<!--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Home</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>-->