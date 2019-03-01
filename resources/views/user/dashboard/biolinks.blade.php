@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/dash.css')}}">
<script src="{{asset('js/biolinks.js')}}"></script>
  <div class="notification container notif">
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
      </button>Masa trial anda akan berakhir dalam 5 hari. <span style="color:blue;">Subscribe</span>
    untuk terus menggunakan Omnilinks
    </div>
  </div>


  <div class="container">
  <div class="row">
    <div class="col-md-6">
    
    @if (session('ok') )
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">x</span>
      </button>
      <strong>Success!</strong>{{session('ok')}}
      </div>
    @endif 

    <div class="alert alert-success alert-dismissible fade show" role="alert">
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>Letakkan link berikut di Bio Instagram
     </div>

  <div class="card" style="margin-bottom:20px;">
    <div class="card-body">
         
    <ul class="mb-4 nav nav-tabs">
      <li class="nav-item">
        <a href="#link" class="active nav-link link" role="tab" data-toggle="tab">Link</a>
      </li>
      <li class="nav-item">
        <a href="#walink" class="nav-link link" role="tab" data-toggle="tab">WA Link Creator</a>
      </li>
      <li class="nav-item">
        <a href="#pixel" class="nav-link link" role="tab" data-toggle="tab">Pixel</a>
      </li>
      <li class="nav-item">
        <a href="#style" class="nav-link link" role="tab" data-toggle="tab">Tampilan</a>
      </li>
     </ul>

  <div class="tab-content"> 
   
  <!-- tab 1-->
    <div role="tabpanel" class="tab-pane fade in active" id="link">
    <form method="post" action="{{url('save-link')}}" novalidate>
         {{ csrf_field() }}
  <!--messengers!-->
    <input type="hidden" name="names" value="{{$name}}">
      <label for="" style="font-weight:bold;">Messengers :</label>
        <button type="button" class="float-right mb-3 btn btn-primary btn-sm"  id="tambah"><i class="fas fa-plus"></i>
        </button>

  <div class="hid">
    <div class="input-group messengers margin " id="wa"  >
    <div class="input-group-prepend">
      <div class="input-group-text"><i class="fab fa-whatsapp"></i>
      </div>
    </div>
    <input type="text" name="wa" class="form-control" id="inlineFormInputGroupUsername" onkeypress="return hanyaAngka(event)" placeholder="masukkan nomor whatsapp">
    <button type="button" class="btn btn-primary" id="deletewa"><i class="fas fa-trash-alt"></i>
    </button>
    </div>

    <div class="input-group messengers margin hidden" id="telegram" style=" display:none;">
    <div class="input-group-prepend">
      <div class="input-group-text"><i class="fab fa-telegram-plane"></i>
      </div>
    </div>
    <input type="text" name="telegram" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan nomor telegram" >
    <button type="button" class="btn  btn-primary" id="deletetelegram"><i class="fas fa-trash-alt"></i>
    </button>
    </div>

    <div class="input-group messengers margin hidden" id="skype" style="display:none;">
    <div class="input-group-prepend">
      <div class="input-group-text"><i class="fab fa-skype"></i>
      </div>
    </div>
    <input type="text" name="skype" onkeypress="return hanyaAngka(event)" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan nomor Skype">
    <button id="deleteskype" class="btn btn-primary" type="button"><i class="fas fa-trash-alt"></i>
    </button>
    </div>
  </div>
    
    <!--Links-->

  <label for="" style="font-weight:bold;">Links :</label>
    <button type="button" class="float-right mb-3 btn btn-primary btn-sm"  id="addlink"><i class="fas fa-plus"></i> Add Link
     </button><br>
  <div class="a">
    <div class="input-stack">
      <input type="text" name="title[]" value="" placeholder="Title" class="form-control" >
      <input type="text" name="url[]" value="" placeholder="http://url..." class="form-control" style="margin-bottom:20px;">
    <button class="deletelink btn btn-primary" type="button"><i class="fas fa-trash-alt"></i>
    </button>
    </div>
  </div>
    <!--social media-->

  <label for="" style="font-weight:bold">Social Media</label>
    <button type="button" class="float-right mb-3 btn btn-primary btn-sm" id="sm"><i class="fas fa-plus"></i></button>

   <div class="input-group socialmedia margin" id="youtube">
    <div class="input-group-prepend">
      <div class="input-group-text"><i class="fab fa-youtube"></i>
      </div>
    </div>
    <input type="text" name="youtube" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan channel youtube url" >
    <button id="deleteyoutube" class="btn btn-primary" type="button"><i class="fas fa-trash-alt"></i>
    </button>
  </div>

    <div class="input-group socialmedia margin hidden" id="fb" style="display:none;">
    <div class="input-group-prepend">
      <div class="input-group-text"><i class="fab fa-facebook-f"></i>
      </div>
    </div>
    <input type="text" name="fb" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan username facebook" >
    <button id="deletefb" class="btn btn-primary" type="button"><i class="fas fa-trash-alt"></i>
    </button>
    </div>

    <div class="input-group socialmedia margin hidden" id="twitter" style=" display:none;">
    <div class="input-group-prepend">
      <div class="input-group-text"><i class="fab fa-twitter"></i>
      </div>
    </div>
    <input type="text" name="twitter" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan username twitter">
    <button id="deletetwitter"  class="btn btn-primary" type="button"><i class="fas fa-trash-alt"></i>
    </button>
    </div>

    <div class="input-group socialmedia margin hidden" id="ig"  style=" display:none;">
    <div class="input-group-prepend">
      <div class="input-group-text"><i class="fab fa-instagram"></i>
      </div>
    </div>
    <input type="text" name="ig" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan username instagram">
    <button id="deleteig"  class="btn btn-primary" type="button"><i class="fas fa-trash-alt"></i>
    </button>
    </div>

    <div class="as">
        <hr class="own">
      <button type="submit" class="btn btn-primary btn-biolinks "><i class="far fa-save" style="margin-right:5px;"></i>SAVE</button>
      </div>
    </form>
  </div>

  <!-- TAB 2 -->

  <div role="tabpanel" class="tab-pane fade " id="walink">
    <form action="{{url('save-wa')}}">
    <span class="" style="color:blue">WhatsApp Link Creator</span><br>
         <span>Masukkan Nomor WA</span>
         <form>
         <input type="text" name="" id="" class="">
        <button type="reset" class="btn btn-danger" style="margin-top: 10px;
    margin-bottom: 10px;">Reset</button></form>
  <div class="card">
    <span class="card-header">Masukkan Pesan</span>
      <textarea class="card-body form-control" name="pesan">
      </textarea>
    </div>
    <button type="submit" class="btn btn-primary btn-biolinks" style="margin-top: 20px;
    margin-bottom: 10px;">SAVE & CREATE LINK</button>
    <p style="margin-top: 67px; color:blue;" >Recent WhatsApp Link Creator</p>
    <div class="card" style="margin-top: 10px;margin-bottom: 20px;">
    <span class="card-header">the number</span>
      <textarea class="card-body form-control" name="recent" readonly="true">
      </textarea>
    </div>
    <button type="button" class="btn btn-success btn-biolinks"> COPY LINK </button>
    <div class="card" style="margin-top: 75px;margin-bottom: 33px;">
      <span class="card-header">
        this is a number
      </span>
    </div>
    </form>
  </div>
  
  <!-- TAB 3 -->
  
  <div class="tab-pane fade" id="pixel">
    <form action="{{url('save-pixel')}}"></form>
    <span style="color:blue;">Pixel Retargetting</span>
      <textarea class="card-body form-control" ></textarea>
        <div class="title" style="margin-top: 20px;">
          <span>Title</span>
          <input type="text" name="">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    <hr class="own">
    <span style="color:blue;">Recent Pixel Retargetting</span>
  </form>
  </div>

  <!-- TAB 4 -->

      <div role="tabpanel" class="tab-pane fade" id="style"> 
         <form method="post" action="{{url('save-template')}}" novalidate>
         {{ csrf_field() }}
         <input type="hidden" name="" value="{{$name}}">
      <div class="mb-5 form-group">
        <label>Bio Link alias:
        </label>
        <div>
          <div class="">
            <span>Omni.by/</span>
            <input type="text" name="slug" value="" class="form-control">
          </div>
        </div>
      </div>

      <label class="switch">
    <input type="checkbox">
    <span class="slider round"></span>
    </label> &nbsp;Rounded buttons<br>
    <label class="switch">
    <input type="checkbox" name="rounded">
    <span class="slider round"></span>
    </label>
    &nbsp; outlinend buttons
    <div class="as">
        <hr class="own">
      <button type="submit" class="btn btn-primary btn-biolinks "><i class="far fa-save" style="margin-right:5px;"></i>SAVE</button>
      </div>
    </form>
      </div>

      </div>
      
    </div>
   </div>  
   </div>
  </div>
</div>
@endsection
 