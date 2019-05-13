<?php $x=0; ?>
@foreach($pixels as $pixel)
  <div class="card card-none">
    <div class="card-header card-gray" id="headingOne">
      <span class="view-wa" data-toggle="collapse" data-target="#detail-{{$pixel->id}}" aria-expanded="true" aria-controls="detail-{{$pixel->id}}">
        {{$pixel->title}}
        <span class="ml-2">
          <i class="fas fa-sort-down"></i>  
        </span>
      </span>

      <button type="button"  dataid="{{$pixel->id}}" class="btn btn-sm btn-danger float-right btn-delete">
        <i class="fas fa-trash-alt"></i>
      </button>

      <button type="button" class="btn btn-sm btn-primary float-right btn-editpixel" dataeditpixelid="{{$pixel->id}}" datascriptpixel="{{$pixel->script}}" dataedittitle="{{$pixel->title}}" datajenis="{{$pixel->jenis_pixel}}" style="margin-right:5px; ">
        <i class="fas fa-pencil-alt"></i>
      </button>
      
    </div>

    <div id="detail-{{$pixel->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
       {{$pixel->script}}
     </div>
   </div>
  </div>      
@endforeach
