<?php $x=0 ?>
@foreach($walink as $walinks)
<?php 
$x++; ?>
  <div class="card card-none mb-4">
    <div class="card-header card-gray" id="heading{{$x}}">
      <span class="view-wa" data-toggle="collapse" data-target="#collapse{{$x}}" aria-expanded="true" aria-controls="collapseOne">
        {{$walinks->nomor}}
        <span class="ml-2">
          <i class="fas fa-sort-down"></i>  
        </span>
      </span>
        <?php
          $check_type = explode(':', $walinks->linkgenerator);
          if ($check_type[0]=="whatsapp"){
            echo " (Deep Link)";
          }
          if ($check_type[0]=="https"){
            echo " (Standard)";
          }
        ?>

      <button type="button" dataidwa="{{$walinks->id}}" class="btn btn-sm btn-danger float-right btn-deletewa">
        <i class="fas fa-trash-alt"></i>
      </button>

      <button type="button" class="btn btn-sm btn-primary float-right btn-editwa" dataeditwa="{{$walinks->id}}" datanomorwa="{{$walinks->nomor}}" datapesan="{{$walinks->pesan}}" style="margin-right:5px; ">
        <i class="fas fa-pencil-alt"></i>
      </button>
    </div>

    <div id="collapse{{$x}}" class="collapse" aria-labelledby="heading{{$x}}" data-parent="#accordionExample">
      <div class="card-body mb-3">
        <span id="{{$walinks->id}}">{{$walinks->linkgenerator}}</span>
      </div>

      <div class="offset-md-8 col-md-4 text-right">
        <button type="button" class="btn btn-success pl-0 pr-0 btn-block btn-biolinks" onclick="copyTO('#{{$walinks->id}}')">
          COPY LINK
        </button>  
      </div>
      
    </div>
  </div>
@endforeach