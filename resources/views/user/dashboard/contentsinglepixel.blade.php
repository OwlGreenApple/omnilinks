@if(!$pixels->count())
  <tr align="center">
    <td colspan="3">No Data To show</td>
  </tr>
@else
  @foreach($pixels as $pixel)
    <tr align="center">
      <td>{{$pixel->title}}</td>	
      <td>{{date("d F Y", strtotime($pixel->created_at))}}</td>
      <td>
        <button type="button" class="btn btn-sm btn-primary btn-editpixel " dataeditid="{{$pixel->id}}" datatitle="{{$pixel->title}}" datascript="{{$pixel->script}}" datajenis="{{$pixel->jenis_pixel}}" style="margin-right:5px; ">
          <i class="fas fa-pencil-alt"></i>
        </button>
        <button type="button" class="btn btn-sm btn-danger btn-deletepixelsingle" dataid="{{$pixel->id}}">
          <i class="fas fa-trash-alt"></i>
        </button>
      </td>
    </tr>
  @endforeach
@endif