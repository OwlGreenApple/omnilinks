@foreach($pixels as $pixel)
	<tr align="center">
		<td>{{$pixel->title}}</td>	
		<td>{{date("d F Y", strtotime($pixel->created_at))}}</td>
		<td>
			<button type="button" class="btn btn-sm btn-primary btn-editpixel " dataeditid="{{$pixel->id}}" datatitle="{{$pixel->title}}" datascript="{{$pixel->script}}" style="margin-right:5px; "><i class="fas fa-pencil-alt"></i></button>
			<button type="button" onclick="return confirm('anda yakin ingin menghapus walink ini')" class="btn btn-sm btn-danger btn-deletepixelsingle" dataid="{{$pixel->id}}"><i class="fas fa-trash-alt"></i></button>
      </td>
	</tr>
@endforeach