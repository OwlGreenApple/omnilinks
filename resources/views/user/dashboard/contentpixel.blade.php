<?php $x=0; ?>
@foreach($pixels as $pixel)
<?php $x++; ?>
  <div class="card">
    <div class="card-header" id="heading{{$x}}">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$x}}" aria-expanded="true" aria-controls="collapseOne">
          <h5>{{$pixel->title}}</h5>
          <button type="button"  dataid="{{$pixel->id}}" class="btn btn-sm btn-danger float-right btn-delete"><i class="fas fa-trash-alt"></i></button>
          <button type="button" class="btn btn-sm btn-primary float-right btn-editpixel" dataeditpixelid="{{$pixel->id}}" datascriptpixel="{{$pixel->script}}" dataedittitle="{{$pixel->title}}" style="margin-right:5px;"><i class="fas fa-pencil-alt"></i></button>
        </button>
      </h2>
    </div>

    <div id="collapse{{$x}}" class="collapse " aria-labelledby="heading{{$x}}" data-parent="#accordionExample">
      <div class="card-body">
       {{$pixel->script}}
     </div>
   </div>
  </div>
@endforeach
