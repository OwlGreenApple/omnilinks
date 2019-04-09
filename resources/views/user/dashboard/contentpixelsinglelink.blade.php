<option value="">--Pilih--</option>
@foreach($data_pixel as $pixel)
  <option value="{{$pixel->id}}">
    {{$pixel->title}}
  </option>
@endforeach