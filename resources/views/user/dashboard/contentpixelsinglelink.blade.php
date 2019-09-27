<option value="0" >  
  -- Pilih Pixel Retargetting --
</option>
@foreach($data_pixel as $pixel)
  <option value="{{$pixel->id}}">
    {{$pixel->title}}
  </option>
@endforeach