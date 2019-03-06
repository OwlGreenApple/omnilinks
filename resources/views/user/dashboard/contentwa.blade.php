@foreach($walink as $walinks)
 <div class="card" style="margin-bottom: 50px;">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <h5>{{$walinks->nomor}}</h5>
          <button type="button" onclick="return confirm('anda yakin ingin menghapus pixel ini')" dataidwa="{{$walinks->id}}" class="btn btn-sm btn-danger float-right btn-delete"><i class="fas fa-trash-alt"></i></button>
       <button type="button" class="btn btn-sm btn-primary float-right" style="margin-right:5px; "><i class="fas fa-pencil-alt"></i></button>
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
       <p id="{{}}">{{$walinks->linkgenerator}}</p>
      </div>
      <button type="button" class="btn btn-success btn-biolinks">COPY LINK</button>
    </div>
  </div>
@endforeach