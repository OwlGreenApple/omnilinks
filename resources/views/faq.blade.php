@extends('layouts.app')
@section('content')
<script type="text/javascript">
  $(document).ready(function() {
    function toggleIcon(e) {
      $(e.target)
        .prev('.card-header').find(".fa").toggleClass('fa-caret-right fa-caret-down');
    }
    $('.accordion').on('hidden.bs.collapse', toggleIcon);
    $('.accordion').on('shown.bs.collapse', toggleIcon);
  });
</script>

<link rel="stylesheet" href="{{asset('css/about.css')}}">

<header class="content-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="omni-title mb-5">OMNILINKZ FAQ PAGES</h1>
        <h3 class="omni-sub">Sub Heading Title Goes Here</h3>
      </div>
    </div>
  </div>
</header>

<section class="content" style="min-height: calc(100vh - 635px)">
  <div class="container">
    <div class="row">
      <div class="col-10 mx-auto">
        <div class="accordion" id="faqExample">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btx btn btn-link btn-block text-left btn-faq" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <b class="faq-head">
                    <span class="blue-icon">
                      <i class="fa fa-caret-right"></i>&nbsp;
                    </span>
                    Nailing It On The Head With Free Internet Advertising?
                  </b>
                </button>
              </h5>
            </div>
            <div id="collapseOne" class="fade collapse" aria-labelledby="headingOne" data-parent="#faqExample">
              <div class="card-body faq-txt">
                Having a baby can be a nerve wracking experience for new parents – not the nine months of pregnancy, I’m talking about after the infant is brought home from the hospital. It’s always the same thing, by the time they have their third child they have it all figured out, but with number one it’s a learning thing.<br><br>

                Baby monitors help you hear your baby’s needs without you having to be in the room with the baby. Some baby monitors are portable, or “mobile” and are small enough that you can carry it in your pocket as you do your daily chores around the house. Depending on your price range it’s best to have a base unit that plugs into the wall. The receiving unit can be like your portable phone, you can carry it around with you, and plug it back into the base unit to be recharged.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btx btn btn-link btn-block text-left btn-faq collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  <b class="faq-head"> 
                    <span class="blue-icon">
                      <i class="fa fa-caret-right"></i>&nbsp;
                    </span>

                    The Skinny On Lcd Monitors?
                  </b>
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqExample">
              <div class="card-body faq-txt">
                Having a baby can be a nerve wracking experience for new parents – not the nine months of pregnancy, I’m talking about after the infant is brought home from the hospital. It’s always the same thing, by the time they have their third child they have it all figured out, but with number one it’s a learning thing.<br><br>

                Baby monitors help you hear your baby’s needs without you having to be in the room with the baby. Some baby monitors are portable, or “mobile” and are small enough that you can carry it in your pocket as you do your daily chores around the house. Depending on your price range it’s best to have a base unit that plugs into the wall. The receiving unit can be like your portable phone, you can carry it around with you, and plug it back into the base unit to be recharged.

              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btx btn btn-link btn-block text-left collapsed btn-faq" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  <b class="faq-head"> 
                    <span class="blue-icon">
                      <i class="fa fa-caret-right"></i>&nbsp;
                    </span>

                    Hotels How To Get Free Gifts?
                  </b>
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqExample">
              <div class="card-body faq-txt">
                Having a baby can be a nerve wracking experience for new parents – not the nine months of pregnancy, I’m talking about after the infant is brought home from the hospital. It’s always the same thing, by the time they have their third child they have it all figured out, but with number one it’s a learning thing.<br><br>

                Baby monitors help you hear your baby’s needs without you having to be in the room with the baby. Some baby monitors are portable, or “mobile” and are small enough that you can carry it in your pocket as you do your daily chores around the house. Depending on your price range it’s best to have a base unit that plugs into the wall. The receiving unit can be like your portable phone, you can carry it around with you, and plug it back into the base unit to be 

              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingfour">
              <h5 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed btn-faq" type="button" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                  <b class="faq-head">
                    <span class="blue-icon">
                      <i class="fa fa-caret-right"></i>&nbsp;
                    </span>
                    Advertise No Matter If You Are Big Or Small?
                  </b>
                </button>
              </h5>
            </div>
            <div id="collapsefour" class="fade collapse" aria-labelledby="headingfour" data-parent="#faqExample">
              <div class="card-body faq-txt">
                Having a baby can be a nerve wracking experience for new parents – not the nine months of pregnancy, I’m talking about after the infant is brought home from the hospital. It’s always the same thing, by the time they have their third child they have it all figured out, but with number one it’s a learning thing.<br><br>

                Baby monitors help you hear your baby’s needs without you having to be in the room with the baby. Some baby monitors are portable, or “mobile” and are small enough that you can carry it in your pocket as you do your daily chores around the house. Depending on your price range it’s best to have a base unit that plugs into the wall. The receiving unit can be like your portable phone, you can carry it around with you, and plug it back into the base unit to be recharged.

              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingfive">
              <h5 class="mb-0">
                <button class="btx btn btn-link btn-block text-left collapsed btn-faq" type="button" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                  <b class="faq-head">
                    <span class="blue-icon">
                      <i class="fa fa-caret-right"></i>&nbsp;
                    </span>
                    Video Games Playing With Imagination?
                  </b>
                </button>
              </h5>
            </div>
            <div id="collapsefive" class="fade collapse" aria-labelledby="headingfive" data-parent="#faqExample">
              <div class="card-body faq-txt">
                Having a baby can be a nerve wracking experience for new parents – not the nine months of pregnancy, I’m talking about after the infant is brought home from the hospital. It’s always the same thing, by the time they have their third child they have it all figured out, but with number one it’s a learning thing.<br><br>

                Baby monitors help you hear your baby’s needs without you having to be in the room with the baby. Some baby monitors are portable, or “mobile” and are small enough that you can carry it in your pocket as you do your daily chores around the house. Depending on your price range it’s best to have a base unit that plugs into the wall. The receiving unit can be like your portable phone, you can carry it around with you, and plug it back into the base unit to be recharged.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--container-->
<section class="secfoot">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h2>Can’t find what you’re looking for?</h2>

        <a href="mailto:support@omnilinkz.com?subject=Mail from Our Site"> 
          <button type="button" class="btn btn-primary btn-lg btn-email">
            EMAIL US
          </button>
        </a>
      </div>
    </div>
  </div>
</section>

@endsection