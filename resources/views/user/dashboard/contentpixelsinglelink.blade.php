@foreach($data_pixel as $pixel)
  <option value="0">  
    -- Pilih Pixel Retargetting --
  </option>
  <option value="{{$pixel->id}}">
    {{$pixel->title}}
  </option>
@endforeach