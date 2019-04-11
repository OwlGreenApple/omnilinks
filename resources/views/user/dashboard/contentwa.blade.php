@foreach($walink as $walinks)
  <div class="card card-none mb-3">
    <div class="card-header card-gray" id="headingOne">
      <span class="view-wa" data-toggle="collapse" data-target="#detail-{{$walinks->id}}" aria-expanded="true" aria-controls="detail-{{$walinks->id}}">
        {{$walinks->nomor}}
        <span class="ml-2">
          <i class="fas fa-sort-down"></i>  
        </span>
        
      </span>

      <button type="button" dataidwa="{{$walinks->id}}" class="btn btn-sm btn-danger float-right btn-deletewa">
        <i class="fas fa-trash-alt"></i>
      </button>

      <button type="button" class="btn btn-sm btn-primary float-right btn-editwa" dataeditwa="{{$walinks->id}}" datanomorwa="{{$walinks->nomor}}" datapesan="{{$walinks->pesan}}" style="margin-right:5px; ">
        <i class="fas fa-pencil-alt"></i>
      </button>
    </div>

    <div id="detail-{{$walinks->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body mb-2">
        <span id="{{$walinks->id}}">
          {{$walinks->linkgenerator}}
        </span>
      </div>

      <div class="col-md-12 text-right">
        <button type="button" class="btn btn-success btn-biolinks" onclick="copyTO('#{{$walinks->id}}')">
          COPY LINK
        </button>  
      </div>
      
    </div>
  </div>
@endforeach