@extends('layouts.app')
@section('content')
<script  type="text/javascript">
    $(document).ready(function(){
        function toggleIcon(e) {
    $(e.target)
        .prev('.card-header').find(".fa").toggleClass('fa-caret-right fa-caret-down');
        }
        $('.accordion').on('hidden.bs.collapse', toggleIcon);
        $('.accordion').on('shown.bs.collapse', toggleIcon);
    });
    </script>
<link rel="stylesheet" href="{{asset('css/about.css')}}">

    <center>
    <h1 class="omni">OMNILINKZ FAQ PAGES</h1>
    <h3 class="omni" style="padding-top:2px; font-weight:500; font-size: 22px;">Sub Heading Tittle Goes Here</h3>
    </center>
    <div class="container py-3">
    <div class="row">
        <div class="col-10 mx-auto">
            <div class="accordion" id="faqExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                        <button class="btx btn btn-link btn-block text-left " type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h4>
                    <span>
		  		<i class="fa fa-caret-right" ></i>
		  	</span>
              Nailing It On The Head With Free Internet Advertising?</h4>
                            </button>
                          </h5>
                    </div>
                    <div id="collapseOne" class="fade collapse" aria-labelledby="headingOne" data-parent="#faqExample">
                        <div class="card-body">
                        Having a baby can be a nerve wracking experience for new parents – not the nine months of pregnancy, I’m talking about after the infant is brought home from the hospital. It’s always the same thing, by the time they have their third child they have it all figured out, but with number one it’s a learning thing.<br><br>

Baby monitors help you hear your baby’s needs without you having to be in the room with the baby. Some baby monitors are portable, or “mobile” and are small enough that you can carry it in your pocket as you do your daily chores around the house. Depending on your price range it’s best to have a base unit that plugs into the wall. The receiving unit can be like your portable phone, you can carry it around with you, and plug it back into the base unit to be recharged.        
                    </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                        <button class="btx btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                         <h4> <span>
		  		<i class="fa fa-caret-right"></i>
		  	</span>
                 
                             The Skinny On Lcd Monitors?</h4>
                        </button>
                      </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqExample">
                        <div class="card-body">
                        Having a baby can be a nerve wracking experience for new parents – not the nine months of pregnancy, I’m talking about after the infant is brought home from the hospital. It’s always the same thing, by the time they have their third child they have it all figured out, but with number one it’s a learning thing.<br><br>

Baby monitors help you hear your baby’s needs without you having to be in the room with the baby. Some baby monitors are portable, or “mobile” and are small enough that you can carry it in your pocket as you do your daily chores around the house. Depending on your price range it’s best to have a base unit that plugs into the wall. The receiving unit can be like your portable phone, you can carry it around with you, and plug it back into the base unit to be recharged.        
      
                    </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                        <button class="btx btn btn-link btn-block text-left collapsed" type="button" data-toggle="fade collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapsethree">
                         <h4>
                         <span>
		  		<i class="fa fa-caret-right"></i>
		  	        </span>
                             Hotels How To Get Free Gifts?</h4>
                        </button>
                      </h5>
                    </div>
                    <div id="collapseThree" class="fade collapse" aria-labelledby="headingThree" data-parent="#faqExample">
                        <div class="card-body">
                        Having a baby can be a nerve wracking experience for new parents – not the nine months of pregnancy, I’m talking about after the infant is brought home from the hospital. It’s always the same thing, by the time they have their third child they have it all figured out, but with number one it’s a learning thing.<br><br>

Baby monitors help you hear your baby’s needs without you having to be in the room with the baby. Some baby monitors are portable, or “mobile” and are small enough that you can carry it in your pocket as you do your daily chores around the house. Depending on your price range it’s best to have a base unit that plugs into the wall. The receiving unit can be like your portable phone, you can carry it around with you, and plug it back into the base unit to be recharged.        
      
                    </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingfour">
                        <h5 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                         <h4>
                         <span>
		  		<i class="fa fa-caret-right"></i>
		  	</span>
                         Advertise No Matter If You Are Big Or Small?</h4>
                        </button>
                      </h5>
                    </div>
                    <div id="collapsefour" class="fade collapse" aria-labelledby="headingfour" data-parent="#faqExample">
                        <div class="card-body">
                        Having a baby can be a nerve wracking experience for new parents – not the nine months of pregnancy, I’m talking about after the infant is brought home from the hospital. It’s always the same thing, by the time they have their third child they have it all figured out, but with number one it’s a learning thing.<br><br>

Baby monitors help you hear your baby’s needs without you having to be in the room with the baby. Some baby monitors are portable, or “mobile” and are small enough that you can carry it in your pocket as you do your daily chores around the house. Depending on your price range it’s best to have a base unit that plugs into the wall. The receiving unit can be like your portable phone, you can carry it around with you, and plug it back into the base unit to be recharged.        
      
                    </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingfive">
                        <h5 class="mb-0">
                            <button class="btx btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                             <h4>
                             <span>
		  		<i class="fa fa-caret-right"></i>
		  	</span>
                                 Video Games Playing With Imagination?</h4>
                            </button>
                          </h5>
                    </div>
                    <div id="collapsefive" class="fade collapse" aria-labelledby="headingfive" data-parent="#faqExample">
                        <div class="card-body">
                        Having a baby can be a nerve wracking experience for new parents – not the nine months of pregnancy, I’m talking about after the infant is brought home from the hospital. It’s always the same thing, by the time they have their third child they have it all figured out, but with number one it’s a learning thing.<br><br>

Baby monitors help you hear your baby’s needs without you having to be in the room with the baby. Some baby monitors are portable, or “mobile” and are small enough that you can carry it in your pocket as you do your daily chores around the house. Depending on your price range it’s best to have a base unit that plugs into the wall. The receiving unit can be like your portable phone, you can carry it around with you, and plug it back into the base unit to be recharged.        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--container-->
<section class="secfoot">
        <div class="row">
            <div class="col-md-11">
                <div align="center">
        <h1 class="txtsecfoot" style="font-size:41px;">Can't Find youre Looking For?</h1> 
                <a href="" class="btn btnget" style="margin-left:77px; margin-top:20px">Email Us</a>
                </div>
            </div>
        </div>
    </section>
    
@endsection
<!--
