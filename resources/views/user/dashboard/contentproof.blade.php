@if($query->count() > 0)
  <label class="mb-3 blue-txt">Mode</label>
    
  <label class="switch ml-2 mr-3">
    <input type="checkbox" name="proof_setting" @if($pages->proof_settings == 1) checked @endif>
    <span class="slider round"></span>
  </label>
  <label class="caption">Looping</label>

  @foreach($query as $proof)
    <div class="card card-none mb-3">
      <div class="card-header card-gray">
        <span data-toggle="collapse" data-target="#detail-{{$proof->id}}" aria-expanded="true" aria-controls="detail-{{$proof->id}}">
          <span style="font-family:Nunito,sans-serif">{{$proof->name}}</span>
         <!--  <span class="ml-2">
            <i class="fas fa-sort-down"></i>  
          </span> -->
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
            <div class="proof_image"><img src="{!! Storage::disk('s3')->url($proof->url_image) !!}"/></div>
         
            <div class="proof-desc">
                <div class="proof_profile">
                  <div class="proof_name">{{ $proof->name }}</div>
                  <div class="proof_star">
                    @for($x=1;$x<=$proof->star;$x++)
                      <i class="fa fa-star" aria-hidden="true"></i>
                    @endfor
                  </div>
                </div>

                <div class="proof_comments">{{ $proof->text }}</div>
                <small><i class="fas fa-check"></i> Activproof</small>
            </div>
        </div>
        <!-- -->
     </div>
    </div>      
  @endforeach
@endif
