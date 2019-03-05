	
	@foreach($pixels as $pixel)
	 <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <h5>{{$pixel->title}}</h5>
          <button type="button" onclick="return confirm('anda yakin ingin menghapus pixel ini')" dataid="{{$pixel->id}}" class="btn btn-sm btn-danger float-right btn-delete"><i class="fas fa-trash-alt"></i></button>
       <button type="button" class="btn btn-sm btn-primary float-right" style="margin-right:5px; "><i class="fas fa-pencil-alt"></i></button>
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
       {{$pixel->script}}
      </div>
    </div>
  </div>
@endforeach
 
<!--
 <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="collapseOne" aria-expanded="true" aria-controls="collapseOne">
           <h5>{{$pixel->title}}</h5>
        </button>
        <button type="button" onclick="return confirm('anda yakin ingin menghapus pixel ini')" dataid="{{$pixel->id}}" class="btn btn-sm btn-danger float-right btn-delete"><i class="fas fa-trash-alt"></i></button>

       <button href="" class="btn btn-sm btn-primary float-right" style="margin-right:5px; "><i class="fas fa-pencil-alt"></i></button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3{{$pixel->script}}
      </div>
    </div>
  </div>
-->