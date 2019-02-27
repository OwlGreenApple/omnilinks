@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/dash.css')}}">
    <div class="notification container notif">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>Masa trial anda akan berakhir dalam 5 hari. <span style="color:blue;">Subscribe</span>
        untuk terus menggunakan Omnilinks
       </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
 <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>Letakkan link berikut di Bio Instagram
       </div>
       <div class="card" style="margin-bottom:20px;">
           <div class="card-body">
               <form method="post" action="{{url('save-bio')}}" novalidate>
               {{ csrf_field() }}
           <ul class="mb-4 nav nav-tabs">
           <li class="nav-item">
         <a href="#link" class="active nav-link link" role="tab" data-toggle="tab">Link</a>
           </li>
           <li class="nav-item">
        <a href="#style" class="nav-link link" role="tab" data-toggle="tab">Tampilan</a>
           </li>
           </ul>
           <div class="tab-content">
               
    <div role="tabpanel" class="tab-pane fade in active" id="link">
        <!--messengers!-->
        <label for="" style="font-weight:bold;">Messengers :</label>
        <button type="button" class="float-right mb-3 btn btn-primary btn-sm"  id="tambah"><i class="fas fa-plus"></i></button>
       
        <div class="hid">
      <div class="input-group messengers margin " id="wa"  >
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fab fa-whatsapp"></i>
          </div>
        </div>
        <input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan whatsapp"  >
        <button type="button" id="deletewa"><i class="fas fa-trash-alt"></i></button>
      </div>
      <div class="input-group messengers margin hidden" id="telegram" style=" display:none;" >
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fab fa-telegram-plane"></i>
          </div>
        </div>
        <input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan telegram" >
        <button type="button" id="deletetelegram"><i class="fas fa-trash-alt"></i></button>
      </div> 
      <div class="input-group messengers margin hidden" id="skype" style="display:none;">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fab fa-skype"></i>
          </div>
        </div>
        <input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan Skype" >
        <button id="deleteskype" type="button"><i class="fas fa-trash-alt"></i></button>
      </div>
        </div>
        
        <!--Links-->

        <label for="" style="font-weight:bold;">Links :</label>
        <button type="button" class="float-right mb-3 btn btn-primary btn-sm"  id="addlink"><i class="fas fa-plus"></i> Add Link</button><br>
        <div class="a">
        <div class="input-stack">
        <input type="text" name="title[0]" value="" placeholder="Title" class="form-control" >
        <input type="text" name="url[0]" value="" placeholder="http://url..." class="form-control">
        <button id="deleteskype" type="button"><i class="fas fa-trash-alt"></i></button>
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
        <input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan youtube" >
        <button id="deleteyoutube" type="button"><i class="fas fa-trash-alt"></i></button>
      </div>
      <div class="input-group socialmedia margin hidden" id="fb" style="display:none;">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fab fa-facebook-f"></i>
          </div>
        </div>
        <input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan facebook" >
        <button id="deletefb" type="button"><i class="fas fa-trash-alt"></i></button>
      </div>
      <div class="input-group socialmedia margin hidden" id="twitter" style=" display:none;">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fab fa-twitter"></i>
          </div>
        </div>
        <input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan twitter"  >
        <button id="deletetwitter" type="button"><i class="fas fa-trash-alt"></i></button>
      </div>
      <div class="input-group socialmedia margin hidden" id="ig"  style=" display:none;">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fab fa-instagram"></i>
          </div>
        </div>
        <input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan instagram" >
        <button id="deleteig" type="button"><i class="fas fa-trash-alt"></i></button>
      </div>
      <input type="submit" value="SAVE" class="btn btn-primary btn-biolinks">
    </div>
    <script src="{{asset('js/biolinks.js')}}"></script>
    <div role="tabpanel" class="tab-pane fade" id="style">bbb</div>
            </div>
           </form>
           </div>
       </div>
        </div>
            </div>
        </div>

@endsection