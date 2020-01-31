<option value="0" >  
  -- Pilih Pixel Retargetting --
</option>
@if($data_pixel->count() > 0)
  @foreach($data_pixel as $pixel)
    @if($pixel->id == $wachat_pixel_id)
    <option value="{{$pixel->id}}" selected="selected">
      {{$pixel->title}}
    </option>
    @else
     <option value="{{$pixel->id}}">
      {{$pixel->title}}
     </option>
    @endif
  @endforeach
@endif