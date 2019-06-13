<option value="0" <?php if($id=='0') echo 'selected' ?>>  
  -- Pilih Pixel Retargetting --
</option>
@foreach($data_pixel as $pixel)
  <option value="{{$pixel->id}}" <?php if($id==$pixel->id) echo 'selected' ?>>
    {{$pixel->title}}
  </option>
@endforeach