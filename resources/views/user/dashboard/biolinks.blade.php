@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/dash.css')}}">
<script src="{{asset('js/biolinks.js')}}"></script>
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
        
      @if (session('ok') )
          <div class="alert alert-success" role="alert">
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
              <a href="#style" class="nav-link link" role="tab" data-toggle="tab">Tampilan</a>
          </li>
         </ul>

    <div class="tab-content">      
      <div role="tabpanel" class="tab-pane fade in active" id="link">
        <form method="post" action="{{url('save-bio')}}" novalidate>
               {{ csrf_field() }}
    <!--messengers!-->
            <label for="" style="font-weight:bold;">Messengers :</label>
              <button type="button" class="float-right mb-3 btn btn-primary btn-sm"  id="tambah"><i class="fas fa-plus"></i>
              </button>

    <div class="hid">
      <div class="input-group messengers margin " id="wa"  >
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fab fa-whatsapp"></i>
          </div>
        </div>
      <input type="text" name="wa" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan nomor whatsapp">
        <button type="button"  class="btn btn-danger" id="deletewa"><i class="fas fa-trash-alt"></i>
        </button>
      </div>

      <div class="input-group messengers margin hidden" id="telegram" style=" display:none;">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fab fa-telegram-plane"></i>
          </div>
        </div>
      <input type="text" name="telegram" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan nomor telegram" >
        <button type="button" class="btn btn-danger" id="deletetelegram"><i class="fas fa-trash-alt"></i>
        </button>
      </div>

      <div class="input-group messengers margin hidden" id="skype" style="display:none;">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fab fa-skype"></i>
          </div>
        </div>
      <input type="text" name="skype" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan nomor Skype">
        <button id="deleteskype" class="btn btn-danger" type="button"><i class="fas fa-trash-alt"></i>
        </button>
      </div>
    </div>
        
        <!--Links-->

    <label for="" style="font-weight:bold;">Links :</label>
      <button type="button" class="float-right mb-3 btn btn-primary btn-sm"  id="addlink"><i class="fas fa-plus"></i> Add Link
       </button><br>
  <table>
    <div class="a">
      <div class="input-stack">
        <input type="text" name="title[]" value="" placeholder="Title" class="form-control" >
          <input type="text" name="url[]" value="" placeholder="http://url..." class="form-control" style="margin-bottom:20px;">
        <button class="deletelink btn btn-danger" type="button"><i class="fas fa-trash-alt"></i>
        </button>
      </div>
  </div>
</table>
      <!--social media-->

    <label for="" style="font-weight:bold">Social Media</label>
      <button type="button" class="float-right mb-3 btn btn-primary btn-sm" id="sm"><i class="fas fa-plus"></i></button>

     <div class="input-group socialmedia margin" id="youtube">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fab fa-youtube"></i>
          </div>
        </div>
      <input type="text" name="youtube" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan channel youtube url" >
      <button id="deleteyoutube" class="btn btn-danger" type="button"><i class="fas fa-trash-alt"></i>
      </button>
    </div>

      <div class="input-group socialmedia margin hidden" id="fb" style="display:none;">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fab fa-facebook-f"></i>
          </div>
        </div>
      <input type="text" name="fb" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan username facebook" >
        <button id="deletefb" class="btn btn-danger" type="button"><i class="fas fa-trash-alt"></i>
        </button>
      </div>

      <div class="input-group socialmedia margin hidden" id="twitter" style=" display:none;">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fab fa-twitter"></i>
          </div>
        </div>
      <input type="text" name="twitter" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan username twitter">
        <button id="deletetwitter"  class="btn btn-danger" type="button"><i class="fas fa-trash-alt"></i>
        </button>
      </div>

      <div class="input-group socialmedia margin hidden" id="ig"  style=" display:none;">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fab fa-instagram"></i>
          </div>
        </div>
      <input type="text" name="ig" class="form-control" id="inlineFormInputGroupUsername" placeholder="masukkan username instagram">
        <button id="deleteig"  class="btn btn-danger" type="button"><i class="fas fa-trash-alt"></i>
        </button>
      </div>
      <input type="submit" value="SAVE" class="btn btn-primary btn-biolinks">
    </form>
  </div>
  <!-- TAB 2 -->

            <div role="tabpanel" class="tab-pane fade" id="style">MY STYLE 
          
            </div>
          </div>
        </div>
     </div>  
   </div>
  </div>
</div>

@endsection