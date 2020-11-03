@if($query->count() > 0)
  @foreach($query as $proof)
    <div class="card card-none mb-3">
      <div class="card-header card-gray">
        <span data-toggle="collapse" data-target="#detail-{{$proof->id}}" aria-expanded="true" aria-controls="detail-{{$proof->id}}">
          {{$proof->name}}
          <span class="ml-2">
            <i class="fas fa-sort-down"></i>  
          </span>
        </span>

        <button type="button" dataid="{{$proof->id}}" class="btn btn-sm btn-danger float-right btn-delete-proof">
          <i class="fas fa-trash-alt"></i>
        </button>

        <button type="button" class="btn btn-sm btn-primary float-right btn-editproof mr-1" dataedit="{{ $proof->id }}" data-name="{{$proof->name}}" data-star="{{ $proof->star }}" data-text="{{ $proof->text }}">
          <i class="fas fa-pencil-alt"></i>
        </button>
        
      </div>

      <div id="detail-{{$proof->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">

        <div class="proof-wrapper">
          <div class="proof-image"><img width="95px" height="95px" src="{!! Storage::disk('s3')->url($proof->url_image) !!}" /></div>
        </div>

        <!-- <div class="col-lg-8 col-md-8 col-sm-8 col-8">
           <div class="row">
            <div class="col-lg-3 pr-0 pl-0"><img width="95px" height="95px" src="{!! Storage::disk('s3')->url($proof->url_image) !!}" /></div>
            <div class="col-lg-9 pl-0">
              <div class="row ml-0 mr-0">
                <div class="col-lg-7 col-md-7 col-sm-7 col-7 pl-0"><b>{{ $proof->name }}</b></div>
                <div class="col-lg-5 col-md-5 col-sm-5 col-5 pl-0 pr-0">
                  @for($x=1;$x<=$proof->star;$x++)
                    <i class="fa fa-star star-custom" aria-hidden="true"></i>
                  @endfor
                </div>
              </div>
              <div class="col-lg-12 pl-1 proof_text">{{ $proof->text }}</div>
            </div>
          </div>
        </div> -->

     </div>
    </div>      
  @endforeach
@endif
