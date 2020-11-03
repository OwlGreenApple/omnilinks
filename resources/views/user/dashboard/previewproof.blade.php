@if($proof->count() > 0)
  <div class="proof-box-preview">
  @foreach($proof as $row)
  <div class="proof-wrapper-preview">
      <div class="proof_image"><img src="{!! Storage::disk('s3')->url($row->url_image) !!}"/></div>
   
      <div class="proof-desc">
          <div class="proof_profile">
            <div class="proof_name_preview">{{ $row->name }}</div>
            <div class="proof_star_preview">
              @for($x=1;$x<=$row->star;$x++)
                <i class="fa fa-star" aria-hidden="true"></i>
              @endfor
            </div>
          </div>

          <div class="proof_comments_preview">
           {{ $row->text }}
          </div>
      </div>
  </div>
  @endforeach
  </div>
@endif